<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\akad_info;
use App\Models\akad_objek;
use App\Models\akad_kewajiban_1;
use App\Models\akad_kewajiban_2;
use App\Models\info_perusahaan;
use App\Http\Traits\ApiResponse;
date_default_timezone_set('Asia/Jakarta');
class AkadController extends Controller
{

    use ApiResponse;
    public function getSub($obj){
        $sub=akad_objek::select('subjek_perjanjian')->where('objek_perjanjian','=',$obj)->distinct()->get();
        return $sub;
    }
    public function getKet($sub,$obj){
        $ket=akad_objek::select('ket_objek')->where('subjek_perjanjian','=',$sub)->where('objek_perjanjian','=',$obj)->get();
        return $ket;
    }
    public function index(){
        $info = akad_info::all();
        $objek = akad_objek::all();
        $kewajiban_1 = akad_kewajiban_1::all();
        $kewajiban_2 = akad_kewajiban_2::all();
        return $this->success(['info_akad'=>$info,'objek_perjanjian'=>$objek,'kewajiban_pihak_pertama'=>$kewajiban_1,'kewajiban_pihak_kedua'=>$kewajiban_2], 'Data Akad');
    }
    public function store(akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        // $date = date('D M Y');
        $date = strftime( "%d %B %Y", time());
        $tptg="Bogor, ".$date;
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
            'objek'=>'required',
            'objek.*.objek_perjanjian'=>'required',
            'objek.*.subjek_perjanjian'=>'required',
            'objek.*.ket_objek'=>'required',
            'kewajiban_1'=>'required',
            'kewajiban_2'=>'required',
            'nominal_jasa' =>'required'
        ]);


        // dd($tptg);
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
            'tempat_tanggal' => $tptg,
            'nominal_jasa' => request('nominal_jasa')
        ]);
        $data = request('objek');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $objek->create([
                'nomor_akad' => request('nomor_akad'),
                'objek_perjanjian' => $value['objek_perjanjian'],
                'subjek_perjanjian' => $value['subjek_perjanjian'],
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
        $no_akad = str_replace('_','/',$no_akad);
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
            'objek'=>'required',
            'objek.*.objek_perjanjian'=>'required',
            'objek.*.subjek_perjanjian'=>'required',
            'objek.*.ket_objek'=>'required',
            'kewajiban_1'=>'required',
            'kewajiban_2'=>'required',
        ]);
        setlocale(LC_ALL, 'id_ID.UTF8', 'id_ID.UTF-8', 'id_ID.8859-1', 'id_ID', 'IND.UTF8', 'IND.UTF-8', 'IND.8859-1', 'IND', 'Indonesian.UTF8', 'Indonesian.UTF-8', 'Indonesian.8859-1', 'Indonesian', 'Indonesia', 'id', 'ID', 'en_US.UTF8', 'en_US.UTF-8', 'en_US.8859-1', 'en_US', 'American', 'ENG', 'English');
        // $date = date('D M Y');
        $date = strftime( "%d %B %Y", time());
        $tptg="Bogor, ".$date;
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
            'tempat_tanggal' => $tptg,
        ]);
        $data = request('objek');
        $urutan = 0;
        $objek = $objek->where('nomor_akad','=',$no_akad);
        $objek->delete();
        foreach($data as $key => $value){
            $urutan++;
            akad_objek::create([
                'nomor_akad' => $no_akad,
                'objek_perjanjian' => $value['objek_perjanjian'],
                'subjek_perjanjian' => $value['subjek_perjanjian'],
                'ket_objek' => $value['ket_objek'],
                'urutan'=>$urutan,
            ]);
        }
        $data = request('kewajiban_1');
        $urutan = 0;
        $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad)->delete();
        foreach($data as $key => $value){
            $urutan++;
            akad_kewajiban_1::create([
                'nomor_akad' => $no_akad,
                'kewajiban' => $value['kewajiban'],
                'urutan' => $urutan
            ]);
        }
        $data = request('kewajiban_2');
        $urutan = 0;
        $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad)->delete();
        foreach($data as $key => $value){
            $urutan++;
            akad_kewajiban_2::create([
                'nomor_akad' => $no_akad,
                'kewajiban' => $value['kewajiban'],
                'urutan' => $urutan
            ]);
        }

        return $this->success(['Sukses'], 'Data Penawaran Berhasil diperbarui');
    }
    public function destroy($no_akad,akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2){
        $no_akad = str_replace('_','/',$no_akad);
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
        $no_akad = str_replace('_','/',$no_akad);
        $objek = $objek->where('nomor_akad','=',$no_akad)->get();
        $info = $info->where('nomor_akad','=',$no_akad)->first();
        $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad)->get();
        $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad)->get();

        return $this->success(['akad_info'=>$info,'objek_perjanjian'=>$objek,'kewajiban_pihak_pertama'=>$kewajiban_1,'kewajiban_pihak_kedua'=>$kewajiban_2], 'sukses Memanggil data');
    }

    public function makeAkad($action,$no_akad,akad_info $info,akad_objek $objek,akad_kewajiban_1 $kewajiban_1,akad_kewajiban_2 $kewajiban_2,info_perusahaan $cv){
        $no_akad = str_replace('_','/',$no_akad);
        $objek = $objek->select('objek_perjanjian')->where('nomor_akad','=',$no_akad)->distinct()->get();
        // dd($objek);
        $objLength = akad_objek::where('nomor_akad','=',$no_akad)->get()->sortByDesc("urutan")->first();
        $kewajiban_1 = $kewajiban_1->where('nomor_akad','=',$no_akad)->get();
        $kewajiban_2 = $kewajiban_2->where('nomor_akad','=',$no_akad)->get();
        $info = $info->where('nomor_akad','=',$no_akad)->FirstOrFail();
        $cv = $cv->FirstOrFail();
        $total = 0;
        $fileName = $no_akad.".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 50,
            'margin_bottom' => 30,
            'margin_header' => 20,
            'margin_footer' => 20,
        ]);

        $html = \View::make('akad')->with('info', $info)->with('objek',$objek)->with('kewajiban_1',$kewajiban_1)->with('kewajiban_2',$kewajiban_2)->with('info_perusahaan', $cv)->with('controller',$this)->with('objLength',$objLength);
        $html = $html->render();

        $mpdf->setHtmlFooter("<div id='bar'></div>
        <div id='nomor' style='text-align:right;'>nayakateknologi.com</div>");
        // $html = "test";
        $style = file_get_contents('css/style.css');
        // dd($style);
        $mpdf->WriteHtml($style, 1);
        $mpdf->WriteHtml($html);
        if($action ==  "view"){
            $mpdf->Output($fileName,'I');
        }
        elseif($action ==  "download"){
            $mpdf->Output($fileName,'D');
        }
        // return view('invoice');
    }


}
