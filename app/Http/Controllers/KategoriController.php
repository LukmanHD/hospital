<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kategori;
use App\Tempat;
use Validator;
use Crypt;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image_file' => 'required|image|max:3000'
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $request->file('image_file')->move(public_path('images'), $request->file('image_file')->getClientOriginalName());

        $datas = new kategori();
        $datas->nama_kategori   = $request['kategori'];
        $datas->image           = $request->file('image_file')->getClientOriginalName();
        $datas->save();

        return redirect('/tempat')->with('status', 'Account Added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
               $validator = Validator::make($request->all(),[
            'image_file' => 'required|image|max:3000'
        ]);

        if($validator->fails()){
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $request->file('image_file')->move(public_path('images'), $request->file('image_file')->getClientOriginalName());

        $datas = kategori::find($id);
        $datas->nama_kategori   = $request['kategori'];
        $datas->image           = $request->file('image_file')->getClientOriginalName();
        $datas->update();

        return redirect('/tempat')->with('status', 'Account Added!');
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $data = kategori::find($id);

       $data->delete();

       return redirect()->to('/tempat'); 
    }
}
