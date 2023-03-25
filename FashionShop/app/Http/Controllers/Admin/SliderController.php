<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SliderFormRequest;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(SliderFormRequest $request)
    {
        $validatedData = $request->validated();

        $uploadPath = 'uploads/category/';
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/category/', $filename);
            $validatedData['image'] = $uploadPath.$filename;
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';
        Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image'],
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Added Successfully');
    }

    public function edit(Slider $slider)
    {
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(SliderFormRequest $request, Slider $slider)
    {
        $validatedData = $request->validated();
        if ($request->hasFile('image')) {
            $description = $slider->image;
            if (File::exists($description)) {
                File::delete($description);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time() . '.' . $ext;

            $file->move('uploads/slider//', $filename);
            $validatedData['image'] = "uploads/slider//$filename";
        }

        $validatedData['status'] = $request->status == true ? '1' : '0';
        Slider::where('id', $slider->id)->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            'image' => $validatedData['image']?? $slider->image,
            'status' => $request->status == true ? '1' : '0',
        ]);

        return redirect('admin/sliders')->with('message', 'Slider Update Successfully');
    }

    public function destroy(Slider $slider)
    {
        if ($slider->count() > 0) {
            $description = $slider->image;
            if (File::exists($description)) {
                File::delete($description);
            }
            $slider->delete();
            return redirect('admin/sliders')->with('message','Slider Delete Successfully');
        }

        return redirect('admin/sliders')->with('message','Something Went Wrong');
    }
}
