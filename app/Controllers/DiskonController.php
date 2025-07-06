<?php

namespace App\Controllers;

use App\Models\DiskonModel;

class DiskonController extends BaseController
{
    protected $diskon;

    public function __construct()
    {
        $this->diskon = new DiskonModel();
        // Middleware admin
        if (session()->get('role') !== 'admin') {
            exit('Akses hanya untuk admin!');
        }
    }

    public function index()
    {
        $data['diskon'] = $this->diskon->findAll();
        return view('v_diskon', $data);
    }

    // DiskonController.php
public function create()
{
    return view('v_diskon_form');
}


    public function store()
    {
        $tanggal = $this->request->getPost('tanggal');
        $nominal = $this->request->getPost('nominal');

        // Validasi tanggal tidak boleh duplikat
        if ($this->diskon->where('tanggal', $tanggal)->first()) {
            return redirect()->back()->with('error', 'Diskon untuk tanggal ini sudah ada!');
        }

        $this->diskon->insert([
            'tanggal' => $tanggal,
            'nominal' => $nominal
        ]);

        return redirect()->to('/diskon')->with('message', 'Diskon berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data['diskon'] = $this->diskon->find($id);
        return view('v_diskon_form', $data);
    }

 public function update($id)
{
    $tanggal = $this->request->getPost('tanggal');
    $nominal = $this->request->getPost('nominal');

    // Cek apakah tanggal yang dimasukkan sudah digunakan oleh record lain
    $existing = $this->diskon
        ->where('tanggal', $tanggal)
        ->where('id !=', $id)
        ->first();

    if ($existing) {
        return redirect()->back()->with('error', 'Tanggal diskon sudah digunakan!');
    }

    // Update data
    $this->diskon->update($id, [
        'tanggal' => $tanggal,
        'nominal' => $nominal
    ]);

    return redirect()->to('/diskon')->with('message', 'Diskon berhasil diubah.');
}
    public function delete($id)
    {
        $this->diskon->delete($id);
        return redirect()->to('/diskon')->with('message', 'Diskon berhasil dihapus.');
    }
}
