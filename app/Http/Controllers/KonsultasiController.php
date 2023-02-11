<?php

namespace App\Http\Controllers;

use App\Models\Advokat;
use App\Models\Konsultasi;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'user') {
            $konsultasis = Konsultasi::where('status', 'pending')->where('user_id', Auth::user()->id)->get();
        } else if (Auth::user()->role == 'advokat') {
            $konsultasis = Konsultasi::where('status', 'pending')->where('advokat_id', Auth::user()->id)->get();
        } else {
            $konsultasis = Konsultasi::where('status', 'pending')->get();
        }
        return view('dashboard-konsultasi', compact('konsultasis'));
    }

    public function indexProses()
    {
        if (Auth::user()->role == 'user') {
            $konsultasis = Konsultasi::where('status', 'proses')->where('user_id', Auth::user()->id)->get();
        } else if (Auth::user()->role == 'advokat') {
            $konsultasis = Konsultasi::where('status', 'proses')->where('advokat_id', Auth::user()->id)->get();
        } else {
            $konsultasis = Konsultasi::where('status', 'proses')->get();
        }
        return view('dashboard-konsultasi-proses', compact('konsultasis'));
    }

    public function indexLaporan()
    {
        if (Auth::user()->role == 'user') {
            $konsultasis = Konsultasi::where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
        } else {
            $konsultasis = Konsultasi::where('status', 'selesai')->get();
        }
        return view('dashboard-konsultasi-laporan', compact('konsultasis'));
    }

    public function indexAdminProses(Konsultasi $konsultasi)
    {
        $advokats = Advokat::all();
        return view('dashboard-konsultasi-admin-proses', compact(['konsultasi', 'advokats']));
    }

    public function indexAdvokat()
    {
        $users = User::whereHas('advokat')->get();
        return view('dashboard-advokat', compact('users'));
    }

    public function indexTambahAdvokat()
    {
        return view('dashboard-tambah-advokat');
    }

    public function indexEditAdvokat(User $user)
    {
        return view('dashboard-edit-advokat', compact('user'));
    }

    public function create()
    {
        if (Auth::user()->role != 'user') {
            $users = User::where('role', 'user')->get();
            return view('dashboard-konsultasi-create', compact('users'));
        }
        return view('dashboard-konsultasi-create');
    }

    public function edit(Konsultasi $konsultasi)
    {
        return view('dashboard-konsultasi-edit', compact('konsultasi'));
    }

    public function store(Request $request)
    {
        if ($request->create == 1) {
            if ($request->admin == 1) {
                Konsultasi::create([
                    'user_id' => $request->user_id,
                    'nama_klien' => $request->nama_klien,
                    'alamat_klien' => $request->alamat_klien,
                    'no_telp' => $request->no_telp,
                    'jenis_konsultasi' => $request->jenis_konsultasi,
                ]);
            } else {
                Konsultasi::create($request->all());
            }
            $msg = 'Konsultasi berhasil ditambahkan';
        }

        if ($request->update == 1) {
            $konsultasi = Konsultasi::find($request->id);
            $konsultasi->update($request->all());
            $msg = 'Konsultasi berhasil diupdate';
        }

        return redirect()->route('dashboard.konsultasi')->with('success', $msg);
    }

    public function storeAdvokat(Request $request)
    {
        if ($request->create == 1) {
            User::create(
                [
                    'name' => $request->nama_advokat,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                ]
            );
            $user = User::latest()->first();
            $user->update([
                'role' => 'advokat',
            ]);
            Advokat::create([
                'user_id' => $user->id,
                'nama_advokat' => $request->nama_advokat,
                'alamat_advokat' => $request->alamat_advokat,
                'no_telp' => $request->no_telp,
                'jenis_kelamin' => $request->jenis_kelamin,
                'bidang_hukum' => $request->bidang_hukum,
            ]);

            $msg = 'Advokat berhasil ditambahkan';
        }

        if ($request->update == 1) {
            $user = User::find($request->id);
            $user->update([
                'name' => $request->nama_advokat,
                'email' => $request->email,
            ]);
            $user->advokat->update($request->all());
            $msg = 'Advokat berhasil diupdate';
        }

        return redirect()->route('dashboard.konsultasi-list-avokat')->with('success', $msg);
    }

    public function destroy(Konsultasi $konsultasi)
    {
        $konsultasi->delete();

        return redirect()->route('dashboard.konsultasi')->with('success', 'Konsultasi berhasil dihapus');
    }

    public function destroyAdvokat(User $user)
    {
        $user->delete();

        return redirect()->route('dashboard.konsultasi-list-avokat')->with('success', 'Advokat berhasil dihapus');
    }

    public function proses(Request $request)
    {
        Konsultasi::where('id', $request->id)->update([
            'advokat_id' => $request->advokat_id,
            'tanggal_konsultasi' => $request->tanggal_konsultasi,
            'status' => 'proses',
        ]);

        return redirect()->route('dashboard.konsultasi')->with('success', 'Konsultasi berhasil diproses');
    }

    public function selesai(Konsultasi $konsultasi)
    {
        $konsultasi->status = 'selesai';
        $konsultasi->save();

        return redirect()->route('dashboard.konsultasi')->with('success', 'Konsultasi berhasil diselesaikan');
    }

    public function exportLaporan(Request $request)
    {
        if (Auth::user()->role == 'user') {
            if ($request->date) {
                $konsultasis = Konsultasi::whereDate('tanggal_konsultasi', $request->date)->where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
                $tanggal = Carbon::parse($request->date)->format('d F Y');
            } else {
                $konsultasis = Konsultasi::where('user_id', Auth::user()->id)->where('status', 'selesai')->get();
                $tanggal = Carbon::now()->format('d F Y');
            }
        } else {
            if ($request->date) {
                $konsultasis = Konsultasi::whereDate('tanggal_konsultasi', $request->date)->where('status', 'selesai')->get();
                $tanggal = Carbon::parse($request->date)->format('d F Y');
            } else {
                $konsultasis = Konsultasi::where('status', 'selesai')->get();
                $tanggal = Carbon::now()->format('d F Y');
            }
        }
        $pdf = FacadePdf::loadView('dashboard-konsultasi-laporan-export', compact('konsultasis', 'tanggal'));
        return $pdf->download('laporan-konsultasi.pdf');
    }
}
