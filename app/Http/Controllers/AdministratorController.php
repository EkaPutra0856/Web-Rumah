<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'message' => $message,
            'body'    => $result,
        ];

        return response()->json($response, 200);
    }

    public function sendError($error, $errorMessages = [], $code = 401)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages)) {
            $response['body'] = $errorMessages;
        }

        return response()->json($response, $code);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:administrators',
            'password' => 'required',
            'c_password' => 'required|same:password'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $administrator = Administrator::create($input);

        event(new Registered($administrator));

        $success['token'] = $administrator->createToken('MyApp')->plainTextToken;
        $success['name'] = $administrator->name;

        return $this->sendResponse($success, 'User registered successfully.');
    }

    public function login(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $credentials = $request->only('email', 'password');

    if (Auth::guard('administrators')->attempt($credentials)) {
        /** @var \App\Models\Administrator $administrator **/
        $administrator = Auth::guard('administrators')->user();
        $token = $administrator->createToken('MyApp')->plainTextToken;
    
        // Store the token for later use, if needed
        session(['token' => $token]);
    
        return redirect()->intended('/dashboard')->withSuccess('Logged in successfully');
    }

    return redirect()->back()->withErrors('Login details are not valid')->withInput();
}

    

    public function dashboard()
    {
        if (Auth::guard('administrators')->check()) {
            return view('dashboard');
        }

        return redirect("/")->withErrors('You are not allowed to access');
    }

    public function logout(Request $request)
    {
        Auth::guard('administrators')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->withSuccess('Logged out successfully');
    }
}
