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
    <header>
      <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
      <img id="toggler" src="{{ asset('images/navigationToggler.png') }}" alt="Open Navigation">
      <nav id="navigation">
        <a href="/#about">About</a>
        <a href="/#portfolio">Portfolio</a>
        <a href="/blogs">Blog</a>
        <a href="mailto:contactus@greyareasolutions.net">Contact Us</a>
      </nav>
      <a id="login" href="/login">Login</a>
    </header>
    <main>
      <div class="blog">
        <img src="{{ asset('images/generalapp.jpeg') }}" alt="Blog Image">
        <div class="blog-content">
          <h2>The Beginning</h2>
          <div class="blog-info">
            <h3>By: Max Harris</h3>
            <div class="blog-datetime">
              <img src="{{ asset('images/timeicon.png') }}" alt="Date">
              <h3>June 22, 2023</h3>
            </div>
          </div>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit. In gravida dapibus magna, a convallis est ornare
            vitae. Duis sed mauris semper, suscipit elit nec, fringilla mi.
          </p>
          <a href="/blog">Read More</a>
        </div>
      </div>
    </main>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="{{ mix('/js/blogs.js') }}"></script>
  </body>
</html>
