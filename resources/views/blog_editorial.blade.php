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
        <form action="" method="POST">
          <input id="blog-image" type="url" name="blog-image" placeholder="Blog Image">
          <div id="blog-info">
            <div id="blog-title">
              <input id="blog-title" type="text" name="blog-title" placeholder="Enter Title">
              <div class="blog-datetime">
                <img src="{{ asset('images/timeicon.png') }}" alt="Date">
                <h3>June 22, 2023</h3>
              </div>
            </div>
            <h3>By: Max Harris</h3>
            <textarea id="blog-section" name="blog-section" placeholder="Enter the content of the blog"></textarea>
          </div>
          <div id="cancel-publish">
            <input id="cancel" type="button" name="cancel" value="Cancel">
            <input id="publish" type="submit" name="publish" value="Publish">
          </div>
        </form>
      </div>
    </main>
    @if (1 === 2)
      @include('confirmation_modal')
    @endif
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="{{ mix('/js/pagelayout.js') }}"></script>
  </body>
</html>
