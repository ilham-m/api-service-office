<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;
use App\Models\penawaran_info;
use App\Models\penawaran_detail;
use App\Models\info_perusahaan;

class PenawaranController extends Controller
{
    use ApiResponse;
    public function index(){
        $data_detail = penawaran_detail::all();
        $data_info = penawaran_info::all();
        return $this->success(['info_penawaran'=>$data_info,'detail_penawaran'=>$data_detail], 'Data Penawaran');
    }
    public function store(penawaran_info $info,penawaran_detail $detail){
        date_default_timezone_set('Asia/Jakarta');
        $date = date('y-m-d');
        request()->validate([
            'nama' => 'required',
            'ket_penawaran' => 'required',
            'no_surat_penawaran' => 'required|unique:penawaran_infos',
            'penawaran' => 'required',
            'penawaran.*.penawaran' => 'required',
            'penawaran.*.harga' => 'required',
        ]);
        $info->create([
            'tanggal'=> $date,
            'no_surat_penawaran' => request('no_surat_penawaran'),
            'nama' => request('nama'),
            'ket_penawaran' => request('ket_penawaran'),
            'ket_penawaran' => request('ket_penawaran'),
        ]);
        $data = request('penawaran');
        $urutan = 0;
        foreach($data as $key => $value){
            $urutan++;
            $detail->create([
                'no_surat_penawaran' => request('no_surat_penawaran'),
                'penawaran' => $value['penawaran'],
                'harga' => $value['harga'],
                'urutan'=>$urutan,
            ]);
        }
        return $this->success(['info_penawaran'=>$info,'detail_penawaran'=>$detail], 'Data Penawaran Berhasil tersimpan');
    }
    public function update($no_surat_penawaran,penawaran_info $info,penawaran_detail $detail){
        $no_surat_penawaran = str_replace('_','/',$no_surat_penawaran);
        request()->validate([
            'nama' => 'required',
            'ket_penawaran' => 'required',
            'penawaran' => 'required',
            'penawaran.*.penawaran' => 'required',
            'penawaran.*.harga' => 'required',
        ]);
        $info = $info->where('no_surat_penawaran','=',$no_surat_penawaran);
        $info->update([
            'nama' => request('nama'),
            'ket_penawaran' => request('ket_penawaran'),
        ]);
        $data = request()->input();
        $detail = $detail->where('no_surat_penawaran','=',$no_surat_penawaran)->delete();
        $urutan = 0;
        foreach($data['penawaran'] as $key => $value){
            $urutan++;
            penawaran_detail::create([
                'no_surat_penawaran' => $no_surat_penawaran,
                'penawaran' => $value['penawaran'],
                'harga' => $value['harga'],
                'urutan'=>$urutan,
            ]);
        }
        return $this->success(['info_penawaran'=>$info,'detail_penawaran'=>$detail], 'Data Penawaran Berhasil diperbarui');
    }
    public function destroy($no_surat_penawaran,penawaran_detail $produk,penawaran_info $info){
        $no_surat_penawaran = str_replace('_','/',$no_surat_penawaran);
        $produkDelete = $produk->where('no_surat_penawaran','=',$no_surat_penawaran);
        $infoDelete = $info->where('no_surat_penawaran','=',$no_surat_penawaran);

        $produkDelete->delete();
        $infoDelete->delete();

        return $this->success(['info'=>'deleted','detail'=>'deleted'], 'sukses Menghapus data');
    }
    public function show($no_surat_penawaran,penawaran_detail $produk,penawaran_info $info){
        $no_surat_penawaran = str_replace('_','/',$no_surat_penawaran);
        $produk = $produk->where('no_surat_penawaran','=',$no_surat_penawaran)->get();
        $info = $info->where('no_surat_penawaran','=',$no_surat_penawaran)->FirstOrFail();

        return $this->success(['info'=>$info,'detail'=>$produk], 'Data penawaran '.$no_surat_penawaran);

    }
    public function makePenawaran($action,$no_surat_penawaran,penawaran_detail $produk,penawaran_info $info,info_perusahaan $cv){
        $no_surat_penawaran = str_replace('_','/',$no_surat_penawaran);
        $produk = $produk->where('no_surat_penawaran','=',$no_surat_penawaran)->get();
        $info = $info->where('no_surat_penawaran','=',$no_surat_penawaran)->FirstOrFail();
        $cv = $cv->FirstOrFail();
        $total = 0;
        foreach ($produk as $key => $value) {
            $total = $total + $value['harga'];
        }
        $fileName = $no_surat_penawaran.".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 30,
            'margin_header' => 0,
            'margin_footer' => 20,
        ]);

        $html = \View::make('penawaran')->with('info', $info)->with('detail',$produk)->with('total',$total)->with('info_perusahaan', $cv);
        $html = $html->render();
        $mpdf->setHtmlFooter("
        <div id='bar'></div>
        <div id='nomor' style='text-align:right;'>nayakateknologi.com</div>
        ");
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
