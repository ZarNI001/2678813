<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    <title>Register - Chirper</title>
</head>
<body>
    <h2>Chirper Registration</h2>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="/register">
        @csrf

        <p>Name</p>
        <input type="text" name="name"
               value="{{ old('name') }}" required>

        <p>Email</p>
        <input type="email" name="email"
               value="{{ old('email') }}" required>

        <p>Password</p>
        <input type="password" name="password" required>

        <p>Confirm Password</p>
        <input type="password"
               name="password_confirmation" required>

        <br><br>
        <button type="submit">Register</button>
    </form>

    <p>
        Already registered?
        <a href="/login">Login</a>
    </p>
</body>
</html>
