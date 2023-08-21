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
        <form @if(Route::currentRouteName() === 'blog.edit') action="/blog/{{ $blog->blog_slug }}/edit" @else action="/blog/create" @endif method="POST">
          @csrf
          <input id="blog-image" type="url" name="blog-image" placeholder="Blog Image" @if (old()) value="{{ old('blog-image') }}" @elseif (isset($blog)) value="{{ $blog->blog_image }}" @else @endif>
          <div id="blog-info">
            <div id="blog-title">
              <input id="blog-title" type="text" name="blog-title" placeholder="Enter Title" @if (old()) value="{{ old('blog-title') }}" @elseif (isset($blog)) value="{{ $blog->blog_title }}" @else @endif>
              <div class="blog-datetime">
                <img src="{{ asset('images/timeicon.png') }}" alt="Date">
                <h3>@if (isset($blog)) {{ $blog->created_at->format('M d, Y') }} @else {{ $date }} @endif</h3>
              </div>
            </div>
            <h3>By: {{ $user }}</h3>
            @if(old())
              <textarea id="blog-abstract" name="blog-abstract" placeholder="Enter the blog abstract">{{ old('blog-abstract') }}</textarea>
            @elseif (isset($blog))
              <textarea id="blog-abstract" name="blog-abstract" placeholder="Enter the blog abstract">{{ $blog->blog_abstract }}</textarea>
            @else
              <textarea id="blog-abstract" name="blog-abstract" placeholder="Enter the blog abstract"></textarea>
            @endif
            @if(old())
              <textarea id="blog-section" name="blog-section" placeholder="Enter the blog content">{{ old('blog-section') }}</textarea>
            @elseif (isset($blog))
              <textarea id="blog-section" name="blog-section" placeholder="Enter the blog content">{{ $blog->blog_content }}</textarea>
            @else
              <textarea id="blog-section" name="blog-section" placeholder="Enter the blog content"></textarea>
            @endif
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
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
    <script src="{{ mix('/js/errorpopup.js') }}"></script>
    <script src="{{ mix('/js/recentblogs.js') }}"></script>
  </body>
</html>
