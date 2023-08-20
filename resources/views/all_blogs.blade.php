<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('/css/blogs.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    @include('header')
    <main>
      @for ($i = 0; $i < count($blogs); $i++)
        <div class="blog">
          <img src="{{ $blogs[$i]->blog_image }}" alt="Blog Image">
          <div class="blog-content">
            <h2>{{ $blogs[$i]->blog_title }}</h2>
            <div class="blog-info">
              <h3>By: {{ $users[$i] }}</h3>
              <div class="blog-datetime">
                <img src="{{ asset('images/timeicon.png') }}" alt="Date">
                <h3>{{ $blogs[$i]->created_at->format('M d, Y') }}</h3>
              </div>
            </div>
            <p>{{ $blogs[$i]->blog_abstract }}</p>
            <a href="blog/{{ $blogs[$i]->blog_slug }}">Read More</a>
          </div>
        </div>
      @endfor
      <div class="add-blog">
        <form action="/blog/create" method="GET">
          <input type="submit" value="Add Blog">
        </form>
      </div>
    </main>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
  </body>
</html>
