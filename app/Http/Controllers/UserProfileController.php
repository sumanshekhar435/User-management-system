<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\FileSizeBetween;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('user-profile', compact('user'));
    }

    public function postEdit(Request $request)
    {
        $request->validate([
            'first_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:50'],
            'last_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/', 'max:50'],
            'email' => 'required|email|unique:users,email,' . Auth::id() . '|max:50',
            'mobile_number' => 'required|numeric|unique:users,mobile_number,' . Auth::id() . '|digits:10',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'address' => 'nullable|string|max:200',
            'password' => [
                'nullable',  // Password is not required when updating profile
                'string',
                'max:20',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[@$!%*?&]/',
                'confirmed'
            ],
        ]);
        $user = Auth::user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->date_of_birth = $request->date_of_birth;
        $user->gender = $request->gender;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->address = $request->address;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profile updated successfully.');
    }

    public function uploadProfileImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png', new FileSizeBetween(100, 1024)],
        ], [
            'image.required' => 'Please select an image to upload.',
            'image.image' => 'The file must be an image (jpeg, jpg, png).',
            'image.mimes' => 'The image must be a file of type: jpeg, jpg, png.',
            'image.max' => 'The image size must not exceed 1MB.',
        ]);

        $user = Auth::user();

        $image = $request->file('image');
        if ($image) {
            if ($image->isValid()) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                if ($image->move(public_path('profile-images'), $imageName)) {
                    // Assuming you have an 'image' column in your users table
                    $user->image = 'profile-images/' . $imageName; // Store the path relative to the public directory
                    $user->save();

                    return redirect()->back()->with('success', 'Profile image uploaded successfully.');
                } else {
                    return redirect()->back()->with('error', 'Failed to upload image.');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid image file.');
            }
        } else {
            return redirect()->back()->with('error', 'No image file uploaded.');
        }
    }

    public function removeProfileImage(Request $request)
    {
        $user = Auth::user();

        // Check if the user has a profile image
        if ($user->image) {
            // Remove the profile image from storage
            if (Storage::disk('public')->exists($user->image)) {
                Storage::disk('public')->delete($user->image);
            }

            // Clear the image field in the database
            $user->image = null;
            $user->save();

            return redirect()->back()->with('success', 'Profile image removed successfully.');
        }

        return redirect()->back()->with('error', 'No profile image found.');
    }
}
