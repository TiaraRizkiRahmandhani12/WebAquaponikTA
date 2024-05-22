<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .login-page {
            background-image: url('assets/images/auth/dark.png');
            background-size: cover;
            background-repeat: no-repeat;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .centered-image {
            width: 150px;
            height: 150px;
            display: block;
            margin: 0 auto 20px;
        }

        .login-box {
            width: 400px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.7);
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .input-group.custom {
            margin-top: 30px;
            width: 100%;
        }

        .input-group.custom input.form-control {
            margin-top: 10px;
            width: 100%;
            height: 40px;
            border: 2px solid #FFFFFF;
            border-radius: 5px;
        }

        .input-group.custom input.form-control::placeholder {
            color: #9a9a9a;
        }

        .input-group.custom .input-group-text {
            background-color: #FFFFFF;
            border: 1px solid #FFFFFF;
            border-radius: 20px;
            margin-right: 10px;
        }

        .input-group.custom .input-group-text i {
            color: #000000;
        }

        .custom-control.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
            background-color: #16425C;
            border: 2px solid #16425C;
        }

        .custom-control.custom-checkbox .custom-control-input:not(:checked)~.custom-control-label::before {
            border: 2px solid #16425C;
        }

        .custom-control.custom-checkbox {
            margin-top: 15px;
        }

        .forgot-password a {
            font-size: 14px;
            color: #000000;
        }

        .forgot-password {
            font-size: 10px !important;
            margin-bottom: 40px;
            margin-top: 15px;
        }

        .btn.btn-primary.btn-lg.btn-block {
            background-color: #16425C;
            border: 2px solid #16425C;
        }

        .alert-fixed {
            width: 100%;
            /* Make alert full width of the login box */
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
</head>

<body class="login-page">
    <div class="login-box">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <img src="assets/images/auth/sabi.png" alt="Logo Evomo" class="centered-image">
        <span></span>
        <form action="{{ route('send.link') }}" method="POST">
            @csrf
            <div class="input-group custom">
                <input type="text" class="form-control form-control-lg" placeholder="Email" name="email">
            </div>
            <div class="row">
                <div class="col-sm-12 mt-5">
                    <div class="input-group mb-0">
                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $('.alert').fadeOut('fast');
            }, 3000); // 3000 ms = 3 s
        });
    </script>

</body>

</html>
