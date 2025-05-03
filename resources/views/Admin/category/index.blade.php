@extends('layouts.admin_layout')
@section('title')
    Category
@endsection
@section('styles')
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

        <div class="d-flex bd-highlight">
            <div class="p-2 flex-grow-1 bd-highlight">
                <h2>Categories</h2>
            </div>
            <div class="p-2 bd-highlight">
                <select id='statusactive'>
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{ route('category.create') }}" class="btn" style="background:#0055b0; color:white;">
                    <i class="fa fa-plus"></i> Add Category</a>
            </div>
        </div>



        <section class="main">
            <div class="container " style="background: white;">
                <div class="pt-2 pb-2">
                    <table class="table table-striped table-bordered" id="emp_table" class="display">
                        <thead class="thead-dark">
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                                <th style="text-align: left;">Image</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 'id', 'title', 'description', 'image', 'status' --}}
                            {{-- @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->title }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td style="text-align: left;">
                                        <img src="{{ asset('storage/images/category/' . $category->image) }}" width="50px"
                                            height="50px" class="rounded" alt="Category Image" />
                                    </td>
                                    <td>
                                        @if ($category->status == 0)
                                            <div class="badge text-bg-danger">Deactivate</div>
                                        @else
                                            <div class="badge text-bg-success">Activate</div>
                                        @endif
                                    </td>
                                    <td>
                                        <a class="btn" href="{{ route('category.show', $category->id) }}"> <i
                                                class="fa fa-eye text-primary"></i></a>

                                        <a class="btn" href="{{ route('category.edit', $category->id) }}"> <i
                                                class="fa fa-pencil text-dark"></i> </a>

                                        <form action="{{ route('category.destroy', $category->id) }}"
                                            id="delete-form-{{ $category->id }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn delete-btn" data-id="{{ $category->id }}"> <i
                                                    class="fa fa-trash" style="color: red;"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach --}}
                        </tbody>
                    </table>

                </div>
            </div>
        </section>


    </div>
@endsection
@section('scripts')
    @if (session()->has('warning'))
        <script>
            Swal.fire({
                title: 'Warning!',
                text: '{{ session('warning') }}',
                icon: 'warning',
                showCancelButton: false,
                showConfirmButton: false,
            })
        </script>
    @endif

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('#statusactive').select2({
            minimumResultsForSearch: -1
        });

        $(document).ready(function() {
            var dataTable = $('#emp_table').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                orderable: true,
                ajax: {
                    url: '{{ route('category.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.status = $('#statusactive').val()
                    },
                },
                columns: [{
                        data: "title",
                    },
                    {
                        data: 'description',
                    },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
            });

            $('#statusactive').change(function() {
                dataTable.draw();
            });

            $('.delete-btn').click(function() {
                var bloodRecipientId = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#delete-form-' + bloodRecipientId).submit();
                    }
                });
                return false;
            });

        });
    </script>
@endsection
