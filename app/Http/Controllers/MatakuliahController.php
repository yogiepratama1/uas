<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    public function pilihMatakuliah()
    {
        $matakuliahs = Matakuliah::all();

        return view('dashboard-pilih-matakuliah', compact('matakuliahs'));
    }

    public function create()
    {
        return view('dashboard-create-matakuliah');
    }

    public function edit(Matakuliah $matakuliah)
    {

        return view('dashboard-edit-matakuliah', compact('matakuliah'));
    }

    public function store(Request $request)
    {
        if ($request->create == '1') {
            Matakuliah::create([
                'nama' => $request->nama,
                'sks' => $request->sks,
            ]);

            $msg = 'Matakuliah berhasil ditambahkan';
        } elseif ($request->pilih == '1') {
            foreach ($request->matakuliah_id as $matakuliah_id) {
                Nilai::create([
                    'user_id' => $request->user_id,
                    'matakuliah_id' => $matakuliah_id,
                ]);
            }
            $msg = 'Matakuliah berhasil ditambahkan';
            return redirect()->route('dashboard-mahasiswa')->with('success', $msg);
        } elseif ($request->pilih_admin == '1') {
            Nilai::create([
                'user_id' => $request->user_id,
                'matakuliah_id' => $request->matakuliah_id,
                'nilai_tugas' => $request->nilai_tugas,
                'nilai_uts' => $request->nilai_uts,
                'nilai_uas' => $request->nilai_uas,
            ]);

            $msg = 'Matakuliah dan nilai berhasil ditambahkan';
            return redirect()->route('dashboard-mahasiswa')->with('success', $msg);
        } else {
            $matakuliah = Matakuliah::find($request->id);
            $matakuliah->update([
                'sks' => $request->sks,
                'nama' => $request->nama,
            ]);

            $msg = 'Matakuliah berhasil diubah';
        }

        return redirect()->route('dashboard-matakuliah')->with('success', $msg);
    }

    public function destroy(Matakuliah $matakuliah)
    {
        $matakuliah->delete();

        return redirect()->route('dashboard-matakuliah')->with('success', 'Matakuliah berhasil dihapus');
    }
}
