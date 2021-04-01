<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title>{{env('APP_NAME')}}</title>

        <style>
            body {
                font-family:sans-serif;
                font-size:14px;
                padding:50px;
            }
            div#header {
                margin-bottom:50px;
                text-align:center;
            }
            div#footer {
                border:0px;
                position:fixed;
                width:100%;
            }

            table.table01 {
                border:1px solid #000;
                border-collapse:collapse;
            }
            table.table01 tr>th {
                vertical-align:top;
            }
            table.table01 tr>td {
                padding:0 8px 8px 8px;
                vertical-align:top;
            }
            table.table01 tr>td+td {
                border-left:1px solid #000;
            }
            table.bt-0 {
                border-top:0;
            }
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    <body>
        <div id="header">
            <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                    <td>
                        <img src="../public/img/logo.png" alt="{{env('APP_NAME')}}" width="150px" />
                    </td>
                    <td align="right">
                        @yield('titulo')
                    </td>
                </tr>
            </table>
        </div>
        @yield('conteudo')
    </body>
</html>
