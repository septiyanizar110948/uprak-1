<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('id', 'asc')->get();
        return view('menu.index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'menu' => 'required|string',
            'jumlah' => 'required|numeric',
            'harga' => 'required|numeric',
            'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $namaFile = $request->file('gambar_barang')->getClientOriginalName();

        $request->file('gambar_barang')->move(public_path('gambar'), $namaFile);

        $menu = Menu::create([
            'menu' => $request->menu,
            'jumlah' => $request->jumlah,
            'harga' => $request->harga,
            'gambar_barang' => 'gambar/' . $namaFile,
        ]);


        return redirect()->route('menu.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
