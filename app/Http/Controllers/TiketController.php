<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TiketController extends Controller
{
    public function cetak_tiket($kode_tiket) {
        $ambil_no = DB::table('tiket')->where('kode_tiket', $kode_tiket)->get();
        $no_reg = $ambil_no[0]->kode_registrasi;
        $no_penayangan = $ambil_no[0]->kode_penayangan;

        $dt_aud = DB::table('penayangan')
                        ->join('auditorium', 'penayangan.kode_auditorium', '=', 'auditorium.kode_auditorium')
                        ->where('penayangan.kode_penayangan', $no_penayangan)
                        ->get();
        $dt_film = DB::table('penayangan')
                        ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                        ->where('penayangan.kode_penayangan', $no_penayangan)
                        ->get();
        $dt_reg = DB::table('registrasi')
                    ->join('users', 'registrasi.kode_user', '=', 'users.id')
                    ->where('kode_registrasi', $no_reg)
                    ->get();
        $dt_tiket = DB::table('tiket')
                    ->where('kode_tiket', $kode_tiket)
                    ->get();
        return view('tiket.cetak_tiket', compact('dt_tiket', 'dt_reg', 'dt_aud', 'dt_film'));
    }
    public function cek_in($kode_tiket) {
        $val = 'cek_in';
        DB::table('tiket')->where('kode_tiket', $kode_tiket)->update([
            'status_tiket'=>$val
        ]);
        return back();
    }
    public function lihat_tiket($kode_tiket) {
        $ambil_no = DB::table('tiket')->where('kode_tiket', $kode_tiket)->get();
        $no_reg = $ambil_no[0]->kode_registrasi;
        $no_penayangan = $ambil_no[0]->kode_penayangan;

        $dt_aud = DB::table('penayangan')
                        ->join('auditorium', 'penayangan.kode_auditorium', '=', 'auditorium.kode_auditorium')
                        ->where('penayangan.kode_penayangan', $no_penayangan)
                        ->get();
        $dt_film = DB::table('penayangan')
                        ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                        ->where('penayangan.kode_penayangan', $no_penayangan)
                        ->get();
        $dt_reg = DB::table('registrasi')
                    ->join('users', 'registrasi.kode_user', '=', 'users.id')
                    ->where('kode_registrasi', $no_reg)
                    ->get();
        $dt_tiket = DB::table('tiket')
                    ->where('kode_tiket', $kode_tiket)
                    ->get();
        return view('tiket.lihat_tiket', compact('dt_tiket', 'dt_reg', 'dt_aud', 'dt_film'));
    }
    public function index() {
        $dt_tiket = DB::table('tiket')->orderByDesc('id')->paginate(5);
        return view('tiket.index', compact('dt_tiket'));
    }
}
