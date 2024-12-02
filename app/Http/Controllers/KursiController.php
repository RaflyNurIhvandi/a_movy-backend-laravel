<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KursiController extends Controller
{
    public function cari_kursi(Request $request) {
        $dt_kursi = DB::table('kursi')
                    ->join('auditorium', 'kursi.kode_auditorium', '=', 'auditorium.kode_auditorium')
                    ->where('auditorium.nama', $request->cari)
                    ->orderByDesc('kursi.id')
                    ->paginate(5);
        return view('kursi.index', compact('dt_kursi'));
    }
    public function hapus_kursi($kode_kursi) {
        DB::table('kursi')->where('kode_kursi', $kode_kursi)->delete();
        DB::table('kursi_detail')->where('kode_kursi', $kode_kursi)->delete();
        return redirect('/kursi');
    }
    public function update_kursi(Request $request, $kode_kursi) {
        if ($request->auditorium != "") {
            DB::table('kursi')->where('kode_kursi', $kode_kursi)->update([
                'kode_auditorium'=>$request->auditorium,
                'ke_samping'=>$request->ke_samping,
                'ke_belakang'=>$request->ke_belakang,
            ]);
        } else {
            DB::table('kursi')->where('kode_kursi', $kode_kursi)->update([
                'ke_samping'=>$request->ke_samping,
                'ke_belakang'=>$request->ke_belakang,
            ]);
        }

        $ks = $request->ke_samping;
        $kb = $request->ke_belakang;
        $j_request = $ks*$kb;
        $j_kursi_sekarang = DB::select("SELECT COUNT(*) AS con FROM kursi_detail WHERE kode_kursi = '".$kode_kursi."';");
        $nomor_terakhir = DB::table('kursi_detail')->where('kode_kursi', $kode_kursi)->orderByDesc('nomor_kursi')->limit(1)->get();
        foreach ($j_kursi_sekarang as $jk) {
            if ($jk->con < $j_request) {
                $jc = $jk->con;
                $jt = $j_request-$jc;
                for ($i=1; $i <$jt+1 ; $i++) {
                    foreach ($nomor_terakhir as $nt) {
                        $nk = $nt->nomor_kursi+$i;
                        DB::table('kursi_detail')->insert([
                            'kode_kursi'=>$kode_kursi,
                            'nomor_kursi'=>$nk
                        ]);
                    }
                }
                return redirect('/kursi');
            } else if ($jk->con > $j_request) {
                $jc = $jk->con;
                $jh = $jc-$j_request;
                $dh = DB::table('kursi_detail')
                        ->where('kode_kursi', $kode_kursi)
                        ->orderByDesc('nomor_kursi')
                        ->limit($jh)
                        ->get();
                foreach ($dh as $i) {
                    DB::table('kursi_detail')->where('id', $i->id)->delete();
                }
                return redirect('/kursi');
            } else {
                return redirect('/kursi');
            }
        }
    }
    public function lihat_kursi($kode_kursi) {
        $dt_kursi = DB::table('kursi')
                    ->join('auditorium', 'kursi.kode_auditorium', '=', 'auditorium.kode_auditorium')
                    ->where('kode_kursi', $kode_kursi)
                    ->get();
        $dt_kursi_detail = DB::table('kursi_detail')->where('kode_kursi', $kode_kursi)->get();
        $dt_aud = DB::table('auditorium')->orderByDesc('id')->get();
        // return $dt_kursi;
        return view('kursi.lihat_kursi', compact('dt_kursi', 'dt_aud', 'dt_kursi_detail'));
    }
    public function simpan_kursi(Request $request) {
        $kod = "KR".Date("Ymdhis");
        DB::table('kursi')->insert([
            'kode_kursi'=>$kod,
            'kode_auditorium'=>$request->auditorium,
            'ke_samping'=>$request->ke_samping,
            'ke_belakang'=>$request->ke_belakang,
        ]);

        $ks = $request->ke_samping;
        $kb = $request->ke_belakang;
        $j_kursi = $ks*$kb;
        $count = 0;
        for ($i=1; $i <= $j_kursi; $i++) {
            DB::table('kursi_detail')->insert([
                'kode_kursi'=>$kod,
                'nomor_kursi'=>$count+$i,
            ]);
        }
        return redirect('/kursi');
    }
    public function tambah_kursi() {
        $dt_aud = DB::table('auditorium')->orderByDesc('id')->get();
        return view('kursi.tambah_kursi', compact('dt_aud'));
    }
    public function index() {
        $dt_kursi = DB::table('kursi')
                    ->join('auditorium', 'kursi.kode_auditorium', '=', 'auditorium.kode_auditorium')
                    ->orderByDesc('kursi.id')
                    ->paginate(5);
        return view('kursi.index', compact('dt_kursi'));
    }
}
