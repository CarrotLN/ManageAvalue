<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Red+Hat+Display&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<form method="POST" action="{{ route('login') }}">
    <div class="grid-container">
        <div class="section-login"><img src="../images/logo.svg">
            @csrf
            <div class="login-input">

                <div class="input-name">
                    <label for="login">
                        {{ __('Username :') }}
                    </label>
                    <input id="login" type="text" placeholder="Username"
                           class="section-input{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                           name="login" value="{{ old('username') ?: old('email') }}" required autofocus>
                    @if ($errors->has('username') || $errors->has('email'))
                        <span class="invalid-feedback">
                                        <strong class="thick" >{{ $errors->first('username') ?: $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>

                <div class="input-password">
                    <label for="password">
                        {{ __('Password :') }}
                    </label>
                    <input id="password" type="password" placeholder="Password"
                           class="section-input @error('password') is-invalid @enderror" name="password" required

                           autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
                <div class="login-checkbox">
                    <label class="checkbox-label" for="remember">
                        <input type="checkbox" name="remember"
                               id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="checkbox-custom"></span>
                        <div class="input-title">Remember me</div>
                    </label>

                </div>
                <button  class="button-login">
                    {{ __('Login') }}
                </button>
            </div>
        </div>
    </div>
</form>

</div>
</body>
</html>
