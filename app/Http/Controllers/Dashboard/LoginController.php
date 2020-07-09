<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    // get login form
   public function login(){
       return view('dashboard.login');
   }
// post login form with check data in db
   public function Postlogin(LoginRequest $request){
    $remember_me = $request->has('remember_me') ? true : false;
      if(auth()->guard('admin')->attempt(['email'=> $request->input("email"), 'password'=> $request->input("password")])){
        return redirect()->route('dashboard.index');
    }
      return redirect()->back()->with(['error'=> 'خطأ فى البيانات']);
     }
}
