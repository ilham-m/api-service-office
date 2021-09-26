<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\invoice_info;
use App\Models\invoice_ProductDetail;
use App\Http\Traits\ApiResponse;
use App\Models\info_perusahaan;

class InvoiceController extends Controller
{
    use ApiResponse;
    public function index(){
        // $date = date('d-m-Y');
        // dd($date);
        $data_detail = invoice_ProductDetail::all();
        $data_info = invoice_info::all();
        $latestInvoice = invoice_info::orderByDesc('id')->first();
        return $this->success(['latest_invoice'=>$latestInvoice,'info_tagihan'=>$data_info,'detail_tagihan'=>$data_detail], 'Data Invoice');
    }
    public function store(Request $request,invoice_ProductDetail $produk,invoice_info $info){
       date_default_timezone_set('Asia/Jakarta');
      $request->validate([
        'invoice' => 'required|unique:invoice_infos',
        'tagihan' => 'required',
        'nama' => 'required',
        'alamat' => 'required',
        'tagihan.*.deskripsi_tagihan' => 'required',
        'tagihan.*.tagihan' => 'required',
      ]);
      $date = date('y-m-d');

      $info->create([
        'invoice' => request('invoice'),
        'nama'=> request('nama'),
        'alamat'=> request('alamat'),
        'tanggal'=> $date,
      ]);
      $tagihanData = $request->input();
      $urutan = 0;
      foreach($tagihanData['tagihan'] as $key => $value){
          $urutan++;
        $produk->create([
            'invoice' => request('invoice'),
            'urutan' => $urutan,
            'tagihan'=> $value['tagihan'],
            'deskripsi_tagihan' => $value['deskripsi_tagihan'],
        ]);
      }
      return $this->success(['info'=>$info,'detail'=>$produk], 'sukses menyimpan data');
    }
    public function update($invoice,Request $request,invoice_ProductDetail $produk,invoice_info $info){
        request()->validate([
            'tagihan' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'tagihan.*.deskripsi_tagihan' => 'required',
            'tagihan.*.tagihan' => 'required',
          ]);
        $invoice = str_replace('-','/',$invoice);
        $produkUpdate = $produk->where('invoice','=',$invoice);
        $infoUpdate = $info->where('invoice','=',$invoice);

        $infoUpdate->update([
            'nama'=> request('nama'),
            'alamat'=> request('alamat'),
        ]);

        $tagihanData = $request->input();
        $urutan = 0;
        $produkUpdate = $produk->where('invoice','=',$invoice)->delete();
        foreach($tagihanData['tagihan'] as $key => $value){
            $urutan++;
            invoice_ProductDetail::create([
                'invoice' => $invoice,
                'urutan' => $urutan,
                'tagihan'=> $value['tagihan'],
                'deskripsi_tagihan' => $value['deskripsi_tagihan'],
            ]);
        }
        return $this->success(['info'=>'update sukses','detail'=>'update sukses'], 'sukses menyimpan data');
    }
    public function destroy($invoice,invoice_ProductDetail $produk,invoice_info $info){
        $invoice = str_replace('-','/',$invoice);
        $produkDelete = $produk->where('invoice','=',$invoice)->FirstOrFail();
        $infoDelete = $info->where('invoice','=',$invoice)->FirstOrFail();

        $produkDelete->delete();
        $infoDelete->delete();

        return $this->success(['info'=>'deleted','detail'=>'deleted'], 'sukses Menghapus data');
    }
    public function show($invoice,invoice_ProductDetail $produk,invoice_info $info){
        $invoice = str_replace('-','/',$invoice);
        $produk = $produk->where('invoice','=',$invoice)->get();
        $info = $info->where('invoice','=',$invoice)->FirstOrFail();
        return $this->success(['info'=>$info,'detail'=>$produk], 'Data invoice '.$invoice);

    }
    public function makeInvoice($action,$invoice,invoice_ProductDetail $produk,invoice_info $info,info_perusahaan $cv){
        $invoice = str_replace('-','/',$invoice);
        $produk = $produk->where('invoice','=',$invoice)->get();
        $info = $info->where('invoice','=',$invoice)->FirstOrFail();
        $cv = $cv->FirstOrFail();
        $total = 0;
        foreach ($produk as $key => $value) {
            $total = $total + $value['tagihan'];
        }
        $fileName = $invoice.".pdf";
        $mpdf = new \Mpdf\Mpdf([
            'margin_left' => 20,
            'margin_right' => 20,
            'margin_top' => 20,
            'margin_bottom' => 30,
            'margin_header' => 0,
            'margin_footer' => 20,
        ]);

        $html = \View::make('invoice')->with('info', $info)->with('detail',$produk)->with('total',$total)->with('info_perusahaan', $cv);
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
