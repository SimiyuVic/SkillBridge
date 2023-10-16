
<?php
session_start();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
       <style>
          .navbar-brand {
              font-family: 'Pacifico', cursive; /* Set the font-family to 'Pacifico' or your chosen curly font */
          }
      </style>

  </head>
  <body>
    <!---Navigatiob Bar Starts-->
      <nav class="navbar navbar-expand-lg bg-info sticky-top" style="padding: 20px;">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <a class="navbar-brand fw-bold text-light" href="#">Skill-Bridge</a>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
              <li class="nav-item ">
                <a class="nav-link active fw-bold text-light" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#candidates">Candidates</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#employers">Employers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#about-us">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="login.php">Log In</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="register.php">Sign Up</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>


    <!---Navigatiob Bar Ends Here-->

<!--Home Page-->
<style>
    .wrapper
      {
          margin : 50px auto;
          border-radius: 10px;
          padding-top: 50px;
          padding-bottom: 50px;
          box-shadow: 0 0 40px 2px rgba(37,73, 214, 018);
      }
      .feature-box
      {
        padding: 30px;
      }
      .feature-box h1
      {
        margin-top: 20%;
        color: #c200ff;
      }
      .feature-box p
      {
        color: #555;
      }
      .feature-box a 
      {
        text-decoration: none !important;
        background: #a669ce;
        border-radius: 20px;
        padding: 10px 20px;
        margin-right: 30px;
        border: 2px solid #a669ce !important;
        color: #fff;
      }
      .btn-one:hover
      {
        color: #fff;
      }
      .btn-two
      {
        background: none !important;
        color: #a669ce !important;
      }
      @media only screen and (max-width:990px)
      {
        .feature-box a
        {
          padding: 5px 8px ;
          margin-right: 10px;
        }
      }
  </style>
<div class="container">
    <div class="wrapper">
        <div class="row">
            <div class="col-md-6">
                <div class="feature-box">
                    <h1>Need A Job ?</h1>
                    <p class="my-5">We are here to help you get a place you will comfortably build your skills overtime,
                         this will help you scale up your career, <strong>SELECT</strong> what you qualify for and <strong>MAKE</strong> an application today.</p>
                         <a href="register.php" class="btn-one">Get Started</a>
                         <a href="jobs.php" class="btn-two">Available Vacancies</a>
                </div>
            </div>
            <div class="col-md-6">
                 <img src="assets/img/bg-home.png" class="img-fluid" alt="...">
            </div>
        </div>
    </div>
</div>

<!--Home Page Ends Here-->
<!---Jobs Section Starts Here--->
<section id="jobs">
  <div class="container my-5">
    <h2 class="text-center text-primary display-4">Latest Vacancies</h2>
  </div>
</section>

<!---Jobs Section ends Here---->

<!-----Candidates Sections---->
<section id="candidates">
 <div class="container my-5">
  <h2 class="text-center text-primary display-4">Candidates</h2>
  <p class="text-center lead">Look no further while searching for a job, <i class="fw-bold text-primary">Skill-Bridge</i>  is here to stramline all that.</p>
  <div class="row text-center my-5">
    <div class="col-md-4 my-3">
      <div class="card shadow">
         <img src="assets/img/search.jpg" class="card-img-top" alt="search">
          <div class="card-body">
            <h3 class="card-text">Search for Jobs Your Qualify .</h3>
          </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card shadow">
         <img src="assets/img/interview.jpg" class="card-img-top" alt="interview">
          <div class="card-body">
            <h3 class="card-text">Apply and Get Interviewed .</h3>
          </div>
      </div>
    </div>
    <div class="col-md-4 my-3">
      <div class="card shadow">
         <img src="assets/img/career.jpg" class="card-img-top" alt="career">
          <div class="card-body">
            <h3 class="card-text">Build Your Career .</h3>
          </div>
      </div>
    </div>
  </div>
 </div>
</section>

<!-----Candidates Sections Ends Here---->

<!-----Employers Sections---->
<section id="employers">
  <div class="container my-5">
    <h2 class="text-center text-primary display-4">Employers</h2>
    <p class="lead text-center">Looking for the Best Talent in the market, We have a whole pool awaiting you .</p>
    <div class="row text-center">
  <!-- First column -->
  <div class="col-md-4 d-flex align-items-stretch my-3">
    <div class="card shadow">
      <img src="assets/img/advertise.jpg" class="card-img-top" alt="advertise">
      <div class="card-body">
        <h3 class="card-text">Post a Vacancy.</h3>
      </div>
    </div>
  </div>

  <!-- Second column -->
  <div class="col-md-4 d-flex align-items-stretch my-3">
    <div class="card shadow">
      <img src="assets/img/track.jpg" class="card-img-top" alt="track">
      <div class="card-body">
        <h3 class="card-text">Get help Manage Applicants and Track the applications from  applicants.</h3>
      </div>
    </div>
  </div>

  <!-- Third column -->
  <div class="col-md-4 d-flex align-items-stretch my-3">
    <div class="card shadow">
      <img src="assets/img/hire.jpg" class="card-img-top" alt="hire">
      <div class="card-body">
        <h3 class="card-text">Hire The Best.</h3>
      </div>
    </div>
  </div>
</div>

  </div>
</section>
<!-----Employers Sections Ends Here---->


<!---Who are we section--->
<section id="about-us">
  <div class="container my-4">
    <h2 class="text-center text-primary display-4">Who are We?</h2>
    <div class="row text-start">
      <div class="col-md-6 my-3">
        <img src="assets/img/about-us.jpg" alt="about-us" class="img-fluid">
      </div>
      <div class="col-md-6 my-3">
        <p class="lead">
        SkillBridge is a dynamic and innovative workforce solutions provider dedicated to bridging the gap between exceptional talent 
        and organizations seeking to thrive in today's ever-evolving professional landscape. We specialize in connecting top-tier 
        professionals with leading companies, offering a seamless platform where talent meets opportunity.
        Our mission is to empower both individuals and businesses by fostering mutually beneficial relationships. For job seekers, 
        SkillBridge serves as a gateway to meaningful career opportunities, helping them unlock their full potential. For employers, 
        we are a trusted partner, delivering tailored staffing solutions that drive growth and success. At SkillBridge, 
        we are committed to reshaping the world of work, creating a bridge to success for all those who engage with our platform.
        </p>
      </div>
    </div>
  </div>
</section>
<!---Who are we section Ends here--->



<footer class="main-footer" style="margin-left: 0px;">
    <div class="text-center  ">
      <strong>Copyright &copy; 2023 <a href="index.php">Skill-Bridge</a>.</strong> All rights
    reserved.
    </div>
  </footer>

<script src="https://kit.fontawesome.com/6fff7c638d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>