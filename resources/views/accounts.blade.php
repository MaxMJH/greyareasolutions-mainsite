<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <button id="search-submit" type="submit" name="search-submit">
              <img id="searchicon" src="{{ asset('images/searchicon.png') }}" alt="Search">
            </button>
          </form>
        </div>
      </div>
      <div id="table-container">
        <div id="table">
          <table>
            <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Full Name</th>
              <th>Role</th>
              <th>Is Locked</th>
              <th>Options</th>
            </tr>
            <tr>
              <td>1</td>
              <td>maxharrismjh@gmail.com</td>
              <td>Max Harris</td>
              <td>Blogger</td>
              <td>1</td>
              <td>
                <div id="options">
                  <form id="view-more" class="user-options" action="/accounts/view" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="1">
                    <button type="submit" name="view-more">
                      <img id="view-more" src="{{ asset('images/viewmoreicon.png') }}" alt="View More">
                    </button>
                  </form>
                  <form id="edit" class="user-options" action="/accounts/edit" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="1">
                    <button type="submit" name="edit">
                      <img id="edit" src="{{ asset('images/edit.png') }}" alt="Edit">
                    </button>
                  </form>
                  <form id="remove" class="user-options" action="/accounts/remove" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="1">
                    <button type="submit" name="remove">
                      <img id="remove" src="{{ asset('images/rubbish.png') }}" alt="Remove">
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          </table>
        </div>
        <div id="table-next-back">
          <form id="table-back" action="" method="POST">
            @csrf
            <input id="back" type="submit" name="Back" value="<">
          </form>
          <span>1 of 1</span>
          <form id="table-next" action="" method="POST">
            @csrf
            <input id="next" type="submit" name="Next" value=">">
          </form>
        </div>
      </div>
    </main>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
    <script src="{{ mix('/js/accounts.js') }}"></script>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
    <script src="{{ mix('/js/modal.js') }}"></script>
  </body>
</html>
