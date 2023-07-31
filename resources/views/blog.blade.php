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
      <div id="blog-content">
        <img src="{{ asset('images/generalapp.jpeg') }}" alt="Blog Image">
        <div id="blog-info">
          <div id="blog-title">
            <h2>The Beginning</h2>
            <div id="blog-edit-delete">
              <img src="{{ asset('images/edit.png') }}" alt="Edit">
              <a id="edit" href=""></a>
              <img src="{{ asset('images/rubbish.png') }}" alt="Delete">
              <a id="remove" href=""></a>
            </div>
            <div class="blog-datetime">
              <img src="{{ asset('images/timeicon.png') }}" alt="Date">
              <h3>June 22, 2023</h3>
            </div>
          </div>
          <h3>By: Max Harris</h3>
          <p>
            Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint
            ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia.
            Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident.
            Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia
            dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi
            laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim.
            Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
            <br><br>
            Lorem ipsum dolor sit amet, officia excepteur ex fugiat reprehenderit enim labore culpa sint
            ad nisi Lorem pariatur mollit ex esse exercitation amet. Nisi anim cupidatat excepteur officia.
            Reprehenderit nostrud nostrud ipsum Lorem est aliquip amet voluptate voluptate dolor minim nulla est proident.
            Nostrud officia pariatur ut officia. Sit irure elit esse ea nulla sunt ex occaecat reprehenderit commodo officia
            dolor Lorem duis laboris cupidatat officia voluptate. Culpa proident adipisicing id nulla nisi
            laboris ex in Lorem sunt duis officia eiusmod. Aliqua reprehenderit commodo ex non excepteur duis sunt velit enim.
            Voluptate laboris sint cupidatat ullamco ut ea consectetur et est culpa et culpa duis.
          </p>
        </div>
      </div>
    </main>
    <section id="recent-posts">
      <h3>Recent Posts</h3>
      <div class="recent-post">
        <img src="{{ asset('images/generalapp.jpeg') }}" alt="Blog Image">
        <div class="blog-info">
          <h4>The Beginning</h4>
          <div class="blog-datetime">
            <img src="{{ asset('images/timeicon.png') }}" alt="Date">
            <h5>June 22, 2023</h5>
          </div>
        </div>
        <a class="recent-post-ref" href=""></a>
      </div>
    </section>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="{{ mix('/js/blogs.js') }}"></script>
  </body>
</html>
