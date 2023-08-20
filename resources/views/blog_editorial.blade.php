<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('/css/blog_editorial.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    @include('header')
    <main>
      <div id="blog-content">
        <form action="/blog/create" method="POST">
          @csrf
          <input id="blog-image" type="url" name="blog-image" placeholder="Blog Image" @if (old()) value="{{ old('blog-image') }}"@endif>
          <div id="blog-info">
            <div id="blog-title">
              <input id="blog-title" type="text" name="blog-title" placeholder="Enter Title" @if (old()) value="{{ old('blog-title') }}"@endif>
              <div class="blog-datetime">
                <img src="{{ asset('images/timeicon.png') }}" alt="Date">
                <h3>{{ $date }}</h3>
              </div>
            </div>
            <h3>By: {{ $user }}</h3>
            <textarea id="blog-abstract" name="blog-abstract" placeholder="Enter the blog abstract">@if (old()){{ old('blog-abstract') }}@endif</textarea>
            <textarea id="blog-section" name="blog-section" placeholder="Enter the content of the blog">@if (old()){{ old('blog-section') }}@endif</textarea>
          </div>
          <div id="cancel-publish">
            <a id="cancel" href="/blogs">Cancel</a>
            <input id="publish" type="submit" name="publish" value="Publish">
          </div>
        </form>
      </div>
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
    </main>
    @if (1 === 2)
      @include('confirmation_modal')
    @endif
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
    <script src="{{ mix('/js/recentblogs.js') }}"></script>
  </body>
</html>
