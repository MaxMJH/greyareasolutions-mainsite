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
      <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
      <div id="loginPanel">
        <h1>Login Page</h1>
        <h2>Login with your admin or blogger credentials</h2>
        <form action="" method="POST">
          @csrf
          <input type="email" id="email" name="email">
          <input type="password" id="password" name="password">
          <input type="submit" id="submit" value="Login">
        </form>
        <a href="">Forgot your password?</a>
      </div>
    </main>
  </body>
</html>
