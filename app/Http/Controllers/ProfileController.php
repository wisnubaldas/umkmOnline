<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Province;
use App\Address;
use Auth;
use Hash;
use Image;
use File;

class ProfileController extends Controller
{
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function index()
    {
    	$user = Auth::user();
    	$cities = City::all();
    	$provinces = Province::all();
    	return view('front.profile.index', compact('user', 'cities', 'provinces'));
    }

    public function update(Request $request)
    {
    	$user = Auth::user();

    	$request->validate([
    		'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'address' => 'required',
            'city_id' => 'required',
            'province_id' => 'required',
            'postal_code' => 'required',
            'phone' => 'required'
    	]);

    	$user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        if ($user->isHaveAddress()) {
            $user->address->address = $request->address;
            $user->address->city_id = $request->city_id;
            $user->address->province_id = $request->province_id;
            $user->address->postal_code = $request->postal_code;
            $user->address->phone = $request->phone;
            $user->address->save();
        } else {
            Address::create([
                'user_id' => $user->id,
                'address' => $request->address,
                'city_id' => $request->city_id,
                'province_id' => $request->province_id,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone
            ]);
        }
    	
    	return redirect('profile')->with('success', 'Berhasil memperbaharui profil');
    }

    public function editPassword()
    {
    	$user = Auth::user();
    	return view('front.profile.change_password', compact('user'));
    }

    public function updatePassword(Request $request)
    {
    	$user = Auth::user();
    	$request->validate([
    		'old_password' => [
				'required',
				function($attribute, $value, $fail) use ($user) {
					if (!Hash::check($value, $user->password)) {
						return $fail($attribute.' is invalid');
					}
				},
			],
			'new_password' => 'required|string|min:6|confirmed'
    	]);

    	$user->password = bcrypt($request->new_password);
    	$user->save();
    	return redirect('profile')->with('success', 'Berhasil mengganti password');
    }

    public function changePhoto(Request $request)
    {
    	$request->validate([
    		'user_photo' => 'required|image|mimes:jpeg,png|max:200',
    	]);

    	$user = Auth::user();

    	if (!is_null($user->image)) {
    		File::delete(public_path('img/user/'.$user->image));
    	}

    	$filename = $this->upload_image($request, $user);
    	$user->image = $filename;
    	$user->save();

    }

    private function upload_image($request, $user)
    {
         // upload image
        $filename = $user->id . '-' .str_slug($user->name) . '.' . $request->user_photo->getClientOriginalExtension();
        $path = public_path('img/user/' . $filename);
        $image = Image::make($request->user_photo->getRealpath());
        $height = $image->height();
        $width = $image->width();
        if ($height < $width) {
            $image->crop($height, $height)->save($path); 
        } elseif ($height > $width) {
            $image->crop($width, $width)->save($path); 
        } else {
            $image->save($path);
        }
        return $filename;
    }
}
