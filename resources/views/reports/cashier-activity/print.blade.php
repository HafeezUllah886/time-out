<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>POS Bill</title>
    <style>
        body{
            background: rgb(232, 232, 232);
            font-size: 15px;
            font-family: "Helvetica";
        }
        .main{
            width: 80mm;
            background: #fff;
            overflow: hidden;
            margin: 0px auto;
            padding: 10px;
        }
        .logo{
            width: 100%;
            overflow: hidden;
            height: 130px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .logo img{
            width:80%;
        }
        .header p{
            margin: 2px 0px;
        }
        .content{
            overflow: hidden;
            width: 100%;
        }
        .content table{
            width: 100%;
            border-collapse: collapse;
        }

        .bg-dark{
            background: black;
            color:#ffff;
        }

        .text-left{
            text-align: left !important;
        }
        .text-right{
            text-align: right !important;
        }
        .text-center{
            text-align: center !important;
        }
        .area-title{

            font-size: 18px;
        }
        tr.bottom-border {
            border-bottom: 1px solid #ccc; /* Add a 1px solid border at the bottom of rows with the "my-class" class */
        }
        .uppercase{
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <div class="main" id="main">
        <div style="text-align: center;">
            {{-- <img style="width:100%;margin:0 auto;height:100px;" src="{{ asset('assets/images/header.jpg') }}" alt=""> --}}
            <h2 class="text-center" style="margin: 0">TIME-OUT MART</h2>
            <h3 class="text-center" style="margin: 0">Attock Petrol Pump, Airport Road, Quetta</h3>
{{--             <h5 class="text-center" style="margin: 0">0335-2665222</h5> --}}
         </div>
        <div class="header">
           {{--  <p class="text-center"><strong>081-2502481</strong></p>
            <p class="text-center"><strong>Fatima Jinnah Road Near Bugti Gali Zarghoon Plaza Quetta</strong></strong></p> --}}
            <div class="area-title">
                <p class="text-center bg-dark">Cashier Activity</p>
            </div>
            <table>
                <tr>
                    <td>From: </td>
                    <td> {{date('d-m-Y', strtotime($from)) }}</td>
                    
                </tr>
                <tr>
                    <td>To: </td>
                    <td> {{date('d-m-Y', strtotime($to)) }}</td>

                </tr>
                <tr>
                    <td>Printer On: </td>
                    <td> {{ date("d-m-Y h:i A", strtotime(now())) }}</td>

                </tr>
                <tr>
                    <td>Cashier: </td>
                    <td> {{ $user }}</td>

                </tr>
                <tr>
                    <td>Opening Balance: </td>
                    <td> {{ $pre_balance }}</td>
                </tr>
                <tr>
                    <td>Cash Given: </td>
                    <td> {{ $cash_given }}</td>
                </tr>
                <tr>
                    <td>Sales: </td>
                    <td> {{ $sales }}</td>
                </tr>
                <tr>
                    <td>Discount: </td>
                    <td> {{ $discounts }}</td>
                </tr>
                <tr>
                    <td>Delivery Charges: </td>
                    <td> {{ $dc }}</td>
                </tr>
                <tr>
                    <td>Cash Taken: </td>
                    <td> {{ $cash_taken }}</td>
                </tr>
                <tr>
                    <td>Current Balance: </td>
                    <td> {{ $current }}</td>
                </tr>              
            </table>
        </div>
       
        <div class="footer">
            <hr>
            <h5 class="text-center">Developed by Diamond Software <br> diamondsoftwareqta.com</h5>
        </div>
    </div>
</body>

</html>
<script src="{{ asset('src/plugins/src/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
setTimeout(function() {
    window.print();
    }, 2000);
        setTimeout(function() {
            window.location.href = "{{ url('pos')}}";
    }, 5000);

</script>
