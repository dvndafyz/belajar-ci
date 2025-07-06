<?php

namespace App\Controllers;

use App\Database\Migrations\Transaction;
use App\Models\ProductModel; 
use App\Models\TransactionModel;
use App\Models\TransactionDetailModel;

class Home extends BaseController
{
     protected  $product;
     protected  $transaction;
     protected $transaction_detail;

     function __construct()
     {
        helper('form');
        helper('number');
        $this->product = new ProductModel();
        $this->transaction = new TransactionModel();
        $this->transaction_detail = new TransactionDetailModel();
     }

   public function index(): string
{
    $product = $this->product->findAll();

    // Ambil diskon aktif hari ini
    $diskonModel = new \App\Models\DiskonModel(); // <- Ini WAJIB
    $today = date('Y-m-d');
    $diskon = $diskonModel->where('tanggal', $today)->first();
    $nominalDiskon = $diskon ? $diskon['nominal'] : 0;

    // Tambahkan harga setelah diskon
    foreach ($product as &$p) {
        $p['harga_asli'] = $p['harga'];
        $p['harga_setelah_diskon'] = max(0, $p['harga'] - $nominalDiskon);
    }

    $data['product'] = $product;
    $data['diskon'] = $diskon;

    return view('v_home', $data);
}

    public function profile()
{
    $username = session()->get('username');
    $data['username'] = $username;

    $buy = $this->transaction->where('username', $username)->findAll();
    $data['buy'] = $buy;

    $product = [];

    if (!empty($buy)) {
        foreach ($buy as $item) {
            $detail = $this->transaction_detail->select('transaction_detail.*, product.nama, product.harga, product.foto')->join('product', 'transaction_detail.product_id=product.id')->where('transaction_id', $item['id'])->findAll();

            if (!empty($detail)) {
                $product[$item['id']] = $detail;
            }
        }
    }

    $data['product'] = $product;

    return view('v_profile', $data);
}
}