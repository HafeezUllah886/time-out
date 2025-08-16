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
                                        <h3>Activity Report</h3>
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
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($from)) }}</h5>
                                    </div>
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">To</p>
                                        <h5 class="fs-14 mb-0">{{ date('d M Y', strtotime($to)) }}</h5>
                                    </div>
                                    <!--end col-->
                                    <!--end col-->
                                    <div class="col-lg-3 col-6">
                                        <p class="text-muted mb-2 text-uppercase fw-semibold">Printed On</p>
                                        <h5 class="fs-14 mb-0"><span id="total-amount">{{ date("d M Y") }}</span></h5>
                                        {{-- <h5 class="fs-14 mb-0"><span id="total-amount">{{ \Carbon\Carbon::now()->format('h:i A') }}</span></h5> --}}
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </div>
                            <!--end card-body-->
                        </div><!--end col-->
                        
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="card-header">
                                    <h5>Purchases</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="p-1 m-0" style="width: 50px; ">#</th>
                                                <th scope="col" class="p-1 m-0 text-start">Product</th>
                                                <th scope="col" class="p-1 m-0 text-end">Price</th>
                                                <th scope="col" class="p-1 m-0 text-end">Qty</th>
                                                <th scope="col" class="p-1 m-0 text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $ser = 0;
                                            @endphp
                                           @foreach ($products as $key => $product)
                                           @if($product->purchases)
                                            @php
                                                $ser++;
                                            @endphp
                                            <tr>
                                                <td>{{ $ser }}</td>
                                                <td class="text-start p-1 m-0">{{ $product->name }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->purchases['price'],2) }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->purchases['qty'],2) }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->purchases['total'],2) }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        <tr class="table-active">
                                            <th colspan="3" class="text-end p-1 m-0">Total</th>
                                            <th class="text-end p-1 m-0">{{ number_format($products->sum('purchases.qty'),2) }}</th>
                                            <th class="text-end p-1 m-0">{{ number_format($products->sum('purchases.total'),2) }}</th>
                                        </tr>
                                        </tbody>
                                    </table><!--end table-->
                                </div>

                            </div>
                            <!--end card-body-->
                        </div><!--end col-->

                        <div class="col-lg-12">
                            <div class="card-body p-4 pt-0">
                                <div class="card-header">
                                    <h5>Sales</h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" class="p-1 m-0" style="width: 50px;">#</th>
                                                <th scope="col" class="p-1 m-0 text-start">Product</th>
                                                <th scope="col" class="p-1 m-0 text-end">Price</th>
                                                <th scope="col" class="p-1 m-0 text-end">Qty</th>
                                                <th scope="col" class="p-1 m-0 text-end">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $ser = 0;
                                            @endphp
                                           @foreach ($products as $key => $product)
                                           @if($product->sales)
                                            @php
                                                $ser++;
                                            @endphp
                                            <tr>
                                                <td class="p-1 m-0">{{ $ser }}</td>
                                                <td class="text-start p-1 m-0">{{ $product->name }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->sales['price'],2) }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->sales['qty'],2) }}</td>
                                                <td class="text-end p-1 m-0">{{ number_format($product->sales['total'],2) }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                        <tr class="table-active">
                                            <th colspan="3" class="text-end p-1 m-0">Total</th>
                                           
                                            <th class="text-end p-1 m-0">{{ number_format($products->sum('sales.qty'),2) }}</th>
                                            <th class="text-end p-1 m-0">{{ number_format($products->sum('sales.total'),2) }}</th>
                                        </tr>
                                        </tbody>
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



