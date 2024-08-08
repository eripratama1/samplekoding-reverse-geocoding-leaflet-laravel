<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SpotResource;
use App\Models\Spot;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SpotController extends Controller
{
    public function index()
    {
        /** Bisa Tambahkan kondisi tertentu jika diperlukan */
        $spots = Spot::get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => SpotResource::collection($spots)
        ], Response::HTTP_OK);
    }

    public function show($slug)
    {
        /** Bisa Tambahkan kondisi tertentu jika diperlukan */
        $spots = Spot::where('slug', $slug)->get();
        return response()->json([
            'status' => Response::HTTP_OK,
            'data' => SpotResource::collection($spots)
        ], Response::HTTP_OK);
    }
}
