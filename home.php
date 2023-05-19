<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost;dbname=electronics;",$username,$password);

session_start();
$user_id = $_SESSION['user_id'];

$all_products = $database->query("SELECT * FROM usersrate");
$user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
$users = $user_info->fetchAll(PDO::FETCH_ASSOC);
$rows = $all_products->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electronics</title>
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sidebar.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <header class="header">
        <nav class="navbar navbar-start">
         <div class="container px-5 ">
           <div class="logo d-flex justify-content-center align-items-center">
             <a class="navbar-brand py-1" href="home.php">
               <div class="log-name">
                <div class="d-inline"><i class="fa-solid fa-plug fa-2x"></i></div>
                <span class="go_trip">Electronics</span>
               </div>
              </a>
 
           <div class="menu">
             <div class=" navbar-expand-lg justify-content-between " id="navbarNavDropdown">
               <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="home.php" >Home</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#features" >About</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Categories" >Categories</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#review" >Reviews</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#Contact" >Contact</a>
                      </li>
                    </div>
                </div>
                </div>
             
                <div class="icon-conect d-flex justify-content-center align-items-center">
                <?php
                    $count_cart_items = $database->prepare("SELECT * FROM `cart` WHERE user_id = ?");
                    $count_cart_items->execute([$user_id]);
                    $total_cart_counts = $count_cart_items->rowCount();
                ?>
                <div class="icon-conect d-flex justify-content-center align-items-center">
                  <button class=" mx-1 btn border-0 shopping ">
                    <a href="cart.php">
                  <i class="fa-solid fa-cart-shopping "></i><span><?= $total_cart_counts; ?></span>
                  </a>
                </button>
                    <button class=" mx-1 btn  border-0 "><a href="whishlist.php"><i class="fa-solid fa-heart"></i></a>
                    </button>
                    <button class=" mx-1 btn  border-0 "><a href="search.php"><i class="fa-solid fa-magnifying-glass "></i></a></button>
                    <button class=" mx-1 btn  border-0 "><i class="fa-solid fa-bars "></i></button>
              
                </div>
 
               </ul>
             </div>
           
         </div>
       </nav>
     </header>
     <div class="sidebars">
      <div class="cheak"><i  class="fa-solid fa-circle-xmark" id="cancel"></i></div>
      <div class="user">
          <?php
            foreach ($users as $user) {
          ?>
        <div class="user-pic"><img src="<?php echo $user["user_img"]; ?>" alt="" class="user-img"></div>
        <p class="user-name"><?php echo $user["username"]; ?></p>
      </div>
      <ul>
        <li><a href="whishlist.php"><i class="fa-solid fa-heart "></i>Whishlist</a></li>
        <li><a href="cart.php"><i class="fa-solid fa-cart-shopping "></i>MY Cart</a></li>
        <li><a href="myOrders.php"><i class="fa-solid fa-tags "></i>Orders</a></li>
        <li><a href="settings.php"><i class="fa-solid fa-gear "></i>Settings</a></li>
        <li><a href="rating.php"><i class="fa-solid fa-star"></i>Rate this shop</a></li>
        <li><a href="index.php"><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
      </ul>
          <?php
            }
          ?>
    </div>
</div>

   <main>
    <section class="hero">
      <div class="back">
          <div id="carouselExampleDark" class="carousel carousel-dark slide justify-content-center align-items-center" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="1000">
                  <img src="images/download.jpg" height="725" class="d-block w-100" alt="...">
                  <div class="carousel-caption d-none d-md-block  "><br><br><br>
                    <h1 style="color: #fff; font-size: 70px;font-weight: bolder; margin-top: -450px;">WELCOME</h1>
                    <h1 style="color: #fff; font-size: 70px;font-weight: bolder;margin-top: -10px;">TO ELECTRONICS</h1><br><br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
      </div>
     </section>

     <section class="features text-center bg-light py-5 " id="features">
      <div class="we_do py-5">
        <h4>What We Do</h4>
        <h3>Our Services</h3>
      </div>
      <div class="container py-5">
          <div class="row justify-content-around">
              <div class="col-md-3" >
                  <div class="item bg-white rounded  p-5">
                   <div class="service_name p-4 "><i class="fa-solid fa-bolt-lightning fa-3x  "></i></div>
                      <h2 class="my-3">Provide Electronics Part</h2>
                      <p>Electronics is a shop that provides several electronic parts</p>
                  </div>
              </div>

              <div class="col-md-3 px-3" >
                  <div class="item bg-white rounded  p-5">
                    <div class="service_name p-4 "><i class="fa-solid fa-truck fa-3x  "></i></div>
                      
                      <h2 class="my-3">Delivery Service</h2>
                      <p>Electronics have a delivery option</p>
                  </div>
              </div>

              <div class="col-md-3 px-3" >
                  <div class="item bg-white rounded  p-5">
                    <div class="service_name p-4  "><i class="fa-solid fa-money-bill fa-3x "></i></div>
                    
                      <h2 class="my-3">Different payment options</h2>
                      <p>Electronics allows you to chooice payment way that you prefer</p>
                  </div>
              </div>

          </div>
      </div>
  </section>
 
  <section class="Categories" id="Categories" >
    <div class="container">
      <H2>Categories</H2>
      <div class="row my-5 products">
        <div class="col-md-3 col-6 mt-4 product ">
          <div class="card" style="width: 270px;">
            <img src="images/high-voltage-resistors.jpg.webp" class="card-img-top rounded h-100" alt="...">
            <div class="card-body">
              <a href="resistor.php"><h4>High Voltage Rsistors</h4></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6 mt-4 product">
          <div class="card" style="width: 270px;">
            <img src="images/schottky-diode-500x500.webp" class="card-img-top rounded  h-100" alt="...">
            <div class="card-body">
              <a href="diode.php"><h4>Diodes</h4></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6 mt-4 product">
          <div class="card" style="width: 270px;">
            <img src="images/hxd-buzzers-5v-250x250.webp" class="card-img-top rounded h-100" alt="...">
            <div class="card-body">
              <a href="Buzzer.php"><h4>Buzzers</h4></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6 mt-4 product ">
          <div class="card" style="width: 270px;">
            <img src="images/ICS-400x231.jpg" class="card-img-top rounded h-100" alt="...">
            <div class="card-body">
              <a href="Ics.php"><h4>ICs</h4></a>
            </div>
          </div>
        </div>
        <div class="col-md-3 col-6 mt-4 product ">
          <div class="card" style="width: 270px;">
                <img src="images/transistors.png" class="card-img-top rounded h-200" alt="...">
            <div class="card-body">
              <a href="transistor.php"><h4>Transistors</h4></a>
            </div>
                
          </div>
        </div>
      </div>
    </div>
  </section>
   
  
  <section class="review bg-light p-6" id="review">
   
    <div class="slide-container swiper">
      <div class="slide-content">
          <div class="card-wrapper swiper-wrapper">
          <?php
            foreach ($rows as $row) {
          ?>

              <div class="user-review-card swiper-slide">
                  <div class="image-content">
                      <span class="overlay"></span>

                      <div class="card-image">
                          <img src="<?php echo $row["user_image"]; ?>" alt="" class="card-img">
                      </div>
                  </div>

                  <div class="card-content">
                      <h2 class="name"><?php echo $row['name']; ?></h2>
                      <p class="description">"<?php echo $row['rate']; ?>"</p>

                      <div class="rate">
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                          <span class="fa fa-star checked"></span>
                      </div> 
                  </div>
              </div>
        
              <?php
               }
              ?>
              
          </div>
      </div>

      <div class="swiper-button-next swiper-navBtn" style="color: #ffcc00;"></div>
      <div class="swiper-button-prev swiper-navBtn" style="color: #ffcc00;"></div>
      <div class="swiper-pagination" style="color: #ffcc00;"></div>
  </div>

 
</section>

   </main>

   <footer class="h-50 p-5 bg-dark text-white mt-5" id="Contact">
     <div class="container">
      <div class="container">
        <div class="container">
          <div class="container">
            <div>
              <div class="row d-flex justify-content-between align-item-center">
                <div class="col-3">
                  <h5 class="mx-2" style="color:#ffcc00">CONTACT US</h5>
                  <div class="d-flex ">
                    <i class="fa-solid fa-location-dot mx-2 mt-2 text-muted"></i>
                    <p class="text-muted">Palestine, Gaza, Al-Nasser, Maple Building</p>
                  </div>
                  <div class="d-flex ">
                    <i class="fa-solid fa-phone mx-2 mt-2 text-muted"></i>
                    <p class="text-muted">+(21)-255-999-8888</p>
                  </div>
                  <div class="d-flex ">
                    <i class="fa-solid fa-envelope mx-2 mt-2 text-muted"></i>
                    <p class="text-muted"> Electronics-mail@support.com</p>
                  </div>
                  <div class="social-media d-flex">
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"> <i class="fa-brands fa-facebook-f p-2 text-muted"></i></div>
                    <div class="bg-secondary bg-opacity-25 rounded  mx-2"><i class="fa-brands fa-twitter p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"> <i class="fa-brands fa-instagram p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded mx-2"><i class="fa-brands fa-google-plus-g p-2 text-muted"></i></div>
                   <div class="bg-secondary bg-opacity-25 rounded  mx-2"><i class="fa-brands fa-linkedin-in p-2 text-muted"></i></div>
                  </div>
                </div>
                <div class="col-2">
                  <h5 class="mx-4" style="color:#ffcc00">CATGORY</h5>
                  <ul>
                    <li class="text-muted list-group-item mt-2"><a href="transistor.php">Transistor</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="diode.php">Diode</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="resistor.php">High voltage resistors</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="Buzzer.php">Buzzers</a></li>
                    <li class="text-muted list-group-item mt-2"><a href="Ics.php">ICs</a></li>
                  </ul>
                </div>
                <div class="col-3">
                </div>
                <div class="col-2">
             
                </div>
            </div>
     <hr class="mt-5">
          <div class="d-flex justify-content-center align-item-center ">
                <p class="text-muted fs-6">© 2023 Elctronics Shop. All rights reserved | Designed by LASED</p>
          </div>
          </div>
        </div>
      </div>
     </div>
   </footer>





<script src="js/jquery.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/script.js"></script>
<script src="js/cart.js"></script>
<script src="js/bootstrap.bundle.min.js"></script> 
<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>\
<script src="js/main.js"></script>
<script src="js/swiper-bundle.min.js"></script>
</body>
</html>