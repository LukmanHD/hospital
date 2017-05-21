<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tempat;
use App\Kategori;
use Validator;
use Crypt;

class TempatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = tempat::orderBy('id','desc')->paginate(5);
        $kategori = kategori::all();
		return view('tempat.index', [
                            'datas'     => $datas, 
                            'kategori'  => $kategori
                    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kategori = kategori::all();
        return view('tempat.create', ['kategori' => $kategori]);
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

        $datas = new tempat();
        $datas->nama_tempat = $request['tempat'];
        $datas->kategori_id = $request['kategori'];
        $datas->alamat      = $request['alamat'];
        $datas->keterangan  = $request['keterangan'];
        $datas->latitude    = $request['latitude'];
        $datas->longitude   = $request['longitude'];
        $datas->image       = $request->file('image_file')->getClientOriginalName();
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
         $id=Crypt::decrypt($id);
        $data = tempat::where('id', $id)->first();
        
        $kategori = kategori::all();

        return View('tempat.edit',[
            'data' => $data,
            'kategori' => $kategori
        ]);
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
        if(!empty($request->file('image_file'))){
            
            $validator = Validator::make($request->all(),[
                'image_file' => 'required|image',
            ]);

            if($validator->fails()){
                return Redirect::back()->withErrors($validator)->withInput();
            }
        }
        
        $datas = tempat::find($id);

        if(!empty($request->file('image_file'))){
            $request->file('image_file')->move(public_path('images'), $request->file('image_file')->getClientOriginalName());
            $datas->image =$request->file('image_file')->getClientOriginalName();
        }         

        $datas->nama_tempat = $request['tempat'];
        $datas->kategori_id = $request['kategori'];
        $datas->alamat      = $request['alamat'];
        $datas->keterangan  = $request['keterangan'];
        $datas->latitude    = $request['latitude'];
        $datas->longitude   = $request['longitude'];
        $datas->update();


     return redirect('/tempat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = tempat::find($id);

       $data->delete();

       return redirect()->to('/tempat'); 
    }
}
