<?php

namespace App\Http\Controllers\Api;
use App\Models\info_perusahaan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponse;


class InfoPerusahaanController extends Controller
{
    use ApiResponse;
    public function index(){
        // return
        $data = info_perusahaan::all();
        return $this->success($data, 'Data Info Perusahaan');
    }
    public function store(info_perusahaan $info){
        $check= $info->all();
        $check= json_decode($check, true);
        if(empty($check)){
            request()->validate([
                'nama_perusahaan' => 'required',
                'alamat' => 'required',
                'phone' => 'required'
            ]);
            $info->create([
                'nama_perusahaan' =>  request('nama_perusahaan'),
                'alamat' =>  request('alamat'),
                'phone' =>  request('phone')
            ]);
            return $this->success(null, 'Data Berhasil Tersimpan');
        }else{
            return $this->success(null, 'Info perusahaan sudah tersedia');
        }
    }
    public function update($id,info_perusahaan $info){
      request()->validate([
        'nama_perusahaan' => 'required',
        'alamat' => 'required',
        'phone' => 'required'
      ]);
      $infoUpdate = $info->find($id);
      $success = $infoUpdate->update([
        'nama_perusahaan' =>  request('nama_perusahaan'),
        'alamat' =>  request('alamat'),
        'phone' =>  request('phone')
      ]);
      return $this->success(['data' => $success], 'Success Updated Data');
    }
    public function show($id,info_perusahaan $info){
        return $this->success(['data' => $info->find($id)], 'Success Showing Data');
    }

}
