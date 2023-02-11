<?php

use App\Models\User;
use App\Models\Nilai;
use App\Models\Matakuliah;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\MatakuliahController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', function () {
    if (Auth()->user()->role == 'admin') {
        $users = User::where('role', 'user')->get();
        return view('dashboard', compact('users'));
    } else {
        $user = User::where('id', Auth()->user()->id)->first();
        $nilais = Nilai::where('user_id', Auth()->user()->id)->get();
        return view('dashboard', compact('nilais', 'user'));
    }
})->middleware(['auth', 'verified'])->name('dashboard-mahasiswa');

Route::get('/dashboard/matakuliah', function () {
    if (Auth()->user()->role == 'admin') {

        $matakuliahs = Matakuliah::all();
        return view('dashboard-matakuliah', compact('matakuliahs'));
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard-matakuliah');

Route::get('/dashboard/pilih/matakuliah', [MatakuliahController::class, 'pilihMatakuliah'])->name('dashboard.matakuliah-pilih');


Route::middleware('auth')->group(function () {
    Route::get('/dashboard/list', [UserController::class, 'index'])->name('dashboard.list');
    Route::get('/dashboard/tambah', [UserController::class, 'create'])->name('dashboard.tambah');
    Route::get('/dashboard/{user}', [UserController::class, 'edit'])->name('dashboard.edit');
    Route::get('/dashboard/nilai/{user}', [UserController::class, 'indexNilai'])->name('dashboard.nilai-mahasiswa');
    Route::get('/dashboard/nilai/{nilai}/edit', [UserController::class, 'editNilai'])->name('dashboard.edit-nilai-mahasiswa');
    Route::get('/dashboard/nilai/{user}/tambah', [UserController::class, 'tambahNilai'])->name('dashboard.tambah-nilai-mahasiswa');
    Route::delete('/dashboard/nilai/{nilai}/delete', [UserController::class, 'destroyNilai'])->name('dashboard.delete-nilai-mahasiswa');
    Route::post('/dashboard/nilai/store', [NilaiController::class, 'store'])->name('dashboard.store-nilai-mahasiswa');
    Route::post('/dashboard/ipk/store', [NilaiController::class, 'storeIpk'])->name('dashboard.store-nilai-mahasiswa');
    Route::post('/dashboard/store', [UserController::class, 'store'])->name('dashboard.store');
    Route::delete('/dashboard/{user}/delete', [UserController::class, 'destroy'])->name('dashboard.delete');

    Route::get('/dashboard/list', [MatakuliahController::class, 'index'])->name('dashboard.matakuliah-list');
    Route::get('/dashboard/tambah/matakuliah', [MatakuliahController::class, 'create'])->name('dashboard.matakuliah-tambah');
    Route::get('/dashboard/{matakuliah}/matakuliah', [MatakuliahController::class, 'edit'])->name('dashboard.matakuliah-edit');
    Route::post('/dashboard/store/matakuliah', [MatakuliahController::class, 'store'])->name('dashboard.matakuliah-store');
    Route::delete('/dashboard/{matakuliah}/delete/matakuliah', [MatakuliahController::class, 'destroy'])->name('dashboard.matakuliah-delete');

    Route::get('/dashboard/{matakuliah}/matakuliah', [MatakuliahController::class, 'edit'])->name('dashboard.matakuliah-edit');
    Route::delete('/dashboard/{matakuliah}/delete/matakuliah', [MatakuliahController::class, 'destroy'])->name('dashboard.matakuliah-delete');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
