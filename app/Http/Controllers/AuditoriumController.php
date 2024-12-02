<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuditoriumController extends Controller
{
    public function cari_auditorium(Request $request) {
        $dt_aud = DB::table('auditorium')->where('nama', $request->cari)->paginate(5);
        return view('auditorium.index', compact('dt_aud'));
    }
    public function hapus_auditorium($id) {
        DB::table('auditorium')->where('id', $id)->delete();
        return redirect('/auditorium');
    }
    public function ubah_auditorium(Request $request, $id) {
        DB::table('auditorium')->where('id', $id)->update([
            'nama'=>$request->nama,
            'catatan'=>$request->catatan,
        ]);
        return redirect('/auditorium');
    }
    public function lihat_auditorium($id) {
        $dt_aud = DB::table('auditorium')->where('id', $id)->get();
        return view('auditorium.lihat_auditorium', compact('dt_aud'));
    }
    public function simpan_auditorium(Request $request) {
        $kod = "AUD".Date("Ymdhis");
        DB::table('auditorium')->insert([
            'kode_auditorium'=>$kod,
            'nama'=>$request->nama,
            'catatan'=>$request->catatan,
        ]);
        return redirect('/auditorium');
    }
    public function tambah_auditorium() {
        return view('auditorium.tambah_auditorium');
    }
    public function index() {
        $dt_aud = DB::table('auditorium')->orderByDesc('id')->paginate(5);
        return view('auditorium.index', compact('dt_aud'));
    }
}
