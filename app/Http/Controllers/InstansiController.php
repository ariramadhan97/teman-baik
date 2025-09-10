<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use App\Http\Requests\StoreinstansiRequest;
use App\Http\Requests\UpdateinstansiRequest;
use App\Models\Pengaduan;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function index()
    {
        //
        $data['instansi'] = Instansi::all();
        return view('manajemen-instansi', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreinstansiRequest $request)
    {
        //
        $validData = $request->validate([
            'nama_instansi' => 'required',
            'email1' => 'required|email:rfc,dns',
            'email2' => 'nullable|email:rfc,dns',
            'email3' => 'nullable|email:rfc,dns',
            'no_wa1' => 'nullable|regex:/^[08][0-9]*$/i'
        ]);

        Instansi::create($validData);
        return redirect('/manajemen-instansi')->with('success', 'Instansi Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(instansi $instansi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Instansi::where('id', $id)->first();
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateinstansiRequest $request, instansi $instansi)
    {
        //

        $validData = $request->validate([
            'editNamaInstansi' => 'required',
            'Editemail1' => 'required|email:rfc,dns',
            'Editemail2' => 'nullable|email:rfc,dns',
            'Editemail3' => 'nullable|email:rfc,dns',
            'Editno_wa1' => 'nullable|regex:/^[08][0-9]*$/i'
        ]);

        $newData['nama_instansi'] = $validData['editNamaInstansi'];
        $newData['email1'] = $validData['Editemail1'];
        $newData['email2'] = $validData['Editemail2'];
        $newData['email3'] = $validData['Editemail3'];
        $newData['no_wa1'] = $validData['Editno_wa1'];

        Instansi::where('id', $request->id)->update($newData);
        return redirect('/manajemen-instansi')->with('success', 'Instansi Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $data_pengaduan = Pengaduan::where('id_instansi', $id)->get();
        if (count($data_pengaduan)) {
            return response()->json([
                'success' => true,
                'message' => 'Instansi Gagal Dihapus Karena Memiliki Pengaduan',
                'icon' => 'error'
            ]);
        } else {
            Instansi::destroy($id);
            // Instansi::destroy($instansi);
            // return redirect('/manajemen-instansi')->with('success', 'Instansi Berhasil Dihapus');
            return response()->json([
                'success' => true,
                'message' => 'Instansi Berhasil Dihapus',
                'icon' => 'success'
            ]);
        }
    }
}
