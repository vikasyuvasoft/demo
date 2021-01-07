<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
   public function adminlogin(){
   	return view('adminlogin');
   }
}
