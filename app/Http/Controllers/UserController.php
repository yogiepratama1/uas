<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use App\Models\Nilai;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function indexNilai(User $user)
    {
        return view('dashboard-nilai-mahasiswa', compact('user'));
    }

    public function tambahNilai(User $user)
    {
        $matakuliahs = Matakuliah::all();
        return view('dashboard-tambah-nilai-mahasiswa', compact('user', 'matakuliahs'));
    }

    public function editNilai(Nilai $nilai)
    {
        return view('dashboard-edit-nilai-mahasiswa', compact('nilai'));
    }

    public function create()
    {
        return view('dashboard-create');
    }

    public function edit(User $user)
    {
        return view('dashboard-edit', compact('user'));
    }

    public function store(Request $request)
    {
        if ($request->create == '1') {
            User::create([
                'nim' => $request->nim,
                'name' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
            ]);

            $msg = 'Mahasiswa berhasil ditambahkan';
        } else {
            $user = User::find($request->id);
            $user->update([
                'nim' => $request->nim,
                'name' => $request->name,
                'jenis_kelamin' => $request->jenis_kelamin,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'user',
            ]);

            $msg = 'Mahasiswa berhasil diubah';
        }

        return redirect()->route('dashboard-mahasiswa')->with('success', $msg);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard-mahasiswa')->with('success', 'Mahasiswa berhasil dihapus');
    }

    public function destroyNilai(Nilai $nilai)
    {
        $nilai->delete();

        return redirect()->route('dashboard-mahasiswa')->with('success', 'Nilai berhasil dihapus');
    }
}
