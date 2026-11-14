<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Login - Chirper</title>
</head>
<body>
    <h2>Chirper Login</h2>

    @if ($errors->any())
        <p style="color:red;">
            {{ $errors->first() }}
        </p>
    @endif

    <form method="POST" action="/login">
        @csrf

        <p>Email</p>
        <input type="email" name="email"
               value="{{ old('email') }}" required>

        <p>Password</p>
        <input type="password" name="password" required>

        <br><br>
        <button type="submit">Login</button>
    </form>

    <p>
        Don't have an account?
        <a href="/register">Register</a>
    </p>
</body>
</html>
