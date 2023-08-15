<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('css/edit_account.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    <main>
      <div id="editPanel">
        <h1>Edit Account</h1>
        <img id="panel-close" src="{{ asset('images/crossicon.png') }}" alt="Close">
        <form action="/accounts/update" method="POST">
          @csrf
          <input type="email" id="email" name="email" placeholder="E-mail">
          <div id="username">
            <input id="firstname" type="text" name="firstname" placeholder="First name">
            <input id="lastname" type="text" name="lastname" placeholder="Last name">
          </div>
          <select id="role-select" name="role-select">
            <option value="user" selected>User</option>
            <option value="blogger">Blogger</option>
            <option value="admin">Admin</option>
          </select>
          <input type="submit" id="submit" value="Edit">
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
