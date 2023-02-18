<?php 
session_start();
if(!isset( $_SESSION["user"])){
  header("Location: login.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Your Appointment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="index.php">Strawberry Fields</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="login.php">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="register.php">Register</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </nav>
    <main class="container py-5">
        <h1 class="display-4 mb-4 text-center">Booking Appointment</h1>
        <p class="lead text-center mb-4">Get ready to taste the sweetest strawberries on the planet – book your appointment now to pick and savor the flavor of nature’s best!</p>
        <div class="alert alert-warning text-center mb-0" role="alert">
            We apologize for the inconvenience, but our booking services are currently down. We are working to resolve the issue and get everything back up and running as soon as possible. Thank you for your understanding and please check back soon for updates.
        </div>
    </main>
    <footer class="bg-light py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <h5>Contact Info</h5>
        <p>Strawberry Fields, 140 Grandisle Rd NW, Edmonton, AB T6M 2P1</p>
        <p>strawberryfieldsedm@gmail.com</p>
      </div>
      <div class="col-md-4">
        <h5>Service</h5>
        <ul class="list-unstyled">
          <li><a href="#">Picking Appointment</a></li>
        </ul>
      </div>
      <div class="col-md-4">
        <h5>Get In Touch</h5>
        <ul class="list-unstyled">
          <li><a href="#">Follow us through our Social Media for regular updates.</a></li>
        </ul>
      </div>
    </div>
    <hr>
    <p class="small text-muted">© 2023 Strawberry Fields. All rights reserved. Powered by Strawberry Fields.</p>
  </div>
</footer>
  </body>
</html>
