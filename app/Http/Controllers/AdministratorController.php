<?php

namespace App\Http\Controllers;

use App\Models\Administrator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdministratorController extends Controller
{
    public function indexRegister()
    {
        if (Auth::guard('administrators')->check()) {
            return redirect()->intended('/dashboard');
        }
        return view("register");
    }
    public function index()
    {
        if (Auth::guard('administrators')->check()) {
            return redirect()->intended('/dashboard');
        }
        return view("login");
    }
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
            'notelp' => 'required',
            'email' => 'required|email|unique:administrators,email',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
    
        $administrator = Administrator::create($input);
    
        event(new Registered($administrator));
    
        return redirect('/login')->with('success', 'User registered successfully.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Cek apakah email terdaftar
        $administrator = \App\Models\Administrator::where('email', $request->email)->first();
        if (!$administrator) {
            return redirect()->back()->withErrors(['email' => 'Email belum terdaftar.'])->withInput();
        }
    
        // Cek apakah password benar
        if (!Auth::guard('administrators')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back()->withErrors(['password' => 'Password salah.'])->withInput();
        }
    
        // Jika login berhasil
        /** @var \App\Models\Administrator $administrator **/
        $administrator = Auth::guard('administrators')->user();
        $token = $administrator->createToken('MyApp')->plainTextToken;
    
        // Simpan token untuk digunakan nanti jika diperlukan
        session(['token' => $token]);
    
        return redirect()->intended('/dashboard')->withSuccess('Logged in successfully');
    }



    public function dashboard()
    {
        if (Auth::guard('administrators')->check()) {
            $user = Auth::guard('administrators')->user();
            return view('dashboard', ['user' => $user]);
        } else {
            return redirect("/")->withErrors('You are not allowed to access');
        }
    }


    public function logout(Request $request)
    {
        Auth::guard('administrators')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->withSuccess('Logged out successfully');
    }




    public function loginFormRegAdmin()
    {
        // if (Auth::guard('administrators')->check() || Auth::guard('regadmin')->check()) {
            if (Auth::guard('regadmin')->check()) {
            
            return redirect()->intended('/dashboard-adminwilayah');
        }
        else if (Auth::guard('administrators')->check()) {

        }
        return view('loginRegionalAdmin');
    }

    public function loginRegAdmin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('regadmin')->attempt($credentials)) {
            /** @var \App\Models\RegionalAdmin $regadmin **/
            $regadmin = Auth::guard('regadmin')->user();
            $token = $regadmin->createToken('MyApp')->plainTextToken;

            // Store the token for later use, if needed
            session(['token' => $token]);

            return redirect()->intended('/dashboard-adminwilayah')->withSuccess('Logged in successfully');
        }

        return redirect()->intended('/login-regadmin')->withSuccess('Logged in Failed');
    }

    public function adminwilayah()
    {
        if (Auth::guard('regadmin')->check()) {
            $regadmin = Auth::guard('regadmin')->user();
            return view('dashboardAdmin', ['regadmin' => $regadmin]);
        }
        return view("loginRegionalAdmin");
    }

    



    // public function indextable(){
    //     if (Auth::guard('administrators')->check()) {
    //         $userId = Auth::guard('administrators')->user()->id;
    //         $admin = Administrator::where('id', $userId)->get();
    //         return view('Administrator.index', compact('admin'));
    //     } else {
    //         return redirect("/")->withErrors('You are not allowed to access');
    //     }
    // }
    // public function insert(Request $request){

    //     $userId = Auth::guard('administrators')->user()->id;

    //     $admin = new Administrator();

    //         $admin->name = $request->name;
    //         $admin->email = $request->email;
    //         $admin->password = $request->password;
    //         $admin->notelp = $request->notelp;


    //     $admin -> save();
    //     session()->flash('success', 'Save Data Successfully!');
    //     return Redirect('/admintable');
    // }

    // public function update(Request $request, $id)
    // {
    //     $admin = Administrator::where('id', $id)->first();
    //     $admin->name = $request->name;
    //     $admin->email = $request->email;
    //     $admin->password = $request->password;
    //     $admin->notelp = $request->notelp;
    //     $admin -> save();
    //     session()->flash('success', 'Edit Data Successfully!');
    //     return Redirect('/admintable');
    // }

    // public function delete(Request $request, $id)
    // {
    //     $admin = Administrator::where('id', $id);
    //     $admin->delete();
    //     session()->flash('success', 'Delete Data Successfully!');
    //     return redirect('/admintable');
    // }


}
