<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\akad_info;
use App\Models\akad_objek;
use App\Models\akad_kewajiban_1;
use App\Models\akad_kewajiban_2;
use App\Http\Traits\ApiResponse;
class AkadController extends Controller
{
    use ApiResponse;
    public function index(){
        $info = akad_info::all();
        $objek = akad_objek::all();
        $kewajiban_1 = akad_kewajiban_1::all();
        $kewajiban_2 = akad_kewajiban_2::all();
        return $this->success(['info_akad'=>$info,'objek_perjanjian'=>$objek,'kewajiban_pihak_pertama'=>$kewajiban_1,'kewajiban_pihak_kedua'=>$kewajiban_2], 'Data Akad');
    }
    public function store(akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        request()->validate([
            'nomor_akad'=>'required|unique:akad_infos',
            'nama'=>'required',
            'nik'=>'required',
            'alamat'=>'required',
            'nama_2'=>'required',
            'nik_2'=>'required',
            'alamat_2'=>'required',
            'ket'=>'required',
            'perjanjian'=>'required',
            'jangka_waktu'=>'required',
            'tempat_tanggal'=>'required',
            'objek'=>'required',
            'objek.*.objek_perjanjian'=>'required',
            'objek.*.ket_objek'=>'required',
            'kewajiban_1'=>'required',
            'kewajiban_2'=>'required',
        ]);
        $info->create([
            'nomor_akad' => request('nomor_akad'),
            'nama' => request('nama'),
            'nik' => request('nik'),
            'alamat' => request('alamat'),
            'nama_2' => request('nama_2'),
            'nik_2' => request('nik_2'),
            'alamat_2' => request('alamat_2'),
            'ket' => request('ket'),
            'perjanjian' => request('perjanjian'),
            'jangka_waktu' => request('jangka_waktu'),
            'tempat_tanggal' => request('tempat_tanggal'),
        ]);
        $data = request('objek');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $objek->create([
                'nomor_akad' => request('nomor_akad'),
                'objek_perjanjian' => $value['objek_perjanjian'],
                'ket_objek' => $value['ket_objek'],
                'urutan'=>$urutan,
            ]);
        }
        $data = request('kewajiban_1');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $kewajiban_1->create([
                'nomor_akad' => request('nomor_akad'),
                'kewajiban' => $value['kewajiban'],
                'urutan'=>$urutan,
            ]);
        }$data = request('kewajiban_2');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $kewajiban_2->create([
                'nomor_akad' => request('nomor_akad'),
                'kewajiban' => $value['kewajiban'],
                'urutan'=>$urutan,
            ]);
        }

        return $this->success(['Sukses'], 'Data Penawaran Berhasil tersimpan');
    }
    public function update($no_akad,akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        request()->validate([
            'nama'=>'required',
            'nik'=>'required',
            'alamat'=>'required',
            'nama_2'=>'required',
            'nik_2'=>'required',
            'alamat_2'=>'required',
            'ket'=>'required',
            'perjanjian'=>'required',
            'jangka_waktu'=>'required',
            'tempat_tanggal'=>'required',
            'objek'=>'required',
            'objek.*.objek_perjanjian'=>'required',
            'objek.*.ket_objek'=>'required',
            'kewajiban_1'=>'required',
            'kewajiban_2'=>'required',
        ]);
        $info = $info->where('nomor_akad','=',$no_akad)->FirstOrFail();
        $info->update([
            'nama' => request('nama'),
            'nik' => request('nik'),
            'alamat' => request('alamat'),
            'nama_2' => request('nama_2'),
            'nik_2' => request('nik_2'),
            'alamat_2' => request('alamat_2'),
            'ket' => request('ket'),
            'perjanjian' => request('perjanjian'),
            'jangka_waktu' => request('jangka_waktu'),
            'tempat_tanggal' => request('tempat_tanggal'),
        ]);
        $data = request('objek');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $objek = $objek->where('nomor_akad','=',$no_akad)->where('urutan','=',$urutan)->FirstOrFail();
            $objek->update([
                'objek_perjanjian' => $value['objek_perjanjian'],
                'ket_objek' => $value['ket_objek'],
            ]);
        }
        $data = request('kewajiban_1');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad)->where('urutan','=',$urutan)->FirstOrFail();
            $kewajiban_1->update([
                'kewajiban' => $value['kewajiban'],
            ]);
        }$data = request('kewajiban_2');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad)->where('urutan','=',$urutan)->FirstOrFail();
            $kewajiban_2->update([
                'kewajiban' => $value['kewajiban'],
            ]);
        }

        return $this->success(['Sukses'], 'Data Penawaran Berhasil diperbarui');
    }
    public function destroy($no_akad,akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        $objek = $objek->where('nomor_akad','=',$no_akad);
        $info = $info->where('nomor_akad','=',$no_akad);
        $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad);
        $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad);

        $objek->delete();
        $info->delete();
        $kewajiban_1->delete();
        $kewajiban_2->delete();

        return $this->success(['success deleted'], 'sukses Menghapus data');
    }
    public function show($no_akad,akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        $objek = $objek->where('nomor_akad','=',$no_akad)->get();
        $info = $info->where('nomor_akad','=',$no_akad)->get();
        $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad)->get();
        $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad)->get();

        return $this->success(['akad_info'=>$info,'objek_perjanjian'=>$objek,'kewajiban_pihak_pertama'=>$kewajiban_1,'kewajiban_pihak_kedua'=>$kewajiban_2], 'sukses Menghapus data');
    }
}
