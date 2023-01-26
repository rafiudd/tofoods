<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Tofood </title>

  
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
  
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              Tofood
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item active">
                <a class="nav-link" href="book.php">Book Table</a>
              </li>
            </ul>
            <div class="user_option">
              <a class="cart_link" href="cart.php">
                <i class="fa" style="font-size:20px; color: white;">&#xf07a;</i>
                <?php
                  include 'connection.php';
                  session_start();
                  if(empty($_SESSION['id'])) {
                    $_SESSION['id'] = 0;
                  }
                  $sql = "SELECT COUNT(*) AS total FROM carts WHERE user_id = '{$_SESSION['id']}'";
                  $result = mysqli_query($conn, $sql);
                  $data = mysqli_fetch_assoc($result);
                ?>
                <span class='badge badge-warning' id='lblCartCount'> <?php echo $data['total']; ?> </span>
              </a>

              <?php
                if(isset($_SESSION['name'])) {
                    echo '
                      <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hi, '.$_SESSION['name'].'!</button>
                        <div class="dropdown-menu px-2" aria-labelledby="dropdownMenuButton">
                          <a style="color: black;" class="dropdown-item" href="logout.php">Logout</a>
                          <a style="color: black;" class="dropdown-item" href="orders.php">Riwayat Pemesanan</a>
                        </div>
                      </div>
                            ';
                } else {
                  echo '<a href="login.php" class="user_link">
                        <i class="fa fa-user" aria-hidden="true"></i>
                        </a><a href="" class="order_online">
                        Order Online
                      </a>';
                  }
                ?>
            </div>
          </div>
        </nav>
      </div>
    </header>
  </div>

  <section class="book_section layout_padding">
    <div class="container">
      <?php
            $selectquery = "SELECT * FROM book_table WHERE status = 'Waiting Confirmation' ORDER BY id DESC LIMIT 1";
            $result = mysqli_query($conn, $selectquery);
            $data = mysqli_fetch_assoc($result);
          ?>
      <div class="heading_container">
        <h2>
          <?php 
          if(mysqli_num_rows($result) > 0) {
            echo 'Booking Table Confirmation';
          } else {
            echo 'Book A Table';
          }
          ?>
        </h2>
      </div>
      <div class="row">
        <div class=" <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo 'col-md-12';
                } else {
                  echo 'col-md-6';
                }
              ?>">
          <div class="form_container">
            <form action="<?php 
                if(mysqli_num_rows($result) > 0) {
                  echo 'booking-table-update.php';
                } else {
                  echo 'book-table-action.php';
                }
              ?>" method="POST">
              <div>
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<input disabled type="text" name="name" class="form-control" placeholder="'. $_SESSION["name"] .'" />';
                } else {
                  echo '<input type="text" name="name" class="form-control" placeholder="Your Name" />';
                }
              ?>
              </div>
              <div>
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<input disabled type="text" name="name" class="form-control" placeholder="'. $data["phone"] .'" />';
                } else {
                  echo '<input type="text" name="phone" class="form-control" placeholder="Phone Number" />';
                }
              ?>
              </div>
              <div>
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<input disabled type="text" name="name" class="form-control" placeholder="'. $data["email"] .'" />';
                } else {
                  echo '<input type="email" name="email" class="form-control" placeholder="Your Email" />';
                }
              ?>
                
              </div>
              <div>
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<select name="quantity" class="form-control nice-select wide">
                  <option disabled value="'. $data["quantity"] .'" disabled selected>
                  '. $data["quantity"] .'
                  </option>
                </select>';
                } else {
                  echo '<select name="quantity" class="form-control nice-select wide">
                  <option disabled value="0" disabled selected>
                    How many persons?
                  </option>
                  <option value="2">
                    2
                  </option>
                  <option value="3">
                    3
                  </option>
                  <option value="4">
                    4
                  </option>
                  <option value="5">
                    5
                  </option>
                </select>';
                }
              ?>
                
              </div>
              <div>
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<input disabled name="date_attend" type="date" class="form-control" value="'. $data["date_attend"] .'">';
                } else {
                  echo '<input name="date_attend" type="date" class="form-control">';
                }
              ?>
                
              </div>
              <div class="btn_box">
              <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '<button type="submit">
                  Confirm Attending
                </button>';
                } else {
                  if(empty($_SESSION['id'])) {
                    echo '<button onclick="showFailed()" type="button">
                  Book Now
                </button>';
                  } else {
                  echo '<button type="submit">
                  Book Now
                </button>';
              }
                }
              ?>
                
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
          <?php 
                if(mysqli_num_rows($result) > 0) {
                  echo '';
                } else {
                  echo '<div id="googleMap"></div>';
                }
              ?>
            
          </div>
        </div>
      </div>
    </div>
  </section>
 

  
   <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contact Us
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Location
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call 085857925870
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  Tofood@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Tofood
            </a>
            <p>
              Tofoods merupakan salah satu aplikasi yang menawarkan pelayanan pesan antar  makanan & minuman di kantin IT Telkom 
              sesuai dengan permintaan pengguna Tofoods.
            </p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Opening Hours
          </h4>
          <p>
            Monday - Saturday
          </p>
          <p>
            10.00 Am -10.00 Pm
          </p>
        </div>
      </div>
      <div class="footer-info">
        <p>
          &copy; <span id="displayYear"></span> All Rights Reserved By
          <a href="https://Tofood.co.id">Team Ultramilk</a><br><br>
          &copy; <span id="displayYear"></span> Distributed By
          <a href="https://Tofood.co.id/" target="_blank">Tofood</a>
        </p>
      </div>
    </div>
  </footer>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  
  <script src="js/bootstrap.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>

  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <script src="js/custom.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <script>
            function showFailed() {
            Swal.fire(
                    'Maaf, Anda Harus Login',
                    'Untuk melakukan pemesanan silahkan login terlebih dahulu',
                    'error'
                    ).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        window.location.href = 'login.php';
                    }
                })
        }
  </script>

</body>

</html>