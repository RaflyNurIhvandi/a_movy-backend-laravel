<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenayanganController extends Controller
{
    public function hapus_penayangan($kode_penayangan) {
        DB::table('penayangan')->where('kode_penayangan', $kode_penayangan)->delete();
        return redirect('/penayangan');
    }
    public function ubah_penayangan(Request $request, $kode_penayangan) {
        if ($request->film == "" && $request->auditorium == "" && $request->status == "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                ]);
        } else if ($request->film != "" && $request->auditorium == "" && $request->status == "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_film'=>$request->film,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                ]);
        } else if ($request->film == "" && $request->auditorium != "" && $request->status == "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_auditorium'=>$request->auditorium,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                ]);
        } else if ($request->film == "" && $request->auditorium == "" && $request->status != "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                    'status'=>$request->status,
                ]);
        } else if ($request->film != "" && $request->auditorium != "" && $request->status == "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_film'=>$request->film,
                    'kode_auditorium'=>$request->auditorium,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                ]);
        } else if ($request->film == "" && $request->auditorium != "" && $request->status != "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_auditorium'=>$request->auditorium,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                    'status'=>$request->status,
                ]);
        } else if ($request->film != "" && $request->auditorium == "" && $request->status != "") {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_film'=>$request->film,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                    'status'=>$request->status,
                ]);
        } else {
            DB::table('penayangan')
                ->where('kode_penayangan', $kode_penayangan)
                ->update([
                    'kode_film'=>$request->film,
                    'kode_auditorium'=>$request->auditorium,
                    'tanggal_penayangan'=>$request->tanggal_penayangan,
                    'jam_mulai'=>$request->jam_mulai,
                    'jam_selesai'=>$request->jam_selesai,
                    'harga'=>$request->harga,
                    'status'=>$request->status,
                ]);
        }
        return redirect('/penayangan');
    }
    public function lihat_penayangan($kode_penayangan) {
        $dt_pen = DB::table('penayangan')->where('kode_penayangan', $kode_penayangan)->get();
        $dt_aud = DB::table('penayangan')
                    ->join('auditorium', 'penayangan.kode_auditorium', '=', 'auditorium.kode_auditorium')
                    ->where('penayangan.kode_penayangan', $kode_penayangan)
                    ->get();
        $dt_film = DB::table('penayangan')
                    ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                    ->where('penayangan.kode_penayangan', $kode_penayangan)
                    ->get();
        $dt_film_all = DB::table('film')->orderByDesc('id')->get();
        $dt_aud_all = DB::table('auditorium')->orderByDesc('id')->get();
        return view('penayangan.lihat_penayangan', compact('dt_pen', 'dt_aud', 'dt_film', 'dt_film_all', 'dt_aud_all'));
    }
    public function simpan_penayangan(Request $request) {
        $kod = "PEN".Date("Ymdhis");
        DB::table('penayangan')->insert([
            'kode_penayangan'=>$kod,
            'kode_film'=>$request->film,
            'kode_auditorium'=>$request->auditorium,
            'tanggal_penayangan'=>$request->tanggal_penayangan,
            'jam_mulai'=>$request->jam_mulai,
            'jam_selesai'=>$request->jam_selesai,
            'harga'=>$request->harga,
            'status'=>$request->status,
        ]);
        return redirect('/penayangan');
    }
    public function tambah_penayangan() {
        $dt_film = DB::table('film')->orderByDesc('id')->get();
        $dt_aud = DB::table('auditorium')->orderByDesc('id')->get();
        return view('penayangan.tambah_penayangan', compact('dt_film', 'dt_aud'));
    }
    public function index() {
        $dt_pen = DB::table('penayangan')
                ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                ->orderByDesc('penayangan.id')
                ->paginate(5);
        // return $dt_pen;
        return view('penayangan.index', compact('dt_pen'));
    }
}
