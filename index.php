

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Skill-Bridge | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <!---Navigatiob Bar Starts-->
      <nav class="navbar navbar-expand-lg bg-info">
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
                <a class="nav-link fw-bold text-light" href="#">Candidates</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#">Employers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link fw-bold text-light" href="#">About Us</a>
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
                         <a href="" class="btn-one">Get Started</a>
                         <a href="" class="btn-two">Available Vacancies</a>
                </div>
            </div>
            <div class="col-md-6">
                 <img src="assets/img/bg-home.png" class="img-fluid" alt="...">
            </div>
        </div>
    </div>
</div>

<!--Home Page Ends Here-->



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