<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title id="page-title">ANGSURAN PRINT | {{ config('app.name') }}</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 11px;
            margin: -30px;
            padding: 0px;
        }

        .coupon-container {
            width: 48%;
            display: inline-block;
            border: 1px dashed #000;
            padding: 5px;
            margin: 0 0 0.5% 0;
            box-sizing: border-box;
            /* height: 200px; */
            vertical-align: top;
        }

        .coupon-box {
            display: inline-block;
            border: 1px solid #000;
            padding: 5px;
            box-sizing: border-box;
        }

        .page-break {
            page-break-after: always;
        }

        td.border {
            border: 1px solid black;
            /* border-collapse: collapse; */
        }
    </style>
</head>
<body>

@foreach ($angsuranList->chunk(10) as $chunks)
    <div class="page">

        @foreach ($chunks as $index => $angsuran)
            <div class="coupon-container">
                <div class="coupon-box">
                    <table width="100%">
                        <tr>
                            <td rowspan="2" style="width: 40%; padding-right: 5px;">
                                <img src="{{ public_path() . '/images/logo/logo-full.png' }}" width="100%">
                            </td>
                            <td class="border" style="width: 30%; padding: 2px;">Angsuran Ke</td>
                            <td class="border" style="width: 30%; padding: 2px; text-align: right;"><b>{{ sprintf('%03d', $angsuran->number) }}</b> / {{ $data->tenor }}</td>
                        </tr>
                        <tr>
                            <td class="border" style="padding: 2px">Nilai Angsuran</td>
                            <td class="border" style="padding: 2px; text-align: right;">Rp {{ currency($data->bill_per_day)}}</td>
                        </tr>
                    </table>

                    <div style="width: 100%; border-bottom: solid 1px #000; padding: 2px 0 2px 0;"></div>

                    <table width="100%">
                        <tr>
                            <td width="25%">Terima Dari</td>
                            <td width="1%">:</td>
                            <td>{{ $data->consumer->name }}</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>{{ $data->consumer->home_address }}</td>
                        </tr>
                        <tr>
                            <td>Telpon / WA</td>
                            <td>:</td>
                            <td>{{ phoneNumberShow($data->consumer->phone) }}</td>
                        </tr>
                    </table>

                    <div style="width: 100%; border-bottom: solid 1px #000; padding: 2px 0 2px 0;"></div>

                    <table width="100%">
                        <tr>
                            <td width="25%">Mitra Bisnis</td>
                            <td width="1%">:</td>
                            <td>{{ $data->sales->name }}</td>
                        </tr>
                        <tr>
                            <td>Wasdit</td>
                            <td>:</td>
                            <td>{{ $data->wasdit->name }}</td>
                        </tr>
                        <tr>
                            <td>Tgl Jth Tempo</td>
                            <td>:</td>
                            <td>{{ $angsuran->date_at->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td>Nama Barang</td>
                            <td>:</td>
                            <td>{{ $data->product->name }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        @endforeach

    </div>
@endforeach

</body>
</html>
