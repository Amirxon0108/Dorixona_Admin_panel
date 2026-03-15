        <!DOCTYPE html>
    <html>
    <head>
    <meta charset="utf-8">
    <style>
    body{
    font-family: DejaVu Sans;
    }
    table{
    width:100%;
    border-collapse: collapse;
    }
    th,td{
    border:2px solid #222020;
    padding:8px;
    }
    </style>
    </head>

    <body>

    <h2>Invoice #{{ $sale->invoice_number }}</h2>

    <p>Sotuvchi: {{ $sale->user->name }}</p>
    <p>Sana: {{ $sale->created_at->format('d.m.Y') }}</p>

    <table>
<thead>
<tr>
<th>#</th>
<th>Dori</th>
<th>Narxi</th>
<th>Qty</th>
<th>Tan narxi</th>
</tr>
</thead>

<tbody>

@foreach($sale->items as $index => $item)

<tr>
<td>{{ $index+1 }}</td>
<td >{{ $item->medicine->name }}</td>
<td style="text-align:right;">{{ $item->unit_price }}</td>
<td style="text-align:right;">{{ $item->quantity }}</td>
<td style="text-align:right;">{{ $item->unit_price * $item->quantity }}</td>
</tr>

@endforeach

<tr>

<th colspan="4" style="text-align:right;">Soliq QQS 12%</th>
<td>{{ number_format($sale->total_amount/100*12) }}</td>
</tr>

<tr>
<th colspan="4" style="text-align:right;">Dori tannarxi</th>
<td>{{ number_format($sale->sub_total,2) }} so'm</td>
</tr>

<tr>
<th colspan="4" style="text-align:right;">Chegirma</th>
<td>{{ number_format($sale->discount,2) }} so'm</td>
</tr>

<tr>
<th colspan="4" style="text-align:right;">Hammasi</th>
<td><strong>{{ number_format($sale->total_amount + $sale->total_amount/100*12, 2) }} so'm</strong></td>
</tr>

</tbody>
</table>
    </body>
    </html>