<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div class="container-fluid me-5">
        <center>
            <h1>Product List</h1>

            <button type="button" class="btn btn-primary btn-lg" id="addNewProduct">
                Add new Product
            </button>
            <br><br>

            <table class="table table-striped table-hover table-bordered text-center">
                <thead class="table-light">
                    <tr id="product_list">
                        <th>ID</th>
                        <th>Club ID</th>
                        <th>Title</th>
                        <th>Product Title</th>
                        <th>Type</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" tabindex="-1" aria-labelledby="product_modal" aria-hidden="true" id="product_modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="product_form">
                        @csrf
                        <div class="alert alert-danger" id="error_msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="id" id="id" value="">
                                <input type="hidden" class="form-control" name="_method" id="method" value="POST">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="club_id" class="col-sm-2 col-form-label">Club Name</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="club_id" name="club_id">
                                    @foreach ($clubs as $club)
                                        <option value="{{ $club->id }}" name="club_id">
                                            {{ $club->club_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_title" class="col-sm-2 col-form-label">Product Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="product_title" id="product_title"
                                    value="">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="type" class="col-sm-2 col-form-label">Type</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="type" id="type" value="">

                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary btn-lg" value="">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script>
        function fetchdata() {

            $.ajax({
                url: "/products_fetchdata",
                type: "GET",
                datatype: "json",
                success: function(data) {
                    $('tbody').html("");
                    if (data.length == 0) {
                        $('tbody').append('<tr><td colspan="12">No Data Found</td></tr>')
                    } else {
                        $.each(data, function(key, item) {
                            $('tbody').append('<tr>\
                                        <td>' + item.id + '</td> \
                                        <td>' + item.club_id + '</td>\
                                        <td>' + item.title + '</td>\
                                        <td>' + item.product_title + '</td>\
                                         <td>' + item.type + '</td>\
                                        <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm" id="editProduct">Edit</button></td>\
                                        <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm" id="deleteProduct">Delete</button></td>\
                                        \</tr>');
                        });
                    }
                }
            })
        }

        $(document).ready(function() {

            fetchdata();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#addNewProduct').on('click', function() {
                $('#product_form').trigger('reset');
                $('#productModalTitle').html("Add Product");
                $('#product_modal').modal('show');
                $('#product_form').find("#error_msg").css('display', 'none');
            });

            $('body').on('click', '#editProduct', function() {
                var id = $(this).val();
                console.log(id);
                $.get('products/' + id + '/edit', function(data) {

                    $('#productModalTitle').html("Edit Product");
                    $('#method').val('PUT');
                    $('#id').val(data.id);
                    $('#club_id').val(data.club_id);
                    $('#title').val(data.title);
                    $('#product_title').val(data.product_title);
                    $('#type').val(data.type);
                    $('#product_form').find("#error_msg").css('display', 'none');
                    $('#product_modal').modal('show');
                })
            });

            $('body').on('click', '#deleteProduct', function() {

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        var id = $(this).val();

                        $.ajax({
                            type: "DELETE",
                            url: "{{ url('products') }}" + '/' + id,
                            success: function(data) {
                                $("#id" + id).remove();
                                fetchdata();
                            },
                            error: function(data) {
                                console.log('Error:', data);
                            }
                        });
                        Swal.fire({
                            title: "Deleted!",
                            text: "Club has been deleted.",
                            icon: "success"
                        });
                    }
                });
            })

            $('#product_form').on("submit", function(e) {
                e.preventDefault();
                var product_id = $('#id').val();
                var url = product_id ? '/products/' + product_id : '/products';
                console.log(product_id);
                console.log(url);
                $.ajax({
                    url: url,
                    data: $('#product_form').serialize(),
                    type: "POST",
                    success: (response) => {
                        $('#product_modal').modal('hide');
                        fetchdata();
                        var message = product_id ? "Product Edited" : "Product Added";
                        swal.fire({
                            icon: "success",
                            title: "success",
                            text: message,

                        });
                    },
                    error: function(response) {
                        $('#product_form').find("#error_msg").find("ul").html('');
                        $('#product_form').find("#error_msg").css('display', 'block');
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#product_form').find("#error_msg").find("ul")
                                .append(
                                    '<li>' + value + '</li>');

                        });
                    }
                });
            });

        });
    </script>
</body>

</html>
