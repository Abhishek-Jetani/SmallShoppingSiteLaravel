@extends('layouts.admin_layout')
@section('title')
    Products
@endsection
@section('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <style>
        #selectedDeleteBtn {
            display: none;
        }

        #product_table td {
            text-align: left;
        }

        .export_btn,
        .import_btn {
            border: 1px solid #0055b0;
        }

        .export_btn:hover,
        .import_btn:hover {
            background-color: #0055b0;
            color: #ffffff;
        }

        #categoryFilter, #status {
            width: 200px;
        }
    </style>
@endsection

@section('content')
    <div class="mb-4">
        <h2 class="float-start">Products</h2>
        <a href="{{ route('product.create') }}" class="float-end btn ms-1" style="background: #0055b0; color:white;">
            <i class="fa fa-plus"></i> Add Product</a>
        <button type="button" class="float-end btn import_btn ms-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-upload"></i> Import Excel</button>
        <button class="float-end btn ms-1 export_btn" id="selectedexcelBtn"><i class="fa fa-download"></i> Export
            Excel</button>
        <button id="selectedDeleteBtn" class="float-end btn btn-danger "><i class="fa fa-trash"></i>
            Delete</button>
    </div><br><br>

    <div class="p-3 row ms-1 me-1" style="background: white; border-radius:5px;">
        <div class="d-flex bd-highlight ">
            <div class="me-auto p-2 bd-highlight">
                <label for="floatingInputGrid" class="d-block">Select Categories</label>
                <select id="categoryFilter" class="d-inline">
                    <option value="all">All Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="p-2 bd-highlight">
                <label for="floatingInputGrid" class="d-block">Status</label>
                <select id='status' class="form-control d-inline">
                    <option value="">Select Status</option>
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                </select>
            </div>
        </div>
    </div>



    <section class="main mt-3">
        <div class="container" style="background: white;">

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Import Excel Data</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="ajax-form" enctype="multipart/form-data">
                            <div class="modal-body">
                                @csrf
                                <label for="file-input" class="form-label">Upload Excel File</label>
                                <input type="file" id="file-input" name="file" class="form-control" required>
                                <div id="file-error" class="text-danger mt-2" style="display:none;"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary impor_btn" disabled>Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="pt-2 pb-2">
                <table class="table table-striped table-bordered" id="product_table" class="display">
                    <thead class="thead-dark">
                        <tr>
                            <th style="text-align: left;">
                                <input type="checkbox" id="selectAll" name="inputall" />
                            </th>
                            <th style="text-align: left;">Product Name</th>
                            <th style="text-align: left;">Image</th>
                            <th style="text-align: left;">Category Name</th>
                            <th style="text-align: left;">Status</th>
                            <th style="text-align: left;">Price</th>
                            <th style="text-align: left;">Quantity</th>
                            <th style="text-align: left;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="product_body">
                        {{-- ajax will be display here  --}}
                    </tbody>
                </table>
            </div>

        </div>
    </section>
@endsection


@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    @if (session()->has('afterimportmessage'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif


    <script>
        $('#categoryFilter').select2();
        $('#status').select2({
            minimumResultsForSearch: -1
        });
        $(document).ready(function() {

            $('#file-input').on('change', function() {
                if (this.files.length > 0) {
                    $('.impor_btn').prop('disabled', false);
                } else {
                    $('.impor_btn').prop('disabled', true);
                }
            });

            var plain_form_data = $('#ajax-form').html();
            $('#exampleModal').on('hidden.bs.modal', function() {
                $('#ajax-form').html(plain_form_data);
            });


            var dataTable = $('#product_table').DataTable({
                stateSave: true,
                processing: true,
                serverSide: true,
                ajax: {
                    url: '{{ route('product.index') }}',
                    type: 'GET',
                    data: function(d) {
                        d._token = '{{ csrf_token() }}';
                        d.category_id = $('#categoryFilter').val();
                        d.status = $('#status').val()
                    },
                },
                columns: [{
                        data: "checkbox",
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: "title"
                    },
                    {
                        data: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'category_name'
                    },
                    {
                        data: 'status',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'price'
                    },
                    {
                        data: 'quantity'
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                pageLength: 10,
                lengthChange: true,
                paging: true,
                searching: true,
                ordering: true,
                info: true,
            });

            $('#status').change(function() {
                dataTable.draw();
            });

            $('#categoryFilter').change(function() {
                dataTable.draw();
            });


            // check box
            $('#selectAll').on('change', function() {
                var isChecked = $(this).is(':checked');
                $('.productCheckbox').prop('checked', isChecked);
                if (isChecked) {
                    $("#selectedDeleteBtn").show();
                } else {
                    $("#selectedDeleteBtn").hide();
                }
            });

            $(document).on('change', '.productCheckbox', function() {
                var totalCheckboxes = $('.productCheckbox').length;
                var checkedCheckboxes = $('.productCheckbox:checked').length;

                if (checkedCheckboxes > 0) {
                    $("#selectedDeleteBtn").show();
                } else {
                    $("#selectedDeleteBtn").hide();
                }

                if (checkedCheckboxes === totalCheckboxes) {
                    $('#selectAll').prop('checked', true);
                } else {
                    $('#selectAll').prop('checked', false);
                }
            });

            // delete selected products
            $('#selectedDeleteBtn').click(function() {
                var selectedProductIds = [];
                $('.productCheckbox:checked').each(function() {
                    selectedProductIds.push($(this).data('id'));
                });

                if (selectedProductIds.length > 0) {
                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'You will not be able to recover deleted products!',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete!',
                        cancelButtonText: 'No',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: '{{ route('product.deleteMultiple') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    product_ids: selectedProductIds,
                                },
                                success: function(response) {
                                    if (response.success) {
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: 'top-end',
                                            showConfirmButton: false,
                                            timer: 3000,
                                            timerProgressBar: true,
                                            didOpen: (toast) => {
                                                toast.onmouseenter =
                                                    Swal
                                                    .stopTimer;
                                                toast.onmouseleave =
                                                    Swal
                                                    .resumeTimer;
                                            },
                                        });
                                        Toast.fire({
                                            icon: 'success',
                                            title: 'Products deleted',
                                        });
                                        $('#selectedDeleteBtn').hide();
                                        dataTable.draw();

                                    }
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error deleting products:',
                                        error);
                                },
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'No Products Selected',
                        text: 'Please select products to delete.',
                        icon: 'info',
                        timer: 3000,
                    });
                }
            });

            // export excel
            $('#selectedexcelBtn').click(function() {
                var selectedProductIds = [];
                var categoryId = $('#categoryFilter').val();

                $('.productCheckbox:checked').each(function() {
                    selectedProductIds.push($(this).data('id'));
                });

                var requestData = {
                    _token: '{{ csrf_token() }}',
                };

                if (selectedProductIds.length > 0) {
                    requestData['product_ids'] = selectedProductIds;
                } else {
                    requestData['category_id'] = categoryId;
                }


                $.ajax({
                    url: '{{ route('admin.products.export') }}',
                    type: 'POST',
                    data: requestData,
                    success: function(response) {
                        if (response.download_url) {
                            window.location.href = '{{ route('download.excel') }}';
                            $('#product_table').DataTable().ajax.reload();
                        } else {
                            console.error('Download URL not found.');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error exporting products:', error);
                    }
                });


            });

            // import excel
            $('#ajax-form').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '{{ route('users.import') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'Products imported successfully',
                                icon: 'success',
                                showCancelButton: false,
                                showConfirmButton: false,
                            })
                            dataTable.draw();
                            $('#exampleModal').modal('hide');
                        } else {
                            displayErrors(response.errors);
                        }
                    },
                    error: function(xhr) {
                        var errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    }
                });
            });

            function displayErrors(errors) {
                var errorText = '';

                function parseErrors(errors) {
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            if (typeof errors[key] === 'object') {
                                parseErrors(errors[key]);
                            } else {
                                errorText += key + ': ' + errors[key] + '<br>';
                            }
                        }
                    }
                }

                parseErrors(errors);
                $('#file-error').html(errorText).show();
            }



        });
    </script>
@endSection
