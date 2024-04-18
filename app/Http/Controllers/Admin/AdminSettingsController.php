<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminSettingsController extends Controller
{
    public function index(){
        return view('admin.index');
    }

    public function adminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
    
    public function profileShow(){
        $profile=Auth::user();
        return view('admin.profile.profile_edit',compact('profile'));
    }

    public function profileUpdate(Request $request){
        $profile = Auth::user();
        $image_path = $profile->image;

        if($request->hasFile('image')){
            $oldImagePath = public_path('admin/images/profile/' . $image_path);
            if(file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('admin/images/profile'), $imageName);
            $image_path = 'admin/images/profile/'. $imageName;
        }

        $profile->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $image_path,
        ]);

        $notification = [
            'message' => 'Profil Bilgileri Güncellendi.',
            'alert-type' => 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function changePassword(){
        $profile=Auth::user();
        return view('admin.profile.change_password',compact('profile'));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'oldPassword' => 'required',
            'password' => 'required|confirmed',
        ],[
            'oldPassword.required' => 'Mevcut Şifrenizi Giriniz.',
            'password.required' => 'Yeni Şifre alanı zorunludur.',
            'password.confirmed' => 'Şifreler uyuşmuyor.',
        ]);
        $user = Auth::user();

        if(Hash::check($request->oldPassword,$user->password)){
            $user->update([
                'password' =>Hash::make($request->password),
            ]);
            $notification = [
               'message' => 'Şifre Güncellendi.',
                'alert-type' => 'success'
            ];
            return redirect()->back()->with($notification);
        }

        $notification = [
           'message' => 'Mevcut Şifrenizi yanlış girdiniz. Şifre Güncellenemedi.',
            'alert-type' => 'warning'
        ];
        return redirect()->back()->with($notification);
    }

}
