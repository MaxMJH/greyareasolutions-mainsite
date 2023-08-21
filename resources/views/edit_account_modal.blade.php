@php
    use App\Enums\RoleEnum;
@endphp

<div id="editPanel-modal">
  <div id="editPanel">
    <h1>Edit Account</h1>
    <img id="panel-close" src="{{ asset('images/crossicon.png') }}" alt="Close">
    <form action="/accounts/update" method="POST">
      @csrf
      <input type="email" id="email" name="email" placeholder="E-mail" value="{{ $user->email }}">
      <div id="username">
        <input id="firstname" type="text" name="firstname" placeholder="First name" value="{{ $user->firstname }}">
        <input id="lastname" type="text" name="lastname" placeholder="Last name" value="{{ $user->lastname }}">
      </div>
      <select id="role-select" name="role-select">
        <option value="user" @if ($user->role->value === 'User') selected @endif>User</option>
        <option value="blogger" @if ($user->role->value === 'Blogger') selected @endif>Blogger</option>
        <option value="admin" @if ($user->role->value === 'Admin') selected @endif>Admin</option>
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
</div>
