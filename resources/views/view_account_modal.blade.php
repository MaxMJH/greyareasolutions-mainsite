<div id="viewPanel-modal">
  <div id="viewPanel">
    <h1>Further Details</h1>
    <img id="panel-close" src="{{ asset('images/crossicon.png') }}" alt="Close">
    <div id="info-container">
      <span>Last Login</span>
      <span>{{ $user->last_login}}</span>
      <span>Failed Login Attempts</span>
      <span>{{ $user->failed_attempts}}</span>
      <span>Locked Till</span>
      <span>@if ($user->lock_till === null) Not Locked @else {{ $user->lock_till }} @endif</span>
      <span>Created At</span>
      <span>{{ $user->created_at }}</span>
      <span>Updated At</span>
      <span>{{ $user->updated_at }}</span>
    </div>
  </div>
</div>
