<?php

namespace App\Http\Controllers;

use App\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Datatables;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = Pembeli::all();
            return view ('pembeli', compact('data'));
    
    }

    public function apipembeli()
    {
            $data = Pembeli::first()->get();

            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pembeli.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id_pembeli.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })->rawColumns(['action'])->make(true);
                    return view ('pembeli', compact('data'));
    
    }
     
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pembeli::updateOrCreate(['id_pembeli' => $request->id_pembeli],
                ['nama_pembeli' => $request->nama_pembeli, 'detail' => $request->detail]);        
   
        return response()->json(['success'=>'Product saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Pembeli::find($id_pembeli);
        return response()->json($pembeli);
    }
  
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pembeli)
    {
        Product::find($id_pembeli)->delete();
     
        return response()->json(['success'=>'Product deleted successfully.']);
    }
}