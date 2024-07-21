<?php

namespace App\Http\Controllers;

use App\Http\Requests\Spot\StoreSpotRequest;
use App\Models\Category;
use App\Models\Spot;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('spot.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spot.create',[
            'category' => Category::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * Memuat form request validation (StoreSpotRequest)
     */
    public function store(StoreSpotRequest $request)
    {
        /** Melakukan validasi data */
        $data = $request->validated();

        /**
         * Jika user mengupload file gambar jalankan kde dibawah
         * lalu simpan gambar tersebut pada folder yang sudah didefinisikan ke storage cloudinary
         */
        $uploadImage = $request->file('image_path');
        if ($uploadImage) {
            $uploadResult = Cloudinary::upload($uploadImage->getRealPath(),[
                'folder' => 'samplekoding/laravel-reverse-geocoding/img-spot'
            ]);
            $data['image_path'] = $uploadResult->getSecurePath();
            $data['public_id'] = $uploadResult->getPublicId();
        }

        /** Lakukan prose store data ke tabel spots */
        Spot::create($data);
        return to_route('spot.index')->with('success',"Spot inserted");
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