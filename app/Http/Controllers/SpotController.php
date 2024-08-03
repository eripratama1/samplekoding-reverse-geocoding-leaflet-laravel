<?php

namespace App\Http\Controllers;

use App\Http\Requests\Spot\StoreSpotRequest;
use App\Http\Requests\Spot\UpdateSpotRequest;
use App\Models\Category;
use App\Models\Spot;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SpotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getSpots()
    {
        $model = Spot::query();
        return DataTables::eloquent($model)
        ->addColumn('action','spot.action')
        ->addColumn('category_name',function(Spot $spot) {
            return $spot->category->name;
        })
        ->toJson();
    }

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
    public function edit(Spot $spot)
    {
        return view('spot.edit',[
            'spot' => $spot,
            'category' => Category::get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpotRequest $request, Spot $spot)
    {
        $data = $request->validated();

        if ($uploadImage = $request->file('image_path')) {
            if ($spot->public_id) {
                Cloudinary::destroy($spot->public_id);
            }

            $uploadResult = Cloudinary::upload($uploadImage->getRealPath(),[
                'folder' => 'samplekoding/laravel-reverse-geocoding/img-spot'
            ]);
            $data['image_path'] = $uploadResult->getSecurePath();
            $data['public_id'] = $uploadResult->getPublicId();
        }

        $spot->update($data);
        return to_route('spot.index')->with('success','Spot updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spot $spot)
    {
        $name = $spot->name;
        if ($spot->public_id) {
            Cloudinary::destroy($spot->public_id);
        }
        $spot->delete();
        return to_route('spot.index')->with('success',"Spot \"$name\" deleted");
    }
}
