<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staging - Grey Area Solutions</title>
    <link rel="stylesheet" href="{{ mix('/css/greyareasolutions_main.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=ABeeZee">
  </head>
  <body>
    <main>
      <div class="landingpage">
        <div class="content-wrapper">
          <header>
            <img id="logo" src="{{ asset('images/logo.png') }}" alt="Logo">
            <img id="toggler" src="{{ asset('images/navigationToggler.png') }}" alt="Open Navigation">
            <nav id="navigation">
              <a href="#about">About</a>
              <a href="#portfolio">Portfolio</a>
              <a href="/blogs">Blog</a>
              <a href="mailto:contactus@greyareasolutions.net">Contact Us</a>
            </nav>
          </header>
          <div class="title">
            <div class="titles">
              <h1>Grey Area Solutions</h1>
              <h2>Empowering Code, Fortifying Security</h2>
            </div>
            <img id="git" src="{{ asset('images/github.png') }}" alt="GitHub">
          </div>
        </div>
      </div>
    </main>
    <section id="about">
      <h2>Our Mission</h2>
      <p>
        At Grey Area Solutions, we <em>empower</em> business and individuals with <em>cutting-edge</em>
        programming and cyber security <em>solutions</em>. By fortifying security measures through code,
        we protect against evolving threats and enable our clients to navigate the digital landscape with
        confidence. Through collaboration, innovation, and a commitment to excellence, we deliver tailored
        strategies that address immediate challenges and provide a foundation for long-term success.
        Our trusted partnerships, education, and continous learning cultivate a culture of <em>empowerment</em>.
      </p>
      <p>
        With integrity and professionalism, we exceed expectations, building relationships based on <em>trust</em>
        and mutual <em>respect</em>. "Empowering Code, Fortifying Security" is our driving force, unlocking potential
        and ensuring organisations <em>thrive</em> in the grey area. Together, we embrace challenges, find solutions,
        and drive growth and <em>security</em> for our clients.
      </p>
    </section>
    <section id="portfolio">
      <h2>Company Portfolio</h2>
      <p>
        Here are a small sample of projects created by our programmers. These projects range from, tools assisting with
        penetration testing, to applications concerning smart cities. Due to the company's infancy, the projects below
        are numerous, however, the number of projects will increase over the next few years.
      </p>
      <div class="projects">
        <div class="card">
          <img src="{{ asset('images/generalapp.jpeg') }}" alt="Code">
          <p>
            The HTMLScanner project is a simple Java program that searches HTML pages for specific tags as well as comments
          </p>
        </div>
        <div class="card">
          <img src="{{ asset('images/smartparkingsite.jpeg') }}" alt="Code">
          <p>
            The Smart Parking Website allows administrators to set and collect data pertaining to carparks around Nottingham
          </p>
        </div>
        <div class="card">
          <img src="{{ asset('images/generalmobileapp.jpeg') }}" alt="Code">
          <p>
            The Smart Parking Mobile Application allows users to plan their journey by selecting a carpark and seeing its
            capacity around Nottingham
          </p>
        </div>
        <div class="card">
          <img src="{{ asset('images/generalapp.jpeg') }}" alt="Code">
          <p>
            The Smart Parking XML Scanner allows for the scraping of XML forms, typically used to scrape data pertaining to
            Nottingham parking data
          </p>
        </div>
        <div class="card">
          <img src="{{ asset('images/generalmobileapp.jpeg') }}" alt="Code">
          <p>
            The Maths Education Mobile Application allows for children to practice their mathematical knowledge - aimed at
            those in KS2
          </p>
        </div>
      </div>
    </section>
    <img id="scroller" src="{{ asset('images/scroller.png') }}" alt="Scroller">
    <script src="{{ mix('/js/scripts.js') }}"></script>
  </body>
</html>
