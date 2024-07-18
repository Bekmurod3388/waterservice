<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
    </div>
    <div class="form-container sign-in-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <h1>Log In</h1>
            <input type="number" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit">Login</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Login!</h1>
                <p>Click the login button to log in</p>
                <button class="ghost" id="signIn">Login</button>
            </div>
            <div class="login_image">
                <img src="{{asset("assets/Images/login-image.jpg")}}" alt="img">
            </div>
        </div>
    </div>
</div>

<script src="assets/script.js"></script>

</body>
</html>
