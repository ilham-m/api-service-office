<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html" charset="utf-8" />
		<title>Nayaka Teknologi</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="" >
		<!-- <link rel="StyleSheet" href="{{ asset('css/style.css') }}" /> -->
		<script src="https://secure.exportkit.com/cdn/js/ek_googlefonts.js?v=4"></script>
		<!-- Add your custom HEAD content here -->

	</head>
	<body>
            <div id="content-container" >
                <div id="page_invoice_ek1">
                    <div id="header_content" class="divInfo">
                        <div class="divLogo">
                            <div align="left" style="width: 15%;float: left;">
                                <img src="images/logo.png" id="logo"/>
                            </div>
                            <div align="left" style="width: 50%;float: left;">
                                <div id="nama_cv" >{{ $info_perusahaan['nama_perusahaan'] }}</div>
                                <div id="alamat" >{{ $info_perusahaan['alamat'] }}</div>
                                <div id="nomor" >Telepon : {{ $info_perusahaan['phone'] }}</div>
                            </div>
                            <div style="float: right;">
                                <div id="invoice_ek3" >No : {{$info['no_surat_penawaran']}}</div>
                                <div id="tanggal" >Tanggal : {{$info['tanggal']}}</div>
                        </div>
                    </div>
                </div>
                <div id="content_info"  >
                    <div align="left" style="width: 100%;float: left;">
                        <div id="title_bg_tagihan" >
                            <div id="title_penawaran" style="float: middle;" >
                                Surat Penawaran
                            </div>
                        </div>
                        <div id="nama_client" >
                            Yth. {{$info['nama']}}
                        </div>
                        <div id="ket_penawaran">
                        Assallamuallaikum wr wb , <br> {{$info['ket_penawaran']}}
                        </div>
                    </div>

                    <!-- <div align="left" style="width: 50%;float: right;">
                        <div id="title_bg_ket">
                            <div id="title_ket" >
                                Keterangan :
                            </div>
                        </div>
                        <div id="ket" >
                            Untuk Pembayaran Silahkan Tranfer ke Nomor Rekening di Bawah
                        </div>
                        <div id="nama" >
                            <span style="color:#000000; font-style:normal; font-weight:bold;margin-bottom:5px;">427-024-522-1<br/></span><span style="color:#000000; font-style:normal;  font-weight:normal; ">A/N DENI NUR IRAWAN<br/></span><span style="color:#000000; font-style:normal; font-weight:normal; ">Bank Central Asia ( BCA )<br/></span>
                        </div>
                    </div> -->

                </div>
                <div id="table_group">
                    <!-- <div id="title_bg_deskripsi" >
                        <div id="title_deskripsi">
                            Deskripsi Tagihan :
                        </div>
                    </div> -->
                    <table class="desk_table" style="border:1px lightgrey;">
                        <thead>
                            <tr style="border:1px solid lightgrey;">
                                <th>Produk yang ditawarkan</th>
                                <th style="text-align:Right;">Harga
                            </tr>
                        </thead>
                        <tfoot>
                            <tr style="border:1px solid lightgrey;">
                                <td style="text-align:Right;"><b>Total :</b></td>
                                <td  style="text-align:Right;">Rp. {{number_format($total,0,',','.')}}</td>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($detail as $key)
                            <tr style="border:1px solid lightgrey;">
                                <td >{{ $key['penawaran'] }}</td>
                                <td style="text-align:Right;">Rp. {{ number_format($key['harga'] ,0,',','.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        </tr>
                    </table>
                    </div>
                </div>
                <div id="content_info" style=" margin-top:50px;" >
                    <!-- <div align="left" style="width: 100%;float: left;">
                        <div id="title_bg_tagihan" >
                            <div id="title_tagihan" >
                                Tagihan Untuk :
                            </div>
                        </div>
                        <div id="nama_client" >
                            Nama : {{$info['nama']}}
                        </div>
                        <div id="alamat_client" >
                            Alamat : {{$info['alamat']}}
                        </div>
                    </div> -->

                    <div align="left" style="width: 100%;float: left;">
                        <div id="ket_penawaran">
                        Demikian surat penawaran ini kami buat agar bisa dipelajari dan dipertimbangkan oleh bapak/Ibu, jika ada yang kurang jelas dari penawaran ini kita bisa berlanjut diskusi. Terimakasih atas kesempatan yang bapak/ibu berikan kepada kami.
                        </div>
                    </div>

                </div>
                <div id="content_info" style=" margin-top:50px;" >
                    <!-- <div align="left" style="width: 100%;float: left;">
                        <div id="title_bg_tagihan" >
                            <div id="title_tagihan" >
                                Tagihan Untuk :
                            </div>
                        </div>
                        <div id="nama_client" >
                            Nama : {{$info['nama']}}
                        </div>
                        <div id="alamat_client" >
                            Alamat : {{$info['alamat']}}
                        </div>
                    </div> -->

                    <!-- <div align="left" style="width: 60%;float: left;">
                        <div id="ket" >
                            Untuk Pembayaran Silahkan Tranfer ke Nomor Rekening di Bawah
                        </div>
                        <div id="nama" >
                            <span style="color:#000000; font-style:normal; font-weight:bold;margin-bottom:5px;">427-024-522-1<br/></span><span style="color:#000000; font-style:normal;  font-weight:normal; ">A/N DENI NUR IRAWAN<br/></span><span style="color:#000000; font-style:normal; font-weight:normal; ">Bank Central Asia ( BCA )<br/></span>
                        </div>
                    </div> -->
                    <div align="right" style="width: 25%;float: right;">
                        <div id="ket" style="margin-bottom:40px;">
                            Hormat Kami
                        </div>
                        <div style="font-size:10px;margin-bottom:0;width:50%;">Deni Nur Irawan<hr></div>


                    </div>

                </div>
            </div>
        <!-- <div id="bar"></div> -->
	</body>
</html>
