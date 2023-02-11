<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nilai;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    public function store(Request $request)
    {
        $nilai = Nilai::where('id', $request->id)->first();

        $total = 0;
        $total += $nilai->nilai_tugas + $nilai->nilai_uts + $nilai->nilai_uas;
        $nilai_total = $total / 3;

        if ($nilai_total >= 85) {
            $nilai_bobot = 4;
        } elseif ($nilai_total >= 75 && $nilai_total < 84) {
            $nilai_bobot = 3;
        } elseif ($nilai_total >= 60  && $nilai_total < 74) {
            $nilai_bobot = 2;
        } elseif ($nilai_total >= 50  && $nilai_total < 59) {
            $nilai_bobot = 1;
        } elseif ($nilai_total >= 40 && $nilai_total < 49) {
            $nilai_bobot = 0;
        }

        $nilai->update([
            'nilai_bobot' => $nilai_bobot,
            'nilai_total' => $nilai_total,
            'nilai_tugas' => $request->nilai_tugas,
            'nilai_uts' => $request->nilai_uts,
            'nilai_uas' => $request->nilai_uas,
        ]);


        return redirect()->route('dashboard-mahasiswa')->with('success', 'Nilai berhasil diubah');
    }

    public function storeIpk(Request $request)
    {
        $user = User::where('id', $request->id)->first();

        $total_bobot = 0;
        $total_sks = 0;
        foreach ($user->nilais as $nilai) {
            $total_sks += $nilai->matakuliah->sks;
            $total_bobot += ($nilai->nilai_bobot * $nilai->matakuliah->sks);
        }

        $ipk = $total_bobot / $total_sks;

        $user->update([
            'ipk' => $ipk,
        ]);

        return redirect()->route('dashboard-mahasiswa')->with('success', 'IPK berhasil diubah');
    }
}
