<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body>
    <p>Hi {{ $user->name }},</p>
    <p>Anda menerima email ini karena kami menerima permintaan pengaturan ulang kata sandi untuk akun Anda.</p>
    <p>Silakan klik tautan di bawah ini untuk mengatur ulang kata sandi Anda:</p>
    <a href="{{ $link }}">{{ $link }}</a>
    <p>Tautan ini hanya berlaku selama 24 jam dan hanya dapat digunakan satu kali.</p>
    <p>Jika Anda tidak meminta pengaturan ulang kata sandi, Anda dapat mengabaikan email ini dengan aman.</p>
    <p>Terima kasih,</p>
    <p>Tim Support</p>
</body>

</html>