<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Enter Your Address</h5>
            </div>
            <div class="modal-body">
                <form id="address_form" action="{{ route('order.place') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="address_line_1">Address Line 1</label>
                        <input type="text" name="address_line_1" class="form-control" required>
                        @error('address_line_1')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="address_line_2">Address Line 2 <small>(Optional)</small></label>
                        <input type="text" name="address_line_2" class="form-control">
                        @error('address_line_2')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="state">State</label>
                        <select class="form-select" name="state" required>
                            <option selected disabled>Select State</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                        @error('state')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="city">City</label>
                        <select class="form-select" name="city" required>
                            <option selected disabled>Select City</option>
                        </select>
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="pincode">Pincode</label>
                        <input type="text" name="pincode" class="form-control" required>
                        @error('pincode')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="mobile_no">Mobile Number</label>
                        <input type="number" name="mobile_no" class="form-control" maxlength="10" minlength="10"
                            required>
                        @error('mobile_no')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="submit-address-form">Place Order</button>
            </div>
        </div>
    </div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script>
    $().ready(function() {

        $("#address_form").validate({
            rules: {
                address_line_1: {
                    required: true,
                    minlength: 5,
                },
                state: {
                    required: true,
                },
                city: {
                    required: true,
                },
                pincode: {
                    required: true,
                },
                mobile_no: {
                    required: true,
                    minlength: 10,
                    maxlength: 10,
                }
            },
            messages: {
                address_line_1: {
                    required: "Address field is required",
                    minlength: "Enter at least 5 letter",
                },
                state: {
                    required: "State field is required",
                },
                city: {
                    required: "City field is required",
                },
                pincode: {
                    required: "Pincode field is required",
                },
                mobile_no: {
                    required: "Mobile number field is required",
                    minlength: "Enter 10 digit mobile number",
                    maxlength: "Enter 10 digit mobile number",
                },
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });
</script>
{{-- city by state  --}}
<script>
    $(document).ready(function() {
        // Load states
        $.get('/states', function(data) {
            var stateSelect = $('select[name="state"]');
            stateSelect.empty();
            stateSelect.append('<option selected disabled>Select State</option>');
            data.forEach(function(state) {
                stateSelect.append('<option value="' + state.id + '">' + state.name +
                    '</option>');
            });
        });

        $('select[name="state"]').change(function() {
            var stateId = $(this).val();
            var citySelect = $('select[name="city"]');
            citySelect.empty();
            citySelect.append('<option selected disabled>Select City</option>');
            $.get('/cities', {
                state_id: stateId
            }, function(data) {
                data.forEach(function(city) {
                    citySelect.append('<option value="' + city.id + '">' + city.name +
                        '</option>');
                });
            });
        });
    });
</script>









$("#place-order-button").click(function(event) {
event.preventDefault();
$("#addressModal").modal("show");
});

$("#submit-address-form").click(function() {
$("#address_form").submit();
});

function clearErrors() {
$(".text-danger").remove();
$(".form-control").removeClass("is-invalid");
}

$(document).off("submit", "#address_form").on("submit", "#address_form", function(event) {
event.preventDefault();
clearErrors();

var formData = $(this).serialize();

$.ajaxSetup({
headers: {
'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

$.ajax({
type: "POST",
url: "{{ route('order.place') }}",
data: formData,
success: function(response) {
if (response.success) {
Swal.fire({
title: "Order Placed!",
text: "Your order has been placed successfully.",
icon: "success",
showConfirmButton: false,
timer: 1000
}).then(() => {
window.location.href =
                                    "{{ route('order.getUserOrders') }}";
});
}
},
error: function(xhr) {
console.log(xhr);
if (xhr.status === 422) {
var errors = xhr.responseJSON.errors;

for (var field in errors) {
var input = $('[name="' + field + '"]');
input.addClass("is-invalid");
input.after('<div class="text-danger">' + errors[field][0] +
    '</div>');
}
} else {
console.log(xhr.responseJSON);
Swal.fire({
title: "Error",
text: xhr.responseJSON.message + (xhr.responseJSON
.error ? ': ' + xhr.responseJSON.error : ''),
icon: "error",
showConfirmButton: true
});
}
}
});
});
