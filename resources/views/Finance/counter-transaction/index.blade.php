@extends('layout.app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h3>Counter Transactions</h3>
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#new">Create
                        New</button>
                </div>
                <div class="card-body">
                    <table class="table" id="buttons-datatables">
                        <thead>
                            <th>#</th>
                            <th>Ref #</th>
                            <th>User</th>
                            <th>Account</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </thead>
                        <tbody>
                            @foreach ($trans as $key => $tran)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $tran->refID }}</td>
                                    <td>{{ $tran->user->name }}</td>
                                    <td>{{ $tran->account->title }}</td>
                                    <td>{{ date('d M Y h:i A', strtotime($tran->created_at)) }}</td>
                                    <td><span
                                            class="badge {{ $tran->type == 'Withdraw' ? 'bg-warning' : 'bg-info' }}">{{ $tran->type }}</span>
                                    </td>
                                    <td>{{ number_format($tran->amount) }}</td>
                                    <td>
                                        <a href="{{ route('counter_transaction.delete', $tran->refID) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Default Modals -->

    <div id="new" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
        style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Create Counter Transaction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <form action="{{ route('counter_transaction.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input type="number" step="any" name="amount" required id="amount"
                                class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="type">Type</label>
                            <select name="type" id="type" class="form-control">
                                <option value="Take">Take</option>
                                <option value="Give">Give</option>
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="from">Account</label>
                            <select name="accountID" id="from" required class="selectize">
                                <option value=""></option>
                                @foreach ($accounts as $account)
                                    <option value="{{ $account->id }}">{{ $account->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="userID">Counter</label>
                            <select name="userID" id="userID" required class="selectize">
                                <option value=""></option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mt-2">
                            <label for="date">Date</label>
                            <input type="date" name="date" required id="date" value="{{ date('Y-m-d') }}"
                                class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection
@section('page-css')
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/datatable.bootstrap5.min.css') }}" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/responsive.bootstrap.min.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/libs/datatable/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/selectize/selectize.min.css') }}">
@endsection

@section('page-js')
    <script src="{{ asset('assets/libs/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatable/jszip.min.js') }}"></script>

    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>

    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>
    <script>
        $(".selectize").selectize();
    </script>
@endsection
