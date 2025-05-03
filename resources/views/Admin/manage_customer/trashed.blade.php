@extends('layouts.admin_layout')
@section('title')
    Deleted Cusotmers
@endsection
@section('styles')
@endsection
@section('content')
    <div class="mb-4">
        <h2 class="float-start">Manage deleted customer</h2>
        <a href="{{ route('admin.manageCustomer.index') }}" class="btn float-end btn-danger"> Back to user
        </a>
    </div><br><br>

    <section class="main">
        <div class="container" style="background: white;">
            <div class="pt-3 pb-2">
                <table id="trashed_user_table" class="table table-bordered table-striped mt-1">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- ajax call here   --}}
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#trashed_user_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{{ route('admin.trashedUser') }}',
                    type: 'GET',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                         
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
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
@endsection
