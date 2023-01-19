<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function cimageShow($image)
    {
        $path = 'E:/hpics-cjpeb/' . $image . '.jpg';
        if (!file_exists($path)) {
            return response()->json(['error' => 'File not found'], 404);
        }
        return response()->file($path);
    }

    public function fileShow($file)
    {
        $client = new Client();
        $response = $client->get("file.php?file=$file");
        $data = json_decode($response->getBody(), true);

        if(!isset($data['file'])){
            return redirect('/not-found');
        }
        return view('books.index', ['file' => $data['file']]);
    }

    public function notfound() 
    {
        return view('vendor.404');
    }
}
