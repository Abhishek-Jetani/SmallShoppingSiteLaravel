@extends('layouts.admin_layout')

@section('title', 'Category')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
        from {opacity:0;}
        to {opacity:1;}
    }

    .card-custom {
        border-radius: 18px;
        border: none;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    table thead {
        background: #f8f9fa;
        font-weight: 600;
    }

    table tbody tr:hover {
        background: #f1f5ff;
        transition: 0.2s;
    }

    .select2-container .select2-selection--single {
        height: 38px !important;
        border-radius: 8px;
    }

    .btn-main {
        background: #0055b0;
        color: white;
        border-radius: 10px;
        padding: 8px 18px;
    }

    .table-image {
        border-radius: 8px;
        object-fit: cover;
        width: 48px;
        height: 48px;
        border: 1px solid #eee;
    }
</style>
@endsection

@section('content')
<div class="mt-4 fade-in">

    <!-- PAGE HEADER -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold m-0">📁 Categories</h2>

        <div class="d-flex gap-3 align-items-center">
            <!-- Status Filter -->
            <select id="statusactive" class="form-select" style="min-width: 160px;">
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="0">Deactive</option>
            </select>

            <!-- Add New -->
            <a href="{{ route('category.create') }}" class="btn btn-main shadow-sm">
                <i class="fa fa-plus"></i> Add Category
            </a>
        </div>
    </div>

    <!-- CONTENT CARD -->
    <div class="card card-custom p-4">
        <table class="table table-hover table-borderless align-middle" id="emp_table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

</div>
@endsection

@section('scripts')

@if(session()->has('warning'))
<script>
    Swal.fire({
        title: 'Warning!',
        text: '{{ session('warning') }}',
        icon: 'warning',
        showConfirmButton: false,
    });
</script>
@endif


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

<script>
$(document).ready(function() {

    // Select2
    $('#statusactive').select2({
        minimumResultsForSearch: -1 
    });

    // DATATABLE
    var dataTable = $('#emp_table').DataTable({
        stateSave: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('category.index') }}",
            type: 'GET',
            data: function(d) {
                d._token = '{{ csrf_token() }}';
                d.status = $('#statusactive').val();
            }
        },
        columns: [
            { data: "title" },
            { data: "description" },
            {
                data: 'image',
                orderable: false,
                searchable: false,
                render: function(data){
                    if (!data || data === '') {
                        return `<img src="https://via.placeholder.com/60?text=No+Img" class="table-image">`;
                    }
                    return `<img src="${data}" class="table-image" onerror="this.onerror=null;this.src='{{ asset('images/no_image.png') }}';">`;
                }
            },
            { data: 'status', orderable: false },
            { data: 'action', orderable: false, searchable: false, className: "text-center" }
        ],
    });

    $('#statusactive').change(function(){
        dataTable.draw();
    });

    // DELETE CONFIRMATION
    $(document).on('click', '.delete-btn', function(e){
        e.preventDefault();
        var id = $(this).data('id');

        Swal.fire({
            title: 'Are you sure?',
            text: "This action cannot be undone!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
        }).then((result)=>{
            if(result.isConfirmed){
                $('#delete-form-' + id).submit();
            }
        });
    });

});
</script>

@endsection
