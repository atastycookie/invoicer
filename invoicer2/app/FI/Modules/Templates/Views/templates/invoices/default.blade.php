<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{{ trans('fi.invoice') }}} #{{{ $invoice->number }}}</title>

    <style>
        @page {
            margin: 25px;
        }

        body {
            color: #001028;
            background: #FFFFFF;
            font-family: sans-serif;
            font-size: 12px;
            margin-bottom: 50px;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        h1 {
            color: #5D6975;
            font-size: 2.8em;
            line-height: 1.4em;
            font-weight: bold;
            margin: 0;
        }

        table {
            width: 100%;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        th {
            padding: 5px 10px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        td {
            padding: 10px;
        }

        table.alternate tr:nth-child(even) td {
            background: #F5F5F5;
        }

        th.amount, td.amount {
            text-align: right;
        }

        .info span {
            color: #5D6975;
            font-weight: bold;
        }

        .footer {
            position: fixed;
            height: 50px;
            width: 100%;
            bottom: 0px;
            text-align: center;
        }

    </style>
</head>
<body>

<table>
    <tr>
        <td style="width: 50%;" valign="top">
            <h1>{{{ mb_strtoupper(trans('fi.invoice')) }}}</h1>
            <div class="info">
                <span>{{{ mb_strtoupper(trans('fi.invoice')) }}} #</span>{{{ $invoice->number }}}<br>
                <span>{{{ mb_strtoupper(trans('fi.issued')) }}}</span> {{{ $invoice->formatted_created_at }}}<br>
                <span>{{{ mb_strtoupper(trans('fi.due_date')) }}}</span> {{{ $invoice->formatted_due_at }}}<br><br>
                <span>{{{ mb_strtoupper(trans('fi.bill_to')) }}}</span><br>{{{ $invoice->client->name }}}<br>
                @if ($invoice->client->address) {{ $invoice->client->formatted_address }}<br>@endif
            </div>
        </td>
        <td style="width: 50%; text-align: right;" valign="top">
            {{ $logo }}<br>
            {{{ $invoice->user->company }}}<br>
            {{ $invoice->user->formatted_address }}<br>
            @if ($invoice->user->phone) {{{ $invoice->user->phone }}}<br>@endif
            @if ($invoice->user->email) <a href="mailto:{{{ $invoice->user->email }}}">{{{ $invoice->user->email }}}</a>@endif
        </td>
    </tr>
</table>

<table class="alternate">
    <thead>
    <tr>
        <th style="width: 30%;">{{{ mb_strtoupper(trans('fi.product')) }}}</th>
        <th style="width: 40%;">{{{ mb_strtoupper(trans('fi.description')) }}}</th>
        <th style="width: 10%;" class="amount">{{{ mb_strtoupper(trans('fi.quantity')) }}}</th>
        <th style="width: 10%;" class="amount">{{{ mb_strtoupper(trans('fi.price')) }}}</th>
        <th style="width: 10%;" class="amount">{{{ mb_strtoupper(trans('fi.total')) }}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($invoice->items as $item)
    <tr>
        <td>{{{ $item->name }}}</td>
        <td>{{ $item->formatted_description }}</td>
        <td class="amount">{{{ $item->formatted_quantity }}}</td>
        <td class="amount">{{{ $item->formatted_price }}}</td>
        <td class="amount">{{{ $item->amount->formatted_subtotal }}}</td>
    </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{{ mb_strtoupper(trans('fi.subtotal')) }}}</td>
        <td class="amount">{{{ $invoice->amount->formatted_item_subtotal }}}</td>
    </tr>

    @foreach ($invoice->summarized_taxes as $tax)
    <tr>
        <td colspan="4" class="amount">{{{ mb_strtoupper($tax->name) }}} ({{{ $tax->percent }}})</td>
        <td class="amount">{{{ $tax->total }}}</td>
    </tr>
    @endforeach

    <tr>
        <td colspan="4" class="amount">{{{ mb_strtoupper(trans('fi.total')) }}}</td>
        <td class="amount">{{{ $invoice->amount->formatted_total }}}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{{ mb_strtoupper(trans('fi.paid')) }}}</td>
        <td class="amount">{{{ $invoice->amount->formatted_paid }}}</td>
    </tr>
    <tr>
        <td colspan="4" class="amount">{{{ mb_strtoupper(trans('fi.balance')) }}}</td>
        <td class="amount">{{{ $invoice->amount->formatted_balance }}}</td>
    </tr>
    </tbody>
</table>

@if ($invoice->terms)
<table style="margin-top: 50px;">
    <tr>
        <th>{{ mb_strtoupper(trans('fi.terms_and_conditions')) }}</th>
    </tr>
    <tr>
        <td>{{ $invoice->formatted_terms }}</td>
    </tr>
</table>
@endif

<div class="footer">{{ $invoice->formatted_footer }}</div>

</body>
</html>