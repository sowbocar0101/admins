{{-- ====A+P+P+K+E+Y==== --}}

<!DOCTYPE html>
<html>
<head>
    {{--<title>Booking Report {{ $formattedStartDate }} - {{ $formattedEndDate }}</title>--}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
        }
        .paper-a4 {
            width: 100%;
        }
        table {
            width: 100%;
            border-spacing: 0;
            border-collapse: collapse;
        }
        table.bordered {
            border: 1px solid #000;
        }
        table.bordered td {
            padding: 8px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered th {
            padding: 8px;
            border-right: 1px solid #000;
            border-bottom: 1px solid #000;
        }
        table.bordered tr:last-child td {
            border-bottom: 0px solid #000;
        }
        table.bordered tfoot {
            border-top: 1px solid #000;
        }
        .header {
            width: 100%;
            margin-bottom: 10px
        }
        .header h1 {
            margin: 0
        }
        .text-right {
            text-align: right
        }
        .valign-top {
            vertical-align: top
        }
        .valign-bottom {
            vertical-align: bottom
        }
        .no-padding {
            padding: 0;
        }
        .no-margin {
            margin: 0 !important;
        }
        .mb-20 {
            margin-bottom: 20px;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mb-10 {
            margin-bottom: 10px;
        }
        .mt-10 {
            margin-top: 10px;
        }
        .mb-5 {
            margin-bottom: 5px;
        }
        .mt-5 {
            margin-top: 5px;
        }
        .mb-0 {
            margin-bottom: 0px;
        }
        .mt-0 {
            margin-top: 0px;
        }
        hr {
            border: 0;
            height: 1px;
            background: #333;
            margin: 24px 0
        }
        .notes {
            padding: 16px;
            margin-bottom: 32px;
            border: 1px solid
        }
        h1, h2, h3, h4, h5, h6 {
            color: #000
        }
        .heading {
            background: #dedede;
            padding: 8px 16px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="paper-a4">
        <table class="bordered">
            <thead>
                <tr>
                    <th>@lang('default.table.no')</th>
                    <th>@lang('default.table.name')</th>
                    <th>@lang('default.table.email')</th>
                    <th>@lang('default.table.phone')</th>
                    {{-- <th>@lang('default.table.status')</th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                <tr>
                    <td width="10">{{ $key + 1 }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>'{{ $value->phone }}'</td>
                    {{-- <td>{{ $value->status }}</td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
