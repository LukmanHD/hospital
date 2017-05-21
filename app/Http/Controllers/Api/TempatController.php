<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tempat;
use App\Kategori;
use Response;

class TempatController extends Controller
{
	function index(){
		$datas = tempat::orderBy('id','desc')->get();

		return Response::json($datas,200);
	}

	public function kategori($id)
    {   $datas = tempat::where('kategori_id', $id)
                 		->orderBy('id','desc')
                        ->get();
        
        return Response::json($datas,200);
    }
}
