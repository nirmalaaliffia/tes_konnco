<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;

class ProdukController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user= Auth::user()->id;
        $produk=Produk::all();
        return view('produk', [
            'produk' => $produk,
            'id_user' => $id_user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('produk.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_produk' => 'required|max:255',
            'harga_produk' =>'required',
            'gambar_produk' => 'required',
            'status_produk' => 'required'

        ]);
       
        if($request->hasFile('gambar_produk')){
            $gambar_produk=$request->file('gambar_produk');
         
            foreach($gambar_produk as $gambar_produk){
                $nama_file = $gambar_produk->getClientOriginalName();
                $fileName = pathinfo($nama_file, PATHINFO_FILENAME);
                $extension = $gambar_produk->getClientOriginalExtension();
                $fileName = $fileName.'_'.time().'.'.$extension;
    
                $path = $gambar_produk->storeAs('post_gambar', $fileName, 'public');
    
                
                Produk::create([
                    'nama_produk' =>  $validateData['nama_produk'],
                    'harga' =>  $validateData['harga_produk'],
                    'status' =>  $validateData['status_produk'],
                    'nama_gambar' =>  $fileName,
                    'path_gambar' =>  '/storage/'.$path,
                    'id_pembuat' => Auth::user()->id
                ]);
            }
    
    
        }
    
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan !');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy( $produk)
    {
        Produk::where('id', '=', $produk)->delete();
      
        return redirect()->route('produk.index')->withDanger('Data Berhasil Di Hapus');
    }
}
