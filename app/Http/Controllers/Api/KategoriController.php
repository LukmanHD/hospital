<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kategori;
use Response;

class KategoriController extends Controller
{
    function index(){
		$datas = Kategori::all();

		return Response::json($datas,200);
	}
}
