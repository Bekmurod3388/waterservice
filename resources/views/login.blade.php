<html>
<head>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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
        <form action="{{route('login')}}" method="POST">
            @csrf
            <h1>Log In</h1>
            <input type="text" name="username" placeholder="Username"/>
            <input type="password" name="password" placeholder="Password"/>
            <button>Login</button>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Login!</h1>
                <p>Click the login button to log in</p>
                <button class="ghost" id="signIn">Login</button>
            </div>

        </div>
    </div>
</div>

<script src="assets/script.js"></script>


</body>
</html>
