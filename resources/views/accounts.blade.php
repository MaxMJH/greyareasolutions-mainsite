<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href=" {{ mix('/css/accounts.css') }}">
    <link rel="stylesheet" href=" {{ mix('/css/confirmation_modal.css') }}">
    <link rel="stylesheet" href=" {{ mix('/css/view_account_modal.css') }}">
    <link rel="stylesheet" href=" {{ mix('/css/edit_account_modal.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    @include('header')
    <main>
      <div id="tab-container">
        <div id="search-bar">
          <form id="search-bar" action="" method="POST">
            @csrf
            <select id="search-select" name="search-select">
              <option value="user_id" selected>ID</option>
              <option value="email">Email</option>
              <option value="fullname">Full Name</option>
              <option value="role">Role</option>
              <option value="is_locked">Locked</option>
            </select>
            <input id="search-value" type="text" placeholder="Search">
          </form>
        </div>
      </div>
      <div id="table-container">
        <div id="table">
          <table>
            <tbody>
              <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Full Name</th>
                <th>Role</th>
                <th>Is Locked</th>
                <th>Options</th>
              </tr>
            </tbody>
          </table>
        </div>
        <div id="table-next-back">
          <button id="back" name="Back"><</button>
          <span>1 of 1</span>
          <button id="next" name="Next">></button>
        </div>
      </div>
      @if (isset($error))
        <div class="errornotif">
          <img id="error" src="{{ asset('images/erroricon.png') }}" alt="Error">
          <p>{{ $error }}</p>
          <img id="close" src="{{ asset('images/crossicon.png') }}" alt="Close">
        </div>
      @endif
      @if (isset($success))
        <div class="successnotif">
          <img id="success" src="{{ asset('images/erroricon.png') }}" alt="Success">
          <p>{{ $success }}</p>
          <img id="close" src="{{ asset('images/crossicon.png' )}}" alt="Close">
        </div>
      @endif
    </main>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/modal.js') }}"></script>
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
    <script src="{{ mix('/js/accounts.js') }}"></script>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
  </body>
</html>
