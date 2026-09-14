<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Masuk · GrowPath</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="login-page">
    <section class="login-box">
        <div class="brand">
            <img src="{{ asset('images/grownexia-logo.png') }}?v={{ filemtime(public_path('images/grownexia-logo.png')) }}" alt="Grownexia">
        </div>
        <h1>Selamat datang</h1>
        <p>Employee Individual Development Platform</p>
        @if ($errors->any())
            <div class="notice error">{{ $errors->first() }}</div>
        @endif
        <form method="POST" action="{{ route('login.store') }}">
            @csrf<label class="field">Email<input name="email" type="email"
                    value="{{ old('email', 'aliyah@growpath.test') }}">
            </label>
            <label class="field">Password<input name="password" type="password" value="password">
            </label>
            <label style="font-size:12px">
                <input type="checkbox" name="remember"> Ingat saya</label>
            <button class="btn">Masuk</button>
        </form>
    </section>
</body>

</html>
