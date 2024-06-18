<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Product creation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
</head>

<body>

    <div class="container">

        <form action="{{ route('products.store') }}" method="POST" id="productform">
            @csrf
            <h1 class="text-center">Product creation</h1>

            <div class="row mb-3">
                <label for="group_id" class="col-sm-2 col-form-label">Club ID</label>
                <div class="col-sm-10">
                    <select class="form-control" name="club_id">
                        @foreach ($clubs as $club)
                            <option value="{{ $club->id }}" name="club_id" id="club_id">{{ $club->club_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Product Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="product_title" id="product_title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Type</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="type" id="type">

                </div>
            </div>

            <div class="col-12 text-center">
                <button class="btn btn-primary btn-lg" type="submit">Submit</button>
            </div>
        </form>
    </div>

    <style>
        .error {
            color: red;
        }
    </style>
    <script>
        $(document).ready(function() {
            $('#productform').validate({
                rules: {
                    club_id: {
                        required: true,
                        number: true,
                    },

                    title: {
                        required: true,
                        maxlength: 255,
                    },

                    product_title: {
                        maxlength: 255,
                    },

                    type: {
                        required: true,
                        maxlength: 100,
                    },
                },
                messages: {
                    club_id: {
                        required: 'Please enter Club ID.',
                        number: 'enter only number',
                    },

                    title: {
                        required: 'Please enter Title.',
                    },

                    type: {
                        required: 'Please enter Type.',
                    },
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ route('products.store') }}",
                type:"POST",
                data:$('#productform').serialize(),


                $('#postForm').trigger("reset");
                $('#btn-save').html('Save Changes');
            })
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
