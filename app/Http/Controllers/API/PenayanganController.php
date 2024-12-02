<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenayanganController extends Controller
{
    public function lihat_tiket($id) {
        $amkr = DB::table('registrasi')->where('kode_user', $id)->get();
        $kr = $amkr[0]->kode_registrasi;
        $tiket = DB::table('tiket')->where('kode_registrasi', $kr)->get();

        $data = [
            'status'=>'sukses',
            'data'=>$tiket
        ];
        return response()->json($data);
    }
    public function beli_tiket(Request $request) {
            $kod_reg = "REG".Date("Ymdhis");
            $status_pembayaran = "menunggu_pembayaran";
            $status_tiket = "registrasi";

            $l_kursi = $request->list_kursi;
            // $a_kursi = explode(",", $l_kursi);
            $pjg = count($l_kursi);
            $hr = $request->harga;
            $jumlah_pembayaran = $hr*$pjg;
            DB::table('registrasi')->insert([
                'kode_registrasi'=>$kod_reg,
                'kode_user'=>$request->kode_user,
                'jumlah_tiket'=>$pjg,
                'jumlah_pembayaran'=>$jumlah_pembayaran,
                'status_pembayaran'=>$status_pembayaran,
            ]);

            for ($i=0; $i <$pjg ; $i++) {
                $kod_tiket = "MOVY".Date("Ymdhis").$l_kursi[$i];
                DB::table('tiket')->insert([
                    'kode_tiket'=>$kod_tiket,
                    'kode_registrasi'=>$kod_reg,
                    'kode_penayangan'=>$request->kode_penayangan,
                    'nomor_kursi'=>$l_kursi[$i],
                    'harga'=>$request->harga,
                    'status_tiket'=>$status_tiket,
                ]);
            }
            return response()->json([
                "status"=>'sukses'
            ]);
            // return response()->json($request->list_kursi);
    }
    public function detail_penayangan($id) {
        $film = DB::table('penayangan')
                ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                ->where('penayangan.kode_penayangan', $id)
                ->get();
        $aud = DB::table('penayangan')
                ->join('auditorium', 'penayangan.kode_auditorium', '=', 'auditorium.kode_auditorium')
                ->where('penayangan.kode_penayangan', $id)
                ->get();
        $no_aud = $aud[0]->kode_auditorium;
        $kursi_detail = DB::table('kursi')
                ->join('kursi_detail', 'kursi.kode_kursi', '=', 'kursi_detail.kode_kursi')
                ->where('kursi.kode_auditorium', $no_aud)
                ->get();
        $kursi = DB::table('kursi')->where('kursi.kode_auditorium', $no_aud)->get();
        $img_url = asset(str_replace('public', 'storage', "asset_film/gambar/"));
        $data = [
            'status'=>'sukses',
            'film'=>$film,
            'aud'=>$aud,
            'kursi'=>$kursi,
            'img_url'=>$img_url,
            'kursi_detail'=>$kursi_detail,
        ];
        return $data;
    }
    public function load_film() {
        $img_url = asset(str_replace('public', 'storage', "asset_film/gambar/"));
        $film = DB::table('penayangan')
                ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                ->get();
        $data = [
            'status'=>'sukses',
            'img_url'=>$img_url,
            'data'=>$film,
        ];
        return response()->json($data);
    }
}
