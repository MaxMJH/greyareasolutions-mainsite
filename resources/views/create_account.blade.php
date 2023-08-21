<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('css/create_account.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    <main>
      <a id="logo" href="/">
        <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
      </a>
      <div id="createPanel">
        <h1>Create Account</h1>
        <form action="/create_account" method="POST">
          @csrf
          <input type="email" id="email" name="email" placeholder="Enter your e-mail">
          <div id="username">
            <input id="firstname" type="text" name="firstname" placeholder="First name">
            <input id="lastname" type="text" name="lastname" placeholder="Last name">
          </div>
          <input type="password" id="password" name="password" placeholder="Enter your password">
          <input type="password" id="confirmpassword" name="confirmpassword" placeholder="Confirm your password">
          <input type="submit" id="submit" value="Create">
        </form>
        @if (session()->has('error'))
          <div class="errornotif">
            <img id="error" src="{{ asset('images/erroricon.png') }}" alt="Error">
            <p>{{ session('error') }}</p>
            <img id="close" src="{{ asset('images/crossicon.png') }}" alt="Close">
          </div>
        @endif
      </div>
    </main>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
  </body>
</html>
