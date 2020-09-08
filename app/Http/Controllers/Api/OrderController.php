<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function show(Request $request)
    {
        if ($request->has('id_pelanggan')) {
            $orders = DB::table('order')->where('pelanggan_id', $request->id_pelanggan)->get();
            $response['message'] = 'Success';
            $response['status'] = true;
            $response['data'] = $orders;
        } else {
            $response['data'] = [];
            $response['message'] = 'Masukkan Id Pelanggan';
            $response['status'] = false;
        }



        return $response;
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_id' => 'required',
            "product_name" => 'required',
            "price" => 'required',
            "pelanggan_id" => 'required',
            "qty" => 'required'
        ]);
        $dataUpdateProduct = array();
        $dataProduct = DB::table('product')->where('id', $request->product_id)->first();
        $dataUpdateProduct['stock'] = ($dataProduct->stock) - ($request->qty);
        $updated = DB::table('product')->where('id', $request->product_id)->update($dataUpdateProduct);


        $data = array();
        $mytime = Carbon::now();
        $data['order_code'] = $mytime->toDateTimeString();
        $data['product_id'] = $request->product_id;
        $data['product_name'] = $request->product_name;
        $data['pelanggan_id'] = $request->pelanggan_id;
        $data['price'] = $request->price;
        $data['qty'] = $request->qty;
        $data['created_at'] = $mytime->toDateTimeString();
        $data['updated_at'] = $mytime->toDateTimeString();
        $insert = DB::table('order')->insert($data);

        $response['message'] = 'Pesanan Berhasil Dibuat';
        $response['status'] = true;
        return $response;
    }
}
