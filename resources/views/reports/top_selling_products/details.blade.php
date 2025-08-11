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
                                        <h3>Top Selling Products</h3>
                                    </div>
                                </div>
                            </div>
                            <!--end card-header-->
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr class="table-active">
                                                <th scope="col" style="width: 50px;">#</th>
                                                <th scope="col">Product</th>
                                                <th scope="col" class="text-end">Avg Selling Price</th>
                                                <th scope="col" class="text-end">Total Sold</th>
                                                <th scope="col" class="text-end">Amount</th>
                                                <th scope="col" class="text-end">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody >
                                        @foreach ($topProductsArray as $key => $p)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td class="text-start">{{ $p['name'] }}</td>
                                            <td class="text-end">{{ number_format($p['price'],2) }}</td>
                                            <td class="text-end">{{ number_format($p['sold']) }}</td>
                                            <td class="text-end">{{ number_format($p['amount']) }}</td>
                                            <td class="text-end">{{ number_format($p['stock']) }}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            {{-- <tr>
                                                <th colspan="3" class="text-end">Total</th>
                                                <th class="text-end">{{number_format($total, 2)}}</th>
                                                <th></th>
                                            </tr> --}}
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



