@extends('layout.app')
@section('content')
    <div class="row d-flex justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>View Daily Product Wise Sale</h3>
                </div>
                <div class="card-body">
                    <div class="form-group mt-2">
                        <label for="from">From</label>
                        <input type="datetime-local" name="from" id="from" value="{{ date('Y-m-d H:i:s') }}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="to">To</label>
                        <input type="datetime-local" name="to" id="to" value="{{ date('Y-m-d H:i:s') }}" class="form-control">
                    </div>
                    <div class="form-group mt-2">
                        <label for="user">Cashier</label>
                        <select name="user" id="user" class="form-control">
                            <option value="all">All</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-success w-100" id="viewBtn">View Report</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('page-js')

    <script>
        $("#viewBtn").on("click", function (){
            var from = $("#from").val();
            var to = $("#to").val();
            var user = $("#user").find(':selected').val();
            var url = "{{ route('dailySalesReportData', ['from' => ':from', 'to' => ':to', 'user' => ':user']) }}"
        .replace(':from', from)
        .replace(':to', to)
        .replace(':user', user);
            window.open(url, "_blank", "width=1000,height=800");
        });
    </script>
@endsection
