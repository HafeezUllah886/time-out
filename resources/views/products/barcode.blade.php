<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>POS Barcode</title>
    <style>
        @page {
            size: 38mm 25mm;
            margin: 0;
        }
        body {
            width: 38mm;
            height: 25mm;
            margin: 0;
            padding: 0;
            font-size: 15px;
            font-family: "Helvetica", Arial, sans-serif;
            background: #fff;
        }
        .main {
            width: 38mm;
            height: 25mm;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
            /* Remove margin/padding to avoid shifting */
        }
        .label {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        .truncate {
            width: 100%;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            text-align: center;
        }
        h5 {
            margin: 0;
            padding: 0;
            font-size: 12px;
        }
        /* Prevent page breaks inside the label */
        .main, .label {
            page-break-inside: avoid;
            break-inside: avoid;
        }
        @media print {
            html, body {
                width: 38mm;
                height: 25mm;
            }
            body * {
                visibility: visible;
            }
            .main {
                position: static !important;
            }
        }
    </style>
</head>
<body>
    <div class="main" id="main">
        <div class="label">
            <h5 class="truncate">
                {{ $product->name }}
            </h5>
            <h5>
                {!! DNS1D::getBarcodeSVG($product->code, 'C128', 1.2, 70) !!}
            </h5>
        </div>
    </div>
    <script>
        window.onload = function() {
        window.print();
        window.onafterprint = function() {
            window.location.href = '/product';
        };
    };
    </script>
</body>
</html>