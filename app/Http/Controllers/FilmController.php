<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class FilmController extends Controller
{
    public function cari_film(Request $request) {
        $dt_film = DB::table('film')->where('nama', $request->cari)->paginate(5);
        return view('film.index', compact('dt_film'));
    }
    public function hapus_film($id) {
        $dt_delete = DB::table('film')->where('id', $id)->get();
        foreach ($dt_delete as $i) {
            $dir_gbr = "asset_film/gambar/".$i->gambar_thumbnail;
            $dir_vid = "asset_film/video/".$i->video_trailer;
            File::delete($dir_gbr);
            File::delete($dir_vid);
        }
        DB::table('film')->where('id', $id)->delete();
        return redirect('/film');
    }
    public function update_film(Request $request, $id) {
        if ($request->thumbnail == "" && $request->video == "") {
            DB::table('film')->where('id', $id)->update([
                "nama"=>$request->nama,
                "jenis_film"=>$request->jenis_film,
                "produser"=>$request->produser,
                "sutradara"=>$request->sutradara,
                "penulis"=>$request->penulis,
                "pemroduksi"=>$request->pemroduksi,
                "pemeran"=>$request->pemeran,
                "sinopsis"=>$request->sinopsis,
            ]);
        } else if ($request->thumbnail != "" && $request->video == "") {
            $dt_delete = DB::table('film')->where('id', $id)->get();
            foreach ($dt_delete as $i) {
                $dir = "asset_film/gambar/".$i->gambar_thumbnail;
                File::delete($dir);
            }

            $thum = $request->file('thumbnail');
            $nama_gambar = time()."_".$thum->getClientOriginalName();
            $tujuan_upload_gambar = "asset_film/gambar/";
            $thum->move($tujuan_upload_gambar, $nama_gambar);

            DB::table('film')->where('id', $id)->update([
                "nama"=>$request->nama,
                "jenis_film"=>$request->jenis_film,
                "produser"=>$request->produser,
                "sutradara"=>$request->sutradara,
                "penulis"=>$request->penulis,
                "pemroduksi"=>$request->pemroduksi,
                "pemeran"=>$request->pemeran,
                "sinopsis"=>$request->sinopsis,
                "gambar_thumbnail"=>$nama_gambar,
            ]);
        } else if ($request->thumbnail == "" && $request->video != "") {
            $dt_delete = DB::table('film')->where('id', $id)->get();
            foreach ($dt_delete as $i) {
                $dir = "asset_film/video/".$i->video_trailer;
                File::delete($dir);
            }
            $vid = $request->file('video');
            $nama_video = time()."_".$vid->getClientOriginalName();
            $tujuan_upload_video = "asset_film/video/";
            $vid->move($tujuan_upload_video, $nama_video);

            DB::table('film')->where('id', $id)->update([
                "nama"=>$request->nama,
                "jenis_film"=>$request->jenis_film,
                "produser"=>$request->produser,
                "sutradara"=>$request->sutradara,
                "penulis"=>$request->penulis,
                "pemroduksi"=>$request->pemroduksi,
                "pemeran"=>$request->pemeran,
                "sinopsis"=>$request->sinopsis,
                "video_trailer"=>$nama_video,
            ]);
        } else {
            $dt_delete = DB::table('film')->where('id', $id)->get();
            foreach ($dt_delete as $i) {
                $dir_gbr = "asset_film/gambar/".$i->gambar_thumbnail;
                $dir_vid = "asset_film/video/".$i->video_trailer;
                File::delete($dir_gbr);
                File::delete($dir_vid);
            }

            $thum = $request->file('thumbnail');
            $nama_gambar = time()."_".$thum->getClientOriginalName();
            $tujuan_upload_gambar = "asset_film/gambar/";
            $thum->move($tujuan_upload_gambar, $nama_gambar);

            $vid = $request->file('video');
            $nama_video = time()."_".$vid->getClientOriginalName();
            $tujuan_upload_video = "asset_film/video/";
            $vid->move($tujuan_upload_video, $nama_video);

            DB::table('film')->where('id', $id)->update([
                "nama"=>$request->nama,
                "jenis_film"=>$request->jenis_film,
                "produser"=>$request->produser,
                "sutradara"=>$request->sutradara,
                "penulis"=>$request->penulis,
                "pemroduksi"=>$request->pemroduksi,
                "pemeran"=>$request->pemeran,
                "sinopsis"=>$request->sinopsis,
                "gambar_thumbnail"=>$nama_gambar,
                "video_trailer"=>$nama_video,
            ]);
        }
        return redirect('/film');
    }
    public function lihat_film($id) {
        $dt_film = DB::table('film')->where('id', $id)->get();
        return view('film.lihat_film', compact('dt_film'));
    }
    public function simpan_film(Request $request) {
        $thum = $request->file('thumbnail');
        $nama_gambar = time()."_".$thum->getClientOriginalName();
        $tujuan_upload_gambar = "asset_film/gambar/";
        $thum->move($tujuan_upload_gambar, $nama_gambar);

        $vid = $request->file('video');
        $nama_video = time()."_".$vid->getClientOriginalName();
        $tujuan_upload_video = "asset_film/video/";
        $vid->move($tujuan_upload_video, $nama_video);

        $kod = "FLM".Date("Ymdhis");
        DB::table('film')->insert([
            "kode_film"=>$kod,
            "nama"=>$request->nama,
            "jenis_film"=>$request->jenis_film,
            "produser"=>$request->produser,
            "sutradara"=>$request->sutradara,
            "penulis"=>$request->penulis,
            "pemroduksi"=>$request->pemroduksi,
            "pemeran"=>$request->pemeran,
            "sinopsis"=>$request->sinopsis,
            "gambar_thumbnail"=>$nama_gambar,
            "video_trailer"=>$nama_video,
        ]);
        return redirect('/film');
    }
    public function tambah_film() {
        return view('film.tambah_filem');
    }
    public function index() {
        $dt_film = DB::table('film')->orderByDesc('id')->paginate(5);
        return view('film.index', compact('dt_film'));
    }
}
