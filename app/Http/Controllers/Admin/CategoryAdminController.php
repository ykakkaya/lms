<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::latest()->get();
        return view('admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name.required' => 'Kategori Adını Giriniz',
            'image.mimes' => 'Girdiğiniz resim formatı desteklenmiyor',
        ]);
        $image_path = NULL;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('admin/images/category'), $imageName);
            $image_path = 'admin/images/category/'. $imageName;
        }

        $category->create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ','-',$request->name)),
            'image' => $image_path,
        ]);
        $notification = array(
           'message' => 'Kategori Başarıyla Eklendi',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.category.index')->with($notification);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category=Category::findOrFail($id);
        return view('admin.category.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' =>'required|string|max:255',
            'image' =>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],[
            'name.required' => 'Kategori Adını Giriniz',
            'image.mimes' => 'Girdiğiniz resim formatı desteklenmiyor',
        ]);
        $category=Category::findorfail($id);
        $image_path = $category->image;
        if($request->hasFile('image')){
            if($image_path!=NULL){
                unlink($image_path);
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('admin/images/category'), $imageName);
            $image_path = 'admin/images/category/'. $imageName;
        };
        $category->update([
            'name' => $request->name,
            'image' => $image_path,
        ]);
        $notification = array(
           'message' => 'Kategori Başarıyla Güncellendi',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.category.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category=Category::findorfail($id);
        $image_path = $category->image;
        if($image_path!=NULL){
            unlink($image_path);
        }
        $category->delete();
        $notification = array(
           'message' => 'Kategori Başarıyla Silindi',
            'alert-type' => 'error'
        );
        return redirect()->route('admin.category.index')->with($notification);
    }
}
