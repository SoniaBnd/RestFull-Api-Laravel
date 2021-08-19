<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Http\Request;	

class LoginController extends Controller
{
		public function __construct()
{
    $this->middleware('auth:web')->except('signOut','index');
}
	
     public function login1(){
		
		return view('login');	
	
    }
	
	
	 public function index()
    {
        return view('auth.login');
    }  
      

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
			return redirect("dashboard")
            // return redirect()->intended('dashboard')
                        ->withSuccess('Signed in');
        }/*else
			{
				$token = auth()->attempt($credentials);
				return $token;
			}*/
  
        return redirect("login")->withSuccess('Login details are not valid');
    }



    public function registration()
    {
        return view('auth.registration');
    }
      

    public function customRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('You have signed-in');
    }


    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            return view('auth.dashboard');
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
	
	protected function guard()
{
    // specify the guard that should be used for login attempts
    return Auth::guard('web');
}
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
}
