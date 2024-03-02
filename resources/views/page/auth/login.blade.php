<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .login-form {
            width: 300px;
            margin: 100px auto;
            padding: 30px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 20px 0px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <div class="login-form">
        <h2 class="text-center mb-4">Login</h2>
        <form action="{{ route('login-process') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="Username" required="required">
            </div>
            @error('username')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <input type="password" class="form-control" name="password" xplaceholder="Password" required="required">
            </div>
            @error('username')
                <small>{{ $message }}</small>
            @enderror
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <div class="clearfix">
                <label class="float-left form-check-label"><input type="checkbox"> Remember me</label>
                <a href="#" class="float-right">Forgot Password?</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
