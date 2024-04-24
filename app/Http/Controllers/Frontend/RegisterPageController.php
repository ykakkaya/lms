<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterPageController extends Controller
{
    public function instructorRegister(){
        return view('frontend.instructor_register');
    }

    public function instructorStore(Request $request){
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'instructor',
            'status'=> '0'
        ]);
        return redirect()->route('frontend.login');
    }
}
