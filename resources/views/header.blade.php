@php
    use App\Enums\RoleEnum;
@endphp

<header>
  <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
  <img id="toggler" src="{{ asset('images/navigationToggler.png') }}" alt="Open Navigation">
  <nav id="navigation">
    <a href="/#about">About</a>
    <a href="/#portfolio">Portfolio</a>
    <a href="/blogs">Blog</a>
    @if (Auth::check() && Auth::user()->role === RoleEnum::Admin)
      <a href="/accounts">Accounts</a>
    @endif
    <a href="mailto:contactus@greyareasolutions.net">Contact Us</a>
  </nav>
  @if (Auth::check())
    <form id="logout" action="/logout" method="POST">
      @csrf
      <input id="logout" type="submit" value="Logout">
    </form>
  @else
    <a id="login" href="/login">Login</a>
  @endif
</header>
