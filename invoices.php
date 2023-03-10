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
              <li class="nav-item">
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
    <!-- end header section -->
  </div>

  <div style="margin-top: 100px"></div>
    <div class="row mx-0 align-items-center justify-content-center mt-5">
      <div class="container row">
      <div class="col-8">
        <a href="orders.php">Kembali</a>
        <h1>Invoice</h1>
        <br>
        <form action="update-payment.php?order_id=<?php echo $_GET['order_id'] ?>" method="POST">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Nama Lengkap</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" disabled placeholder=<?php echo $_SESSION['name'] ?>>
                        </div>
                        <?php 
                            $sql_tampil = "SELECT * FROM orders WHERE orders.order_id = '{$_GET['order_id']}'";
                            $data = mysqli_query($conn, $sql_tampil);
                            while($baris_data = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
                        ?>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Total</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" disabled placeholder="Rp. <?php echo $baris_data['price']; ?>">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Alamat Pengiriman</label>
                            <textarea disabled placeholder=<?php echo $baris_data['address'] ?>  name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>
                        <?php } ?>

                        <div class="modal-footer">
                        <!-- <button type="submit" class="btn btn-success"> Confirm Payment </button> -->
                    </div>
                </form>
      </div>
      <div class="col-4 mt-5">
          <br>
        <img style="border-radius: 20px;" width="80%" src="./images/dana.jpeg" alt="" srcset="">
        <p class="mt-2">Transfer ke dana 0852323842132 atas nama Dimas Nurwanda</p>
      </div>
      </div>
    </div>
    <div style="margin-top: 200px"></div>


  <!-- footer section -->
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

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>