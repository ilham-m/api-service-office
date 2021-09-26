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
        $data = info_perusahaan::first();
        return $this->success($data, 'Data Info Perusahaan');
    }
    public function store(info_perusahaan $info){
        $check= $info->all();
        $check= json_decode($check, true);
        if(empty($check)){
            request()->validate([
                'nama_perusahaan' => 'required',
                'alamat' => 'required',
                'phone' => 'required',
                'logo' => 'required'
            ]);
            $logo = request()->file('logo');
            $path = public_path() . '/images';
            $logo->move($path, $logo->getClientOriginalName());
            // $filename  = public_path('uploads/institutions/').$old_logo['logo'];

            $info->create([
                'nama_perusahaan' =>  request('nama_perusahaan'),
                'alamat' =>  request('alamat'),
                'phone' =>  request('phone'),
                'logo' =>   $logo->getClientOriginalName()
            ]);
            return $this->success(null, 'Data Berhasil Tersimpan');
        }else{
            return $this->success(null, 'Info perusahaan sudah tersedia');
        }
    }
    public function update($id,info_perusahaan $info){
      $old_logo = $info->FirstOrFail();
      $filename  = public_path('images/').$old_logo['logo'];
      if (\File::exists($filename)) {
        \File::delete($filename);
      }
      request()->validate([
        'nama_perusahaan' => 'required',
        'alamat' => 'required',
        'phone' => 'required',
        'logo' => 'required|image',
      ]);
      $logo = request()->file('logo');
      $path = public_path() . '/images';
      $logo->move($path, $logo->getClientOriginalName());
      $infoUpdate = $info->find($id);
      $success = $infoUpdate->update([
        'nama_perusahaan' =>  request('nama_perusahaan'),
        'alamat' =>  request('alamat'),
        'phone' =>  request('phone'),
        'logo' =>   $logo->getClientOriginalName()
      ]);
      return $this->success(['data' => $success], 'Success Updated Data');
    }
    public function destroy(info_perusahaan $info){
        $info->first()->delete();
        return $this->success(['data' => 'berhasil terhapus'], 'Success Showing Data');
    }
    public function show($id,info_perusahaan $info){
        return $this->success(['data' => $info->find($id)], 'Success Showing Data');
    }

    public function logo(info_perusahaan $info)
    {
        $logo = $info->FirstOrFail();
        $path  = public_path('images/').$logo['logo'];
        if (!\File::exists($path)) {
            return $this->error("image not found", 404);
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = \Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
      }
}
