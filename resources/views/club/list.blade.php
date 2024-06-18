<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .error {
            color: red;
        }
    </style>

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
            <h1>Club List</h1>

            <button type="button" class="btn btn-primary btn-lg" id="addNewClub">
                Add new Club
            </button>
            <br><br>
            <table class="table table-striped table-hover table-bordered text-center">
                <thead class="table-light">
                    <tr>
                        <th>Group ID</th>
                        <th>Business Name</th>
                        <th>Club Number</th>
                        <th>Club Name</th>
                        <th>Club State</th>
                        <th>Club Description</th>
                        <th>Club Slug</th>
                        <th>Website Title</th>
                        <th>Website Link</th>
                        <th>Club Logo</th>
                        <th>Club Banner</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                </tbody>
            </table>
        </center>
    </div>

    <div class="modal fade" tabindex="-1" aria-labelledby="product_modal" aria-hidden="true" id="club_modal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="clubModalTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" id="club_form">
                        @csrf
                        <div class="alert alert-danger" id="error_msg" style="display:none">
                            <ul></ul>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="id" id="id" value=""
                                    readonly>
                                <input type="hidden" class="form-control" name="_method" id="method" value="POST">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="group_id" class="col-sm-2 col-form-label">Group ID</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="group_id" name="group_id">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="business_name" class="col-sm-2 col-form-label">Business Name</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="business_name" id="business_name">
                            </div>
                            <label for="club_number" class="col-sm-2 col-form-label">Club Number</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="club_number" id="club_number">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="club_name" class="col-sm-2 col-form-label">Club Name</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="club_name" id="club_name">

                            </div>
                            <label for="club_state" class="col-sm-2 col-form-label">Club State</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="club_state" id="club_state">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="club_description" class="col-sm-2 col-form-label">Club Description</label>
                            <div class="col-sm-10">
                                <textarea name="club_description" class="form-control" id="club_description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="club_slug" class="col-sm-2 col-form-label">Club Slug</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="club_slug" id="club_slug">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="website_title" class="col-sm-2 col-form-label">Website Title</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="website_title" id="website_title">
                            </div>
                            <label for="website_link" class="col-sm-2 col-form-label">Website Link</label>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="website_link" id="website_link">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="club_logo" class="col-sm-2 col-form-label">Club Logo</label>
                            <div class="col-sm">
                                <input type="file" class="form-control" name="club_logo" id="club_logo">
                            </div>
                            <label for="club_banner" class="col-sm-2 col-form-label">Club Banner</label>
                            <div class="col-sm">
                                <input type="file" class="form-control" name="club_banner" id="club_banner">
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button class="btn btn-primary btn-lg" type="submit">Submit</button>
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
                url: "/clubs_fetchdata",
                type: "GET",
                datatype: "json",
                success: function(data) {
                    $('tbody').html("");
                    if (data.length == 0) {
                        $('tbody').append('<tr><td colspan="12">No Data Found</td></tr>')
                    } else {
                        $.each(data, function(key, item) {
                            $('tbody').append('<tr>\
                                                <td>' + item.group_id + '</td>\
                                                <td>' + item.business_name + '</td>\
                                                <td>' + item.club_number + '</td>\
                                                 <td>' + item.club_name + '</td>\
                                                 <td>' + item.club_state + '</td>\
                                                 <td>' + item.club_description + '</td>\
                                                 <td>' + item.club_slug + '</td>\
                                                 <td>' + item.website_title + '</td>\
                                                 <td>' + item.website_link + '</td>\
                                                 <td><img src="/upload/logos/' + item.club_logo + '" alt="' + item
                                .club_logo + '" class="w-75"></td>\
                                                 <td><img src="/upload/banners/' + item.club_banner + '" alt="' + item
                                .club_banner + '" class="w-75"></td>\
                                                <td><button type="button" value="' + item.id + '" class="btn btn-primary editbtn btn-sm" id="editClub">Edit</button></td>\
                                                <td><button type="button" value="' + item.id + '" class="btn btn-danger deletebtn btn-sm" id="deleteClub">Delete</button></td>\
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

            $('#addNewClub').on('click', function() {
                $('#club_form').trigger('reset');
                $('#id').val('');
                $('#method').val('POST');
                $('#clubModalTitle').html("Add Club");
                $('#club_modal').modal('show');
                $('#club_form').find("#error_msg").css('display', 'none');
            });

            $('body').on('click', '#editClub', function() {
                $('#club_form').trigger('reset');
                var id = $(this).val();

                $.get('clubs/' + id + '/edit', function(data) {

                    $('#clubModalTitle').html("Edit Club");
                    $('#method').val('PUT');
                    $('#id').val(data.id)
                    $('#group_id').val(data.group_id)
                    $('#business_name').val(data.business_name);
                    $('#club_number').val(data.club_number);
                    $('#club_name').val(data.club_name);
                    $('#club_state').val(data.club_state);
                    $('#club_description').val(data.club_description);
                    $('#club_slug').val(data.club_slug)
                    $('#website_title').val(data.website_title);
                    $('#website_link').val(data.website_link);
                    $('#club_form').find("#error_msg").css('display', 'none');
                    $('#club_modal').modal('show');
                })
            });

            $('body').on('click', '#deleteClub', function() {

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
                            url: "{{ url('clubs') }}" + '/' + id,
                            success: function(data) {
                                fetchdata();
                                $("#id" + id).remove();
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

            $('#club_form').submit(function(e) {
                e.preventDefault();
                var club_id = $('#id').val();
                var url = club_id ? '/clubs/' + club_id : '/clubs';

                $.ajax({
                    url: url,
                    data: new FormData(this),
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: (response) => {
                        fetchdata();
                        $('#club_modal').modal('hide');
                        var message = club_id ? "Club Edited" : "Club Added";
                        swal.fire({
                            icon: "success",
                            title: "success",
                            text: message,

                        });
                    },
                    error: function(response) {
                        $('#club_form').find("#error_msg").find("ul").html('');
                        $('#club_form').find("#error_msg").css('display', 'block');
                        $.each(response.responseJSON.errors, function(key, value) {
                            $('#club_form').find("#error_msg").find("ul")
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
