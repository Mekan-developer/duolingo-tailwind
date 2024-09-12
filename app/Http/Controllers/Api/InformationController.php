<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InformationResource;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
   /**
     * @OA\Get(
     *      path="/informations",
     *      tags={"Informations"},
     *      summary="Get all screen informations",
     *      description="",
     *      @OA\Response(response=200,description="Information retrived successfully")
     * )
     */

     public function index(){
        $informations = InformationResource::collection(Information::all());
        return response()->json($informations,200);
    }
}
