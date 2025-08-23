@extends('layout.popups')
@section('content')
        <div class="row justify-content-center">
            <div class="col-xxl-9">
                <div class="card" id="demo">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end d-print-none p-2 mt-4">
                                <a href="javascript:window.print()" class="btn btn-success ml-4"><i class="ri-printer-line mr-4"></i> Print</a>
                            </div>
                            <div class="card-header border-bottom-dashed p-4">
                                <div class="d-flex">
                                    <div class="flex-grow-1">
                                        <h1>{{projectNameAuth()}}</h1>
                                    </div>
                                    <div class="flex-shrink-0 mt-sm-0 mt-3">
                                        <h3>Daily Product Wise Sales</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="row g-3">
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">From</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y h:i A', strtotime($from)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">To</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y h:i A', strtotime($to)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Cashier</p>
                                        <h5 class="fs-14 mb-0">{{ $user }}</h5>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Product</th>
                                                <th scope="col" class="text-end">Sold Qty</th>
                                                <th scope="col" class="text-end">Amount</th>
                                                <th scope="col" class="text-end">Avg P-Price</th>
                                                <th scope="col" class="text-end">Avg S-Price</th>
                                                <th scope="col" class="text-end">Profit / PC</th>
                                                <th scope="col" class="text-end">Profit</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                            @php
                                                $total = 0;
                                                $total_profit = 0;
                                            @endphp
                                        @foreach ($products as $key => $p)
                                        @if($p->qty > 0)
                                        @php
                                            $total += $p->total;
                                            $avg_s_price = $p->total / $p->qty;
                                            $avg_profit = $avg_s_price - $p->avg_purchase;
                                            $profit = $avg_profit * $p->qty;
                                            $total_profit += $profit;
                                        @endphp
                                     
                                        <tr>
                                            <td class="p-1">{{ $key+1 }}</td>
                                            <td class="text-start p-1">{{ $p->name }}</td>
                                            <td class="text-end p-1">{{ $p->qty }}</td>
                                            <td class="text-end p-1">{{ number_format($p->total) }}</td>
                                            <td class="text-end p-1">{{ number_format($p->avg_purchase) }}</td>
                                            <td class="text-end p-1">{{ number_format($avg_s_price) }}</td>
                                            <td class="text-end p-1">{{ number_format($avg_profit) }}</td>
                                            <td class="text-end p-1">{{ number_format($profit) }}</td>
                                        </tr>
                                        @endif
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="3" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($total, 2)}}</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th class="text-end">{{number_format($total_profit, 2)}}</th>
                                            </tr>
                                        </tfoot>
                                    </table><!--end table-->
                                </div>

                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div>
                <!--end card-->
            </div>
            <!--end col-->
        </div>
        <!--end row-->

@endsection



