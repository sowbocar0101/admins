<!DOCTYPE html>
<html>
<head>
    <title>Driver Report</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>
        @font-face {
            font-family: 'HiraKakuPro';
            font-style: normal;
            font-weight: normal;
            src: url("{{ asset('font/HiraKakuPro-W3.ttf') }}") format('truetype');
        }
        @media print{
            @page{
                margin: 0cm;
            }
            body {
                font-family: HiraKakuPro !important;
            }
        }
        body {
            font-family: HiraKakuPro !important;
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
        .header td {
            font-size: 20px;
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
        .navbar .navbar-brand-wrapper .navbar-brand {
            font-size: 1.5rem;
            margin-right: 0;
            padding: .25rem 0;
        }
    </style>
</head>
<body>
    <div class="paper-a4">
        <table class="header">
            <tbody>
                <tr>
                    <td>
                        @lang('default.app_name')</h1>
                    </td>
                    <td style="text-align: right;">
                        @lang('default.sidenav.driver')
                        <br>
                        {{date('Y-m-d')}}
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="bordered">
            <tbody>
                <tr>
                    <td>@lang('default.table.no')</td>
                    <td>@lang('default.table.name')</td>
                    <td>@lang('default.table.email')</td>
                    <td>@lang('default.table.phone')</td>
                    {{-- <td>@lang('default.table.status')</td> --}}
                </tr>
                @foreach ($data as $key => $value)
                    <tr>
                        <td width="30">{{ $key + 1 }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->phone }}</td>
                        {{-- <td>{{ $value->status }}</td> --}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>

