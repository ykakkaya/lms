<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories=SubCategory::latest()->get();
        return view('admin.subcategory.index',compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=Category::all();
        return view('admin.subcategory.create',compact('categories'));
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
            $image->move(public_path('admin/images/subcategory'), $imageName);
            $image_path = 'admin/images/subcategory/'. $imageName;
        };
        SubCategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $image_path,
        ]);
        $notification = array(
           'message' => 'Alt Kategori Başarıyla Oluşturuldu',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.subcategory.index')->with($notification);
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
        $categories=Category::all();
        $subcategory=SubCategory::findOrFail($id);
        return view('admin.subcategory.edit',compact('subcategory','categories'));
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
        $subcategory=SubCategory::findorfail($id);
        $image_path = $subcategory->image;
        if($request->hasFile('image')){
            if($image_path!=NULL){
                unlink($image_path);
            }
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('admin/images/subcategory'), $imageName);
            $image_path = 'admin/images/subcategory/'. $imageName;
        };
        $subcategory->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'image' => $image_path,
        ]);
        $notification = array(

           'message' => 'Alt Kategori Başarıyla Güncellendi',
            'alert-type' =>'success'
        );
        return redirect()->route('admin.subcategory.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory=SubCategory::findorfail($id);
        if($subcategory->image!=NULL){
            unlink($subcategory->image);
        };
        $subcategory->delete();

        return redirect()->route('admin.subcategory.index');
    }
}
