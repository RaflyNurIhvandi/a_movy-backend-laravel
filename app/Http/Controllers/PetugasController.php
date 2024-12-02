<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetugasController extends Controller
{
    public function cari_petugas(Request $request) {
        $dt_pt = DB::table('users')->where('role_id', 2)->where('name', $request->cari)->paginate(5);
        return view('petugas.index', compact('dt_pt'));
    }
    public function hapus_petugas(Request $request) {
        DB::table('users')->where('id', $request->id)->delete();
        return redirect('/petugas');
    }
    public function simpan_petugas(Request $request) {
        $role = 2;
        $pass = password_hash($request->password, PASSWORD_BCRYPT);
        DB::table('users')->insert([
            'name'=>$request->username,
            'email'=>$request->email,
            'role_id'=>$role,
            'password'=>$pass,
        ]);
        return redirect('/petugas');
    }
    public function tambah_petugas() {
        return view('petugas.tambah_petugas');
    }
    public function index() {
        $dt_pt = DB::table('users')->where('role_id', 2)->orderByDesc('id')->paginate(5);
        return view('petugas.index', compact('dt_pt'));
    }
}
