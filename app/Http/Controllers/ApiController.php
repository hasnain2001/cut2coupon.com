<?php

namespace App\Http\Controllers;

use App\Models\Stores;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ApiController extends Controller
{
    public function getStores(Request $request)
    {
        // Assuming you have a Store model and you want to return all stores
        $stores = Stores::all();

        return response()->json([
            'stores' => $stores
        ]);
    }


    public function add (Request $request)
    {
      return $request->input();
    }

}
