
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
                    <htmlpageheader id="header_content" class="divInfo" name="header">
                        <div class="divLogo">
                            <div align="left" style="width: 15%;float: left;">
                                <img src="images/{{$info_perusahaan['logo']}}" id="logo"/>
                            </div>
                            <div align="left" style="width: 50%;float: left;">
                                <div id="nama_cv" >{{ $info_perusahaan['nama_perusahaan'] }}</div>
                                <div id="alamat" >{{ $info_perusahaan['alamat'] }}</div>
                                <div id="nomor" >Telepon : {{ $info_perusahaan['phone'] }}</div>
                            </div>
                            <div style="float: right;">
                                <div id="invoice_ek3" >No : {{$info['nomor_akad']}}</div>
                        </div>
                        <hr>
                    </htmlpageheader>
                    <sethtmlpageheader name="header" value="on" show-this-page="1"/>
                </div>
                <div id="content_info">
                    <div id="title_akad">SURAT PERJANJIAN KERJASAMA</div>
                    <div id="title_akad">{{ $info['perjanjian'] }}</div>
                </div>

                <div class="content-info">
                    <div align="left" style="width: 100%;float: left;margin-top:40px;">
                        <div id="info_akad" style="margin-bottom: 10px;">
                                <div style="width: 100px;float:left">Nama</div>
                                <div>: <b>{{ $info['nama'] }}</b></div>
                        </div>
                        <div id="info_akad" style="margin-bottom: 10px; width:100%;">
                            <div style="width: 100px;float:left">NIK</div>
                            <div>: {{ $info['nik'] }}</div>
                        </div>
                        <div id="info_akad">
                            <div style="width: 100px;float:left">Alamat</div>
                            <div>: {{ $info['alamat'] }}</div>
                        </div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">Bertindak atas nama pribadi, selanjutnya disebut sebagai <b>PIHAK PERTAMA</b>.</div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:40px;">
                        <div id="info_akad" style="margin-bottom: 10px;">
                                <div style="width: 100px;float:left">Nama</div>
                                <div>: <b>{{ $info['nama_2'] }}</b></div>
                        </div>
                        <div id="info_akad" style="margin-bottom: 10px; width:100%;">
                            <div style="width: 100px;float:left">NIK</div>
                            <div>: {{ $info['nik_2'] }}</div>
                        </div>
                        <div id="info_akad">
                            <div style="width: 100px;float:left">Alamat</div>
                            <div>: {{ $info['alamat_2'] }}</div>
                        </div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">Bertindak atas nama pribadi, selanjutnya disebut sebagai <b>PIHAK KEDUA</b>.</div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        <b>PIHAK PERTAMA</b> adalah pribadi yang bermaksud untuk menggunakan jasa kepada <b>PIHAK KEDUA</b>. <b>PIHAK KEDUA</b> adalah penyedia jasa yang memberikan {{ $info['ket'] }}
                        </div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> dengan ini mengikat suatu perjanjian kerjasama dengan kondisi sebagai berikut :
                        </div>
                    </div>
                </div>

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 1</div>
                    <div id="subtitle_akad">MAKSUD DAN TUJUAN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        Maksud dan tujuan perjanjian kerjasama ini adalah <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> sepakat untuk melakukan kerjasama dibidang {{ $info['ket'] }}.
                        </div>
                    </div>
                </div>
                <pagebreak>
                <div id="content_info" style="margin-bottom:30px;">
                    <div id="subtitle_akad">PASAL 2</div>
                    <div id="subtitle_akad">OBJEK PERJANJIAN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        Objek Perjanjian kerjasama ini adalah berupa {{ $info['ket'] }} yang meliputi ;
                        </div>
                    </div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="listStyleBold">
                            <ol>

                            @foreach($objek as $index => $value)
                                <li>
                                    {{ $value['objek_perjanjian'] }}
                                    @php $subjek = $controller->getSub( $value['objek_perjanjian']); @endphp
                                    <ul id="ulParent">
                                        @foreach($subjek as $i => $v)

                                        <li>
                                            {{$v['subjek_perjanjian']}}
                                            @php $ket = $controller->getKet($v['subjek_perjanjian'],$value['objek_perjanjian']); @endphp
                                            <ol type="A">
                                                @foreach($ket as $index =>$val)
                                                    <li>{{ $val['ket_objek'] }}</li>
                                                @endforeach
                                            </ol>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                @if($objLength['urutan']>=15)
                <pagebreak>
                @endif

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 3</div>
                    <div id="subtitle_akad">NOMINAL JASA</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        <b>PIHAK PERTAMA</b> setuju bahwa nominal dari jasa yang disediakan oleh <b>PIHAK KEDUA</b> adalah sebesar Rp. {{number_format($info['nominal_jasa'] ,0,',','.')}}
                        </div>
                    </div>
                </div>

                @if($objLength['urutan']>=8)
                <pagebreak>
                @endif

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 4</div>
                    <div id="subtitle_akad">HAK DAN KEWAJIBAN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                            <b>PIHAK PERTAMA</b> Berkewajiban :
                        </div>
                        <div id="listStyle">
                            <ol>
                                @foreach($kewajiban_1 as $k => $val)
                                <li>{{ $val['kewajiban']}}</li>
                                @endforeach
                            </ol>
                        </div>
                        <div id="info_akad">
                            <b>PIHAK KEDUA</b> Berkewajiban :
                        </div>
                        <div id="listStyle">
                            <ol>
                                @foreach($kewajiban_2 as $k => $val)
                                <li>{{ $val['kewajiban']}}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 5</div>
                    <div id="subtitle_akad">JANGKA WAKTU</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        Perjanjian kerjasama ini berlaku untuk jangka waktu {{ $info['jangka_waktu'] }} hari kerja, terhitung sejak <b>PIHAK PERTAMA</b> melakukan penandatangan akad kerjasama dan melakukan pembayaran pertama Dp ( down payment ).
                        </div>
                    </div>
                </div>

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 6</div>
                    <div id="subtitle_akad">BERAKHIRNYA PERJANJIAN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> sepakat bahwa Perjanjian Kerjasama ini berakhir bilamana :
                        </div>
                        <ol id="listStyle">
                            <li>Jangka waktu Perjanjian Kerjasama ini telah berakhir dan tidak diperpanjang lagi. </li>
                            <li>Salah satu pihak tidak memenuhi salah satu ketentuan dalam pasal-pasal serta ayat- ayat Perjanjian Kerjasama ini. </li>
                        </ol>
                    </div>
                </div>

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 7</div>
                    <div id="subtitle_akad">PERSELISIHAN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        Apabila dikemudian hari timbul perselisihan dalam pelaksanaan Perjanjian Kerjasama ini, kedua belah pihak sepakat untuk menyelesaikan melalui jalan musyawarah dan mufakat.
                        </div>
                    </div>
                </div>

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 8</div>
                    <div id="subtitle_akad">KETENTUAN LAIN-LAIN</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                            <ol id="listStyle">
                                <li style="margin-top:1opx;margin-bottom:10px;">
                                Ketentuan yang tidak tercantum dalam perjanjian harus dicantumkan dalam perjanjian terpisah yang disepakati oleh <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> atas dasar niat baik.
                                </li>
                                <li style="margin-top:1opx;margin-bottom:10px;">
                                Setiap addendum pada perjanjian ini harus dituangkan secara tertulis dan ditandatangani oleh <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b>.
                                </li>
                                <li style="margin-top:1opx;margin-bottom:10px;">
                                Perjanjian ini ditujukan bagi pihak-pihak yang tercantum dalam perjanjian ini dan pihak lain yang ditujukan dan disepakati oleh <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b>, serta tidak dapat dialihkan kepada pihak lain tanpa kesepakatan <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b>.
                                </li>
                                <li style="margin-top:1opx;margin-bottom:10px;">
                                <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> sepakat untuk menjaga kerahasiaan ini, kecuali bila dinyatakan untuk dibuka berdasarkan hukum yang berlaku.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

                @if($objLength['urutan']<=8)
                <pagebreak>
                @endif

                <div id="content_info" style="margin-top:30px;">
                    <div id="subtitle_akad">PASAL 9</div>
                    <div id="subtitle_akad">PENUTUP</div>
                    <div align="left" style="width: 100%;float: left;margin-top:20px;">
                        <div id="info_akad">
                        Perjanjian ini dibuat rangkap 2 (dua) asli masing-masing sama bunyinya di atas kertas bermaterai cukup serta mempunyai kekuatan hukum yang sama setelah ditandatangani <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b>.
                        </div>
                        <div id="info_akad">
                        Perjanjian ini berlaku efektif sejak tanggal ditandatangani bersama oleh <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b>.
                        </div>
                        <div id="info_akad">
                        Hal-hal yang tidak atau belum diatur dalam Perjanjian Kerjasama ini akan diatur kemudian oleh <b>PIHAK PERTAMA</b> dan <b>PIHAK KEDUA</b> berdasarkan kesepakatan bersama.
                        </div>
                    </div>
                </div>

                <div id="content_info" style=" margin-top:100px;" >
                    <div id="info_akad" style="text-align:center;margin-bottom:20px;">{{ $info['tempat_tanggal'] }}</div>
                    <div style="width: 50%;float:left;">
                        <div id="ket" style="margin-bottom:70px;text-align:center;">
                            Pihak Pertama
                        </div>
                        <div style="width:50%; margin:auto;"><hr></div>

                    </div>
                    <div align="right" style="width: 50%;float:right;">
                        <div id="ket" style="margin-bottom:70px;text-align:center;">
                            Pihak Kedua
                        </div>
                        <div style="width:50%; margin:auto;"><hr></div>
                    </div>

                </div>




            </div>
        <!-- <div id="bar"></div> -->
	</body>
</html>
