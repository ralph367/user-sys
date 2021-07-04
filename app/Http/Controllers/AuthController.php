<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Hash;
use Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('user.login');
    }

    public function checkCredentials(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->with('success', 'Successfully signed in');
        }
  
        return redirect("login")->with('fail','Email/Password is not correct');
    }
    
    
    public function registration()
    {
        return view('user.register');
    }
      

    public function register(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->createUser($data);
         
        return redirect("login")->withSuccess('Account created please login');
    }


    public function createUser(array $data)
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
            if (auth()->user()->is_admin == 1) {
                return view('dashboard')->with('role', 'You are an admin');
            }else{
                return view('dashboard')->with('role', 'You have no role');
            }
        }
  
        return redirect("login")->withSuccess('You are not allowed to access');
    }
    

    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }
    
    
    public function settings()
    {
        return view('settings')->with('users', User::all());
    }
    
    
    public function delete($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return redirect('settings')->with('users', User::all());
       }
    }
    
    
    public function makeAdmin($id)
    {
        $user = User::find($id);
        $user->is_admin = 1;
        $save = $user->save();
        if ($save) {
            return redirect('settings')->with('users', User::all());
       }
    }


}
