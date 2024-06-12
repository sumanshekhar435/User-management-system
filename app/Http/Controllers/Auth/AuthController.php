<?php

namespace App\Http\Controllers\Auth;

use Session;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function index(): View
    {
        return view('auth.login');
    }

    public function registration(): View
    {
        return view('auth.registration');
    }

    public function postLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                ->with('success', 'You have successfully logged in');
        }

        return redirect("login")->with('error', 'Oops! You have entered invalid credentials');
    }

    public function postRegistration(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'regex:/^[a-zA-Z\s]+$/', 'max:50'],
            'last_name' => ['nullable', 'regex:/^[a-zA-Z\s]+$/', 'max:50'],
            'email' => 'required|email|unique:users,email|max:50',
            'mobile_number' => 'required|numeric|unique:users,mobile_number|digits:10',
            'date_of_birth' => 'required|date',
            'gender' => ['required', Rule::in(['Male', 'Female', 'Other'])],
            'address' => 'nullable|string|max:200',
            'password' => [
                'required',
                'string',
                'max:20',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[@$!%*?&]/',
                'confirmed'
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        $user = $this->create($data);

        // Redirect to the login page with a success message
        return redirect()->route('login')->with('success', 'Great! You have successfully registered. Please log in.');
    }

    public function dashboard(): View
    {
        if (Auth::check()) {
            return view('dashboard');
        }

        return redirect("login")->with('error', 'Oops! You do not have access');
    }

    public function create(array $data): User
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'mobile_number' => $data['mobile_number'],
            'date_of_birth' => $data['date_of_birth'],
            'gender' => $data['gender'],
            'address' => $data['address'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function logout(): RedirectResponse
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('login');
    }
}