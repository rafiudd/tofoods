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
              <li class="nav-item active">
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
                        <div class="dropdown-menu shadow-sm m-0" aria-labelledby="dropdownMenuButton">
                          <a style="color: black;" class="" href="logout.php">Logout</a>
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

  <div style="margin-top: 100px;"></div>


  <section class="food_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          Our Menu
        </h2>
      </div>

      <script>
        window.addEventListener('load', function() {
            console.log('All assets are loaded');
            console.log("MENU", getCookie("menu"))

            switch (getCookie("menu")) {
              case "Kantin 1":
                $('#k1').addClass('active');
                break;
             case "Kantin 2":
                $('#k2').addClass('active');
                break;

              case "Kantin 3":
                $('#k3').addClass('active');
                break;
                
              case "Kantin 4":
                $('#k4').addClass('active');
                break;
                
              default:
                $('#all').addClass('active');
                break;
            }
        });

        function createCookie(name, value, days) {
          var expires;
          if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
          }
          else {
            expires = "";
          }
          document.cookie = escape(name) + "=" + escape(value) + expires + "; path=/";
        }

        function delete_cookie(name) {
          document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
        }

        function getCookie(name) {
          var dc = document.cookie;
          var prefix = name + "=";
          var begin = dc.indexOf("; " + prefix);
          if (begin == -1) {
              begin = dc.indexOf(prefix);
              if (begin != 0) return null;
          }
          else
          {
              begin += 2;
              var end = document.cookie.indexOf(";", begin);
              if (end == -1) {
              end = dc.length;
              }
          }
          // because unescape has been deprecated, replaced with decodeURI
          //return unescape(dc.substring(begin + prefix.length, end));
          return decodeURI(dc.substring(begin + prefix.length, end));
        }

        function showData(params) {
          if(getCookie("menu")) { 
            delete_cookie("menu")
          }
          createCookie("menu", params, "10");
           <?php

           if (
               $_COOKIE["menu"] == "all" ||
               $_COOKIE["menu"] == "" ||
               !$_COOKIE
           ) {
               $sql_tampil = "SELECT * FROM products";
           } else {
               $sql_tampil =
                   "SELECT * FROM products WHERE category = '" .
                   $_COOKIE["menu"] .
                   "' ";
           }

           $data = mysqli_query($conn, $sql_tampil);
          ?>
          window.location.reload();
        }
      </script>


      <ul class="filters_menu">
        <li id="all" onclick="showData('all')" class="">All</li>
        <li id="k1" onclick="showData('Kantin 1')" class="" >Kantin 1</li>
        <li id="k2" onclick="showData('Kantin 2')" class="">Kantin 2 </li>
        <li id="k3" onclick="showData('Kantin 3')" class="">Kantin 3</li>
        <li id="k4" onclick="showData('Kantin 4')" class="">Kantin 4</li>
      </ul>

      <div class="filters-content">
        <div class="row">
          <?php while (
              $baris_data = mysqli_fetch_array($data, MYSQLI_ASSOC)
          ) { ?>
          <div class="col-sm-6 col-lg-4">
            <div class="box">
              <div>
                <div class="img-box">
                  <img src=<?php echo $baris_data[
                      "image"
                  ]; ?> alt=<?php echo $baris_data["product_name"]; ?>>
                </div>
                <div class="detail-box">
                  <h5>
                  <?php echo $baris_data["product_name"]; ?>
                  </h5>
                  <p>
                  <?php echo $baris_data["description"]; ?>
                  </p>
                  <div class="options">
                    <h6>
                      <?php echo rupiah($baris_data["price"]); ?>
                    </h6>
                    <?php
                        // session_start();
                        if(isset($_SESSION['name'])) {
                            echo ' <form id="my_form" method="POST">
                            <a href="cart-action.php?id='. $baris_data["id"] .'" onclick="showAlert()">
                                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                                    <g>
                                      <g>
                                        <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                                     c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                      </g>
                                    </g>
                                    <g>
                                      <g>
                                        <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                                     C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                                     c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                                     C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                      </g>
                                    </g>
                                    <g>
                                      <g>
                                        <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                                     c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                      </g>
                                    </g>
                                    </g>
                                  </svg>
                                </a>
                          </form>';
                        } else {
                            echo '<a onclick="showFailed()" href="#">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                              <g>
                                <g>
                                  <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                               c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                                </g>
                              </g>
                              <g>
                                <g>
                                  <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                               C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                               c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                               C457.728,97.71,450.56,86.958,439.296,84.91z" />
                                </g>
                              </g>
                              <g>
                                <g>
                                  <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                               c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                                </g>
                              </g>
                              </g>
                            </svg>
                          </a>';
                        }
                    ?>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php } ?>

        </div>
      </div>
      <div class="btn-box">
        <a href="menu.php">
          View More
        </a>
      </div>
    </div>
  </section>


  <!-- end food section -->

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
    function showAlert() {
      document.getElementById('my_form').submit();
    }
  </script>

</body>

</html>