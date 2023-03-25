<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::where('featured', '1')->latest()->take(16)->get();
        $sliders = Slider::where('status', '0')->get();
        $products = Product::orderBy('updated_at', 'desc')->take(6)->get();
        return view('frontend.index', compact('sliders', 'featuredProducts', 'products'));
    }

    public function productView(string $category_slug, string $product_slug)
    {
        $category = Category::where('slug', $category_slug)->first();
        if ($category) {

            $product = $category->products()->where('slug', $product_slug)->where('status', '0')->first();
            if ($product) {
                return view('frontend.collections.products.view', compact('product', 'category'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect()->back();
        }
    }

    public function orderConfirmed()
    {
        return view('frontend.order-confirmed');
    }

    public function womenShow()
    {
        $womenProducts = Product::where('category_id', '2')->latest()->paginate(12);
        return view('frontend.women', compact('womenProducts'));
    }

    public function manShow()
    {
        $manProducts = Product::where('category_id', '1')->latest()->paginate(12);
        return view('frontend.man', compact('manProducts'));
    }

    public function designerShow()
    {
        $designerProducts = Product::where('brand', 'Designer')->latest()->paginate(12);
        return view('frontend.designer', compact('designerProducts'));
    }

    public function saleShow()
    {
        $saleProducts = Product::where('brand', 'Sale')->latest()->paginate(12);
        return view('frontend.sale', compact('saleProducts'));
    }

    public function addToWishList($productId)
    {
        if (Auth::check()) {
            if (Wishlist::where('user_id', auth()->user()->id)->where('product_id', $productId)->exists()) {
                session()->flash('message', 'Already added to wishlist');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Already Added successfully',
                    'type' => 'success',
                    'status' => 409
                ]);
                return false;
            } else {
                $wishlist = Wishlist::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $productId
                ]);
                $this->emit('wishlistAddedUpdated');
                session()->flash('message', 'Already added to successfully');
                $this->dispatchBrowserEvent('message', [
                    'text' => 'Wishlist Added successfully',
                    'type' => 'success',
                    'status' => 200
                ]);
                return false;
            }
        } else {
            session()->flash('message', 'Please Login to continue');
            $this->dispatchBrowserEvent('message', [
                'text' => 'Please Login to continue',
                'type' => 'info',
                'status' => 401
            ]);
            return false;
        }
    }

    public function searchProducts(Request $request)
    {
        if ($request->search) {
            $searchProducts = Product::where('name', 'LIKE', '%' . $request->search . '%')->latest()->paginate(15);
            return view('frontend.pages.search', compact('searchProducts'));
        } else {
            return redirect()->back()->with('message', 'Empty Search');
        }
    }
}
