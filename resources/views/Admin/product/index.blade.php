@extends('layouts.admin_layout')
@section('title')
    Products
@endsection
@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

<style>
    /* Apple-like clean card */
    .apple-card {
        background: #ffffff;
        border: 1px solid #e5e5e5;
        border-radius: 16px;
        padding: 24px;
        box-shadow: 0 6px 22px rgba(0,0,0,0.05);
        transition: .3s ease;
    }
    .apple-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    h2 {
        font-weight: 600;
        letter-spacing: -.5px;
    }

    /* Buttons */
    .btn-main {
        background: #0074ff;
        color: #fff;
        border-radius: 10px;
        padding: 7px 14px;
        transition: .2s ease;
    }
    .btn-main:hover {
        background: #0059c4;
        color: #fff;
    }

    .btn-outline {
        border: 1px solid #0074ff;
        color: #0074ff;
        border-radius: 10px;
        padding: 7px 14px;
        transition: .2s ease;
    }
    .btn-outline:hover {
        background: #0074ff;
        color: #fff;
    }

    .table thead {
        background: #fafafa;
        font-weight: 600;
    }

    /* Table hover subtle */
    #product_table tbody tr:hover {
        background: #f7faff;
        transition: .2s;
    }

    /* Image clean style */
    .product-img {
        width: 55px;
        height: 55px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
    }

    /* Filters */
    #categoryFilter, #status {
        width: 230px;
        border-radius: 8px;
    }

    #selectedDeleteBtn {
        display: none;
    }
</style>
@endsection


@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products</h2>

        <div class="d-flex gap-2">
            <button id="selectedDeleteBtn" class="btn btn-danger">
                <i class="fa fa-trash"></i> Delete
            </button>

            <button class="btn btn-outline" id="selectedexcelBtn">
                <i class="fa fa-download"></i> Export Excel
            </button>

            <button type="button" class="btn btn-outline" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fa fa-upload"></i> Import Excel
            </button>

            <a href="{{ route('product.create') }}" class="btn btn-main">
                <i class="fa fa-plus"></i> Add Product
            </a>
        </div>
    </div>


    <div class="apple-card mb-3">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="fw-semibold d-block">Select Category</label>
                <select id="categoryFilter" class="form-select">
                    <option value="all">All Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label class="fw-semibold d-block">Status</label>
                <select id="status" class="form-select">
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

            <section class="main mt-3">
                <div class="apple-card">
                    <table class="table table-hover" id="product_table">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="selectAll" /></th>
                                <th>Product Name</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="product_body">
                            {{-- DataTables loads rows here --}}
                        </tbody>
                    </table>
                </div>
            </section>


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
