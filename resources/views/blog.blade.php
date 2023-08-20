<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('/css/blog.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    @include('header')
    <main>
      <div id="blog-content">
        <img src="{{ $blog->blog_image }}" alt="Blog Image">
        <div id="blog-info">
          <div id="blog-title">
            <h2>{{ $blog->blog_title }}</h2>
            <div id="blog-edit-delete">
              <img src="{{ asset('images/edit.png') }}" alt="Edit">
              <a id="edit" href=""></a>
              <img src="{{ asset('images/rubbish.png') }}" alt="Delete">
              <a id="remove" href=""></a>
            </div>
            <div class="blog-datetime">
              <img src="{{ asset('images/timeicon.png') }}" alt="Date">
              <h3>{{ $blog->created_at->format('M d, Y') }}</h3>
            </div>
          </div>
          <h3>By: {{ $blog->user->firstname }} {{ $blog->user->lastname }}</h3>
          <p>{{ $blog->blog_content }}</p>
        </div>
      </div>
    </main>
    <section id="recent-posts">
      <h3>Recent Posts</h3>
    </section>
    @if (1 === 2)
      @include('confirmation_modal')
    @endif
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
    <script src="{{ mix('/js/recentblogs.js') }}"></script>
  </body>
</html>
