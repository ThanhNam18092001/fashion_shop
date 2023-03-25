<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\addressFormRequest;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    public function addressShow()
    {
        $address = Address::all();
        return view('frontend.users.address.index', compact('address'));
    }

    public function addressCreate()
    {
        return view('frontend.users.address.create');
    }

    public function addressStore(addressFormRequest $request)
    {
        $validatedData = $request->validated();

        $address = new Address();
        $address->user_id = Auth::user()->id;
        $address->last_name = $validatedData['last_name'];
        $address->fist_name = $validatedData['fist_name'];
        $address->address = $validatedData['address'];
        $address->city = $validatedData['city'];
        $address->pin_code = $validatedData['pin_code'];
        $address->country = $validatedData['country'];
        $address->state = $validatedData['state'];

        $address->status = $request->status == true ? '1' : '0';
        $address->save();

        return redirect('/address')->with('message', 'Address Added Successfully');
    }

    public function addressEdit($address_id)
    {
        $address = Address::findOrFail($address_id);
        return view('frontend.users.address.edit', compact('address'));
    }

    public function addressUpdate(addressFormRequest $request, $address)
    {
        $validatedData = $request->validated();
        $address = Address::findOrFail($address);
        $address->last_name = $validatedData['last_name'];
        $address->fist_name = $validatedData['fist_name'];
        $address->address = $validatedData['address'];
        $address->city = $validatedData['city'];
        $address->pin_code = $validatedData['pin_code'];
        $address->country = $validatedData['country'];
        $address->state = $validatedData['state'];
        $address->status = $request->status == true ? '1' : '0';
        $address->update();
        return redirect('address')->with('message', 'Address Upload Successfully');
    }
}
