<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('css/login.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    <main>
      <a id="logo" href="/">
        <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
      </a>
      <div id="loginPanel">
        <h1>Login Page</h1>
        <h2>Login with your admin or blogger credentials</h2>
        <form action="/login" method="POST">
          @csrf
          <input type="email" id="email" name="email" placeholder="Enter your e-mail" @if (old()) value="{{ old('email') }}"@endif>
          <input type="password" id="password" name="password" placeholder="Enter your password">
          <input type="submit" id="submit" value="Login">
        </form>
        <a href="/create_account">Create Account</a>
        @if (session()->has('error'))
          <div class="errornotif">
            <img id="error" src="{{ asset('images/erroricon.png') }}" alt="Error">
            <p>{{ session('error') }}</p>
            <img id="close" src="{{ asset('images/crossicon.png') }}" alt="Close">
          </div>
          @php
            session()->forget('error');
          @endphp
        @endif
      </div>
    </main>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
  </body>
</html>
