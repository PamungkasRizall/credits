<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title id="page-title">INVOICE PRINT | {{ config('app.name') }}</title>
	<style type="text/css" media="all">
		@font-face {
			font-family: SourceSansPro;
			src: url({{ asset('assets/vendor-backend/webfonts/SourceSansPro-Regular.ttf') }});
		}

		body {
			margin: -30px;
			padding: 0;
			background-color: #FFF;
			font-family: Arial, sans-serif;
			font-size: 12px;
		}

        table.items, table.items th, table.items td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        td.dotted::before {
            content: "(.................................)";
        }
	</style>
</head>
<body>
	<div
        style="
            border: solid 1px #000000;
            margin-bottom: 2px;
        ">
        <table width="100%">
            <tr>
                <td width="25%" rowspan="2">
                    <img src="{{ public_path() . '/images/logo/logo-full.png' }}" width="100%">
                </td>
                <td width="75%" style="text-align: center;">
                    <b style="border-bottom: solid 1px #000000; font-size: 14px;">FAKTUR SEWA BELI</b>
                </td>
                <td width="25%"></td>
            </tr>
            <tr>
                <td style="text-align:center;">NO. KONTRAK : {{ $data->contract_code }}</td>
                <td></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size: 10px;">
                    JASA SEWA BELI / KREDIT<br>
                    ELECTRONIC & FURNITURE
                </td>
                <td>
                    TANGGAL: {{ $data->date_at->format('d M Y') }}
                </td>
            </tr>
        </table>
	</div>

    <div
        style="
            border: solid 1px #000000;
        ">
        <table width="100%">
            <tr>
                <td width="15%">
                    NAMA
                </td>
                <td width="1%">
                    :
                </td>
                <td width="24%">
                    {{ $data->consumer->name }}
                </td>
                <td width="30%">
                    MITRA BISNIS : {{ $data->sales->name }}
                </td>
                <td width="30%">
                    WASDIT : {{ $data->wasdit->name }}
                </td>
            </tr>
            <tr>
                <td>
                    JENIS USAHA
                </td>
                <td>
                    :
                </td>
                <td colspan="3">
                    {{ $data->consumer->business_type }}
                </td>
            </tr>
            <tr>
                <td>
                    ALAMAT
                </td>
                <td>
                    :
                </td>
                <td colspan="3">
                    {{ $data->consumer->home_address }}
                </td>
            </tr>
            <tr>
                <td>
                    TELP / WA
                </td>
                <td>
                    :
                </td>
                <td colspan="2">
                    {{ phoneNumberShow($data->consumer->phone) }}
                </td>
                <td>
                    RADIUS : {{ $data->consumer->radius }} km
                </td>
            </tr>
        </table>
	</div>

    <table width="100%" class="items" style="padding-top: 3px; border-bottom: 3px;">
        <thead>
            <tr style="background-color: #eff0f2;">
                <th>NAMA BARANG</th>
                <th>MERK</th>
                <th>TYPE</th>
                <th>UNIT</th>
                <th>ANGSURAN</th>
                <th>TENOR / HARI</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 3px;">{{ $data->product->name }}</td>
                <td style="padding: 3px;">{{ $data->product->merk->name }}</td>
                <td style="padding: 3px;">{{ $data->product->type }}</td>
                <td style="padding: 3px;">{{ $data->product->unit->name }}</td>
                <td style="padding: 3px;">Rp {{ currency($data->bill_per_day)}}</td>
                <td style="padding: 3px;">{{ $data->tenor }}</td>
            </tr>
        </tbody>
    </table>

    <table style="width: 100%; border: solid 1px #000000; margin-top: 2px; text-align: center;">
        <tr>
            <td colspan="3" style="text-align: left;">
                DITERIMA TANGGAL :
            </td>
        </tr>
        <tr>
            <td style="width: 33.33%; padding-top: 15px;">
                PENERIMA
            </td>
            <td style="width: 33.33%;">
                <b>BARANG DITERIMA</b>
            </td>
            <td style="width: 33.33%;">
                HORMAT KAMI
            </td>
        </tr>
        <tr>
            <td class="dotted" style="padding-top: 30px;"></td>
            <td></td>
            <td class="dotted" style="padding-top: 30px;"></td>
        </tr>
        <tr>
            <td>NAMA JELAS</td>
            <td></td>
            <td>DIREKTUR</td>
        </tr>
        <tr>
            <td colspan="3" style="font-size: 10px;">
                <i><b>PERHATIAN: BARANG YANG SUDAH DIBELI TIDAK DAPAT DITUKAR / DIKEMBALIKAN!</b></i>
            </td>
        </tr>
    </table>
</body>
</html>
