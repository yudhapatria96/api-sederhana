<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = DB::table('product')->get();
        $response['data'] = [];

        if ($request->has('search')) {
            // menangkap data pencarian
            $cari = $request->search;

            // mengambil data dari table pegawai sesuai pencarian data
            $products = DB::table('product')->where('product_name', 'like', "%" . $cari . "%")->first();


            $response['message'] = 'Success';
            $response['status'] = true;
            $response['data'] = $products;
        } else {
            if (count($products) > 0) {
                $response['message'] = 'Success';
                $response['status'] = true;
                $response['data'] = $products;
            } else {
                $response['message'] = 'Data Kosong';
                $response['status'] = true;
            }
        }

        return $response;
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function update(Request $request, $id)
    {
        $data = array();
        $data['product_name'] = $request->product_name;
        $updated = DB::table('product')->where('id', $id)->update($data);
        return response('Update Successfully');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('product')->where('id', $id)->delete();
        return response('Deleted');
    }
}
