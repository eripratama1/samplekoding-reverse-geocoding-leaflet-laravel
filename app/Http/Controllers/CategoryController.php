<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreCategoryRequest;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     /**
      * Method berikut akan melakukan query ke table categories
      * lalu mereturn datanya menggunakan datatables dengan format json
      */
    public function getCategories()
    {
        $model = Category::query();
        return DataTables::eloquent($model)
        ->addColumn('action','category.action')
        ->toJson();
    }

    public function index()
    {
        return view('category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * Memuat form validation request jika validasi berhasil simpan data
     * ke tabel categories dan jalankan kode untuk proses upload file image
     * ke storage cloudinary jika terdapat file gambar yang di upload
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->validated();
        $uploadIcon = $request->file('icon');

        if ($uploadIcon) {
            $uploadResult = Cloudinary::upload($uploadIcon->getRealPath(),[
                'folder' => 'samplekoding/laravel-reverse-geocoding/icon-img'
            ]);
            $data['icon'] = $uploadResult->getSecurePath();
            $data['public_id'] = $uploadResult->getPublicId();
        }
        Category::create($data);
        return to_route('category.index')->with('success','Category inserted');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
