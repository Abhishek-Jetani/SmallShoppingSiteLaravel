@extends('layouts.admin_layout')
@section('title')
    Customers
@endsection
@section('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-selection__rendered {
            line-height: 38px !important;
        }

        .select2-container .select2-selection--single {
            height: 38px !important;
            width: 130px;
        }

        .select2-selection__arrow {
            height: 34px !important;
            right: -7px !important;
        }

        .select2-dropdown {
            width: 130px !important;
        }
    </style>
@endsection
@section('content')
    <div class="mt-4">

        {{-- <h2 class="float-start">Manage Customers</h2>
        <a href="{{ route('admin.trashedUser') }}" class="btn float-end" style="background: #d12525; color:white;"> <i
                class="fa fa-trash"></i> Go to Trash
        </a>
    </div><br><br> --}}



        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <h2>Manage Customers</h2>
            </div>
            <div class="p-2 bd-highlight">
                <select id='statusactive'>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('admin.trashedUser') }}" class="btn" style="background: #d12525; color:white;"> <i
                        class="fa fa-trash"></i> Go to Trash
                </a>
            </div>
        </div>




        <section class="main">
            <div class="container" style="background: white;">
                <div class="pt-3 pb-2">
                    <table id="customer_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- ajax will call here  --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $('#statusactive').select2({
            minimumResultsForSearch: -1
        });
        $(document).ready(function() {
            var dataTable = $('#customer_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{{ route('users.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.status = $('#statusactive').val();
                    },
                },
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('#statusactive').change(function() {
                dataTable.draw();
            });

        });
    </script>
@endsection
