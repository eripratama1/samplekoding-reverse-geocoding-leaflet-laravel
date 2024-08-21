<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /**
         * Menambahkan method except untuk beberapa method
         * agar bisa diakses tanpa harus melakukan login / autentikasi
         */
        $this->middleware('auth')->except('categories', 'categorySpot');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    /** Method untuk menampilkan semua list kategori yang ada */
    public function categories()
    {
        return view('categories', [
            'categories' => Category::get()
        ]);
    }

    /**
     * Method yang akan menampilkan data spots
     * berdasarkan kategori yahg dipilih
     */
    public function categorySpot($slug)
    {
        $categorySpot = Category::where('slug', $slug)->with('spots')->first();
        return view('categoryspot',['categorySpot' => $categorySpot]);
    }
}
