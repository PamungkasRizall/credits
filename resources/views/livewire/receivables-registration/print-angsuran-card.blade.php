@php
    $firstLetter = strtoupper(substr($data->consumer->name, 0, 1));
    $total = count($angsuranList);
    $half = ceil($total / 2);
@endphp
<!DOCTYPE html>
<html>
<head>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title id="page-title">ANGSURAN CARD PRINT | {{ config('app.name') }}</title>
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
                @foreach (range('A', 'Z') as $alphabet)
                    <td width="3.85%" style="text-align: center; border: 1px solid black; {{ $alphabet == $firstLetter ? 'background-color: yellow;' : '' }}">{{ $alphabet }}</td>
                @endforeach
            </tr>
        </table>
    </div>

    <div
        style="
            border: solid 1px #000000;
            margin-bottom: 2px;
        ">
        <table width="100%" cellspacing="0">
            <tr>
                <td rowspan="2" width="13%" style="border-right: solid 1px black; text-align: center;">
                    <img src="{{ public_path() . '/images/logo/logo.png' }}" width="60%">
                </td>
                <td style="border-right: solid 1px black; text-align: center; font-weight: bold;">TGL FAKTUR</td>
                <td style="border-right: solid 1px black; text-align: center; font-weight: bold;">NO FAKTUR</td>
                <td style="border-right: solid 1px black; text-align: center; font-weight: bold;">RADIUS</td>
                <td width="25%" style="text-align: center; font-weight: bold;">PERIODE ANGSURAN</td>
            </tr>
            <tr>
                <td style="border-right: solid 1px black; text-align: center;">{{ $data->date_at->format('d/m/Y') }}</td>
                <td style="border-right: solid 1px black; text-align: center;">{{ $data->contract_code }}</td>
                <td style="border-right: solid 1px black; text-align: center;">{{ $data->consumer->radius }} km</td>
                <td style="text-align: center;">{{ $data->date_at->format('d/m/Y') }} s/d {{ $data->date_at->addDays($data->tenor)->format('d/m/Y') }}</td>
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
                <td width="36%">
                    {{ $data->consumer->name }}
                </td>
                <td width="24%">
                    NIK : {{ $data->consumer->nik }}
                </td>
                <td width="24%">
                    SPA : ...... Kali
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
                    JENIS USAHA
                </td>
                <td>
                    :
                </td>
                <td>
                    {{ $data->consumer->business_type }}
                </td>
                <td colspan="2">
                    STATUS USAHA : {{ $data->consumer->business_status }}
                </td>
            </tr>
            <tr>
                <td>
                    ALAMAT USAHA
                </td>
                <td>
                    :
                </td>
                <td colspan="3">
                    {{ $data->consumer->business_address }}
                </td>
            </tr>
            <tr>
                <td>
                    ANGSURAN
                </td>
                <td>
                    :
                </td>
                <td>
                    RP. {{ currency($data->bill_per_day)}} x {{ $data->tenor }}
                </td>
                <td colspan="2">
                    = Rp. {{ currency($data->bill_per_day * $data->tenor) }}
                </td>
            </tr>
            <tr>
                <td colspan="3" style="font-weight: bold; text-align: right; padding-right: 20px;">TOTAL</td>
                <td style="font-weight: bold; border-top: solid 1px black;">
                    = Rp. {{ currency($data->bill_per_day * $data->tenor) }}
                </td>
                <td></td>
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
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 3px;">{{ $data->product->name }}</td>
                <td style="padding: 3px;">{{ $data->product->merk->name }}</td>
                <td style="padding: 3px;">{{ $data->product->type }}</td>
                <td style="padding: 3px;">{{ $data->product->unit->name }}</td>
            </tr>
        </tbody>
    </table>

    <table width="100%" class="items" style="padding-top: 3px; border-bottom: 3px;">
        <tr>
            <td width="34%" style="padding: 3px;">WASDIT : {{ $data->wasdit->name }}</td>
            <td width="33%" style="padding: 3px;">SUPERVISOR : {{ $data->supervisor->name }}</td>
            <td width="33%" style="padding: 3px;">MITRA BISNIS : {{ $data->sales->name }}</td>
        </tr>
    </table>

    <table width="100%" class="items" style="padding-top: 3px; border-bottom: 3px;">
        <thead>
            <tr style="background-color: #eff0f2;">
                <th width="5%">NO</th>
                <th width="25%">TGL BAYAR</th>
                <th width="10%">NILAI ANGS (K)</th>
                <th width="10%">SALDO (D) PIUTANG</th>
                <th width="5%">NO</th>
                <th width="25%">TGL BAYAR</th>
                <th width="10%">NILAI ANGS (K)</th>
                <th width="10%">SALDO (D) PIUTANG</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 0; $i < $half; $i++)
                <tr>
                    {{-- KIRI --}}
                    <td style="padding: 3px; text-align: center; height: 15px;">{{ $i + 1 }}</td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i]['tgl_bayar'] ?? '' }}
                    </td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i]['nilai_angs'] ?? '' }}
                    </td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i]['saldo_piutang'] ?? '' }}
                    </td>

                    {{-- KANAN --}}
                    <td style="padding: 3px; text-align: center;">
                        @if (isset($angsuranList[$i + $half]))
                            {{ $i + 1 + $half }}
                        @endif
                    </td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i + $half]['tgl_bayar'] ?? '' }}
                    </td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i + $half]['nilai_angs'] ?? '' }}
                    </td>
                    <td style="padding: 3px;">
                        {{ $angsuranList[$i + $half]['saldo_piutang'] ?? '' }}
                    </td>
                </tr>
            @endfor
        </tbody>
    </table>

    {{-- <table style="width: 100%; border: solid 1px #000000; margin-top: 2px; text-align: center;">
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
    </table> --}}
</body>
</html>
