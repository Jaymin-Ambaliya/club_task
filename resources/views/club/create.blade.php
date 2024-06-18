<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <title>Club creation</title>
</head>

<body>

    <div class="container">

        <form action="{{ route('clubs.store') }}" method="POST" id="clubform">
            @csrf
            <h1 class="text-center">Club creation</h1>

            <div class="row mb-3">
                <label for="group_id" class="col-sm-2 col-form-label">Group ID</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="group_id" name="group_id">
                </div>
            </div>
            <div class="row mb-3">
                <label for="business_name" class="col-sm-2 col-form-label">Business Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="business_name" id="business_name">
                </div>
            </div>
            <div class="row mb-3">
                <label for="club_number" class="col-sm-2 col-form-label">Club Number</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="club_number" id="club_number">
                </div>
            </div>
            <div class="row mb-3">
                <label for="club_name" class="col-sm-2 col-form-label">Club Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="club_name" id="club_name">

                </div>
            </div>
            <div class="row mb-3">
                <label for="club_state" class="col-sm-2 col-form-label">Club State</label>
                <div class="col-sm-10">
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
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="website_title" id="website_title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="website_link" class="col-sm-2 col-form-label">Website Link</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="website_link" id="website_link">
                </div>
            </div>
            <div class="row mb-3">
                <label for="club_logo" class="col-sm-2 col-form-label">Club Logo</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="club_logo" id="club_logo">
                </div>
            </div>
            <div class="row mb-3">
                <label for="club_banner" class="col-sm-2 col-form-label">Club Banner</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" name="club_banner" id="club_banner">
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
            $('#clubform').validate({
                rules: {
                    group_id: {
                        required: true,
                    },

                    business_name: {
                        required: true,
                        maxlength: 150,
                    },

                    club_number: {
                        required: true,
                        maxlength: 30,
                    },

                    club_name: {
                        required: true,
                        maxlength: 200,
                    },

                    club_state: {
                        required: true,
                        maxlength: 50,
                    },

                    club_description: {
                        required: true,
                    },

                    club_slug: {
                        required: true,
                        maxlength: 200,
                    },

                    website_title: {
                        required: true,
                        maxlength: 255,
                    },

                    website_link: {
                        required: true,
                        maxlength: 100,
                        url: true,
                    },

                    club_logo: {
                        required: true,
                        maxlength: 65,
                        extension: "jpg|jpeg|png|ico",
                    },

                    club_banner: {
                        required: true,
                        maxlength: 65,
                        extension: "jpg|jpeg|png",
                    },
                },
                messages: {
                    group_id: {
                        required: 'Please enter Group ID.',
                    },

                    business_name: {
                        required: 'Please enter Business Name.',
                    },

                    club_number: {
                        required: 'Please enter Club Number.',
                    },

                    club_name: {
                        required: 'Please enter Club Name.',
                    },

                    club_state: {
                        required: 'Please enter Club State.',
                    },

                    club_description: {
                        required: 'Please enter Club Description.',
                    },

                    club_slug: {
                        required: 'Please enter Club Slug.',
                    },

                    website_title: {
                        required: 'Please enter Website Title.',
                    },

                    website_link: {
                        required: 'Please enter Website Link.',
                    },

                    club_logo: {
                        required: 'Please enter Club Logo.',
                        extension: "Please upload file in these format only (jpg, jpeg, png, ico)."
                    },

                    club_banner: {
                        required: 'Please enter Club Banner.',
                        extension: "Please upload file in these format only (jpg, jpeg, png)."
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
