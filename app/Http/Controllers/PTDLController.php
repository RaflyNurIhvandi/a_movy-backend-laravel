<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

class PTDLController extends Controller
{
    public function hapus_registrasi(Request $request) {
        DB::table('registrasi')->where('kode_registrasi', $request->kod_reg)->delete();
        DB::table('tiket')->where('kode_registrasi', $request->kod_reg)->delete();
        return redirect('/ptdl');
    }
    public function pembayaran_sukses($kode_registrasi) {
        $val = "pembayaran_sukses";
        DB::table('registrasi')->where('kode_registrasi', $kode_registrasi)->update([
            'status_pembayaran'=>$val
        ]);
        return redirect('/ptdl');
    }
    public function simpan_pembelian(Request $request) {
        $req_pem = $request->pembayaran_sukses;
        $req_cek_in = $request->cek_in;
        if ($req_pem == "" && $req_cek_in == "") {
            echo "Pembayaran dan Cek in Kosong";
            $kod_reg = "REG".Date("Ymdhis");
            $kod_user = Auth::user()->id;
            DB::table('registrasi')->insert([
                'kode_registrasi'=>$kod_reg,
                'kode_user'=>$kod_user,
                'jumlah_tiket'=>$request->jumlah_kursi,
                'jumlah_pembayaran'=>$request->ttl_harga,
            ]);

            $l_kursi = $request->list_kursi;
            $a_kursi = explode(",", $l_kursi);
            $pjg = count($a_kursi);
            for ($i=0; $i <$pjg ; $i++) {
                $kod_tiket = "MOVY".Date("Ymdhis").$a_kursi[$i];
                DB::table('tiket')->insert([
                    'kode_tiket'=>$kod_tiket,
                    'kode_registrasi'=>$kod_reg,
                    'kode_penayangan'=>$request->film,
                    'nomor_kursi'=>$a_kursi[$i],
                    'harga'=>$request->harga,
                ]);
            }
        } else if ($req_pem == "" && $req_cek_in != "") {
            $kod_reg = "REG".Date("Ymdhis");
            $kod_user = Auth::user()->id;
            DB::table('registrasi')->insert([
                'kode_registrasi'=>$kod_reg,
                'kode_user'=>$kod_user,
                'jumlah_tiket'=>$request->jumlah_kursi,
                'jumlah_pembayaran'=>$request->ttl_harga,
            ]);

            $l_kursi = $request->list_kursi;
            $a_kursi = explode(",", $l_kursi);
            $pjg = count($a_kursi);
            for ($i=0; $i <$pjg ; $i++) {
                $kod_tiket = "MOVY".Date("Ymdhis").$a_kursi[$i];
                DB::table('tiket')->insert([
                    'kode_tiket'=>$kod_tiket,
                    'kode_registrasi'=>$kod_reg,
                    'kode_penayangan'=>$request->film,
                    'nomor_kursi'=>$a_kursi[$i],
                    'harga'=>$request->harga,
                    'status_tiket'=>$request->cek_in,
                ]);
            }
        } else if ($req_pem != "" && $req_cek_in == "") {
            $kod_reg = "REG".Date("Ymdhis");
            $kod_user = Auth::user()->id;
            DB::table('registrasi')->insert([
                'kode_registrasi'=>$kod_reg,
                'kode_user'=>$kod_user,
                'jumlah_tiket'=>$request->jumlah_kursi,
                'jumlah_pembayaran'=>$request->ttl_harga,
                'status_pembayaran'=>$request->pembayaran_sukses,
            ]);

            $l_kursi = $request->list_kursi;
            $a_kursi = explode(",", $l_kursi);
            $pjg = count($a_kursi);
            for ($i=0; $i <$pjg ; $i++) {
                $kod_tiket = "MOVY".Date("Ymdhis").$a_kursi[$i];
                DB::table('tiket')->insert([
                    'kode_tiket'=>$kod_tiket,
                    'kode_registrasi'=>$kod_reg,
                    'kode_penayangan'=>$request->film,
                    'nomor_kursi'=>$a_kursi[$i],
                    'harga'=>$request->harga,
                ]);
            }
        } else {
            $kod_reg = "REG".Date("Ymdhis");
            $kod_user = Auth::user()->id;
            DB::table('registrasi')->insert([
                'kode_registrasi'=>$kod_reg,
                'kode_user'=>$kod_user,
                'jumlah_tiket'=>$request->jumlah_kursi,
                'jumlah_pembayaran'=>$request->ttl_harga,
                'status_pembayaran'=>$request->pembayaran_sukses,
            ]);

            $l_kursi = $request->list_kursi;
            $a_kursi = explode(",", $l_kursi);
            $pjg = count($a_kursi);
            for ($i=0; $i <$pjg ; $i++) {
                $kod_tiket = "MOVY".Date("Ymdhis").$a_kursi[$i];
                DB::table('tiket')->insert([
                    'kode_tiket'=>$kod_tiket,
                    'kode_registrasi'=>$kod_reg,
                    'kode_penayangan'=>$request->film,
                    'nomor_kursi'=>$a_kursi[$i],
                    'harga'=>$request->harga,
                    'status_tiket'=>$request->cek_in,
                ]);
            }
        }
        return redirect('/ptdl');
    }
    public function ambil_penayangan() {
        $dt_penayangan = DB::table('penayangan')->get();
        $data = [
            'status'=>'sukses',
            'data'=>$dt_penayangan
        ];
        return response()->json($data);
    }
    public function beli_tiket() {
        $dt_pen = DB::table('penayangan')
                    ->join('film', 'penayangan.kode_film', '=', 'film.kode_film')
                    ->where('status', 'rilis')
                    ->orderByDesc('penayangan.id')
                    ->get();
        return view('ptdl.beli_tiket', compact('dt_pen'));
    }
    public function index() {
        $dt_reg = DB::table('registrasi')->orderByDesc('id')->paginate(5);
        return view('ptdl.index', compact('dt_reg'));
    }
}
