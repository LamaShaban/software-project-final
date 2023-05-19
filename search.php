<?php
session_start();

if(isset($_SESSION['user_id'])){
  $user_id = $_SESSION['user_id'];
}else{
  $user_id = '';

};
$user_info = $database->query("SELECT * FROM users WHERE user_id='$user_id'");
$users = $user_info->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Product Filter And Search</title>
    <!-- Google Font -->
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap"
      rel="stylesheet"
    />
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/search.css" />
    <link rel="stylesheet" href="css/sidebar.css" />
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
                      <a class="nav-link" href="home.php" >About</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Contact" >Categories</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="home.php" >Reviews</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#Contact" >Contact</a>
                    </li>
                  </div>
              </div>
              </div>
           
              <div class="icon-conect d-flex justify-content-center align-items-center">
                <button class=" mx-1 btn border-0 shopping "><i class="fa-solid fa-cart-shopping "></i><span class="quantity">0</span></button>
                  <button class=" mx-1 btn  border-0 "><a href="whishlist.php"><i class="fa-solid fa-heart"></i></a>
                  </button>
                  <button class=" mx-1 btn  border-0 "><a href="search.php">
                    <i class="fa-solid fa-magnifying-glass "></i>
                  </a></button>
                  <button class=" mx-1 btn  border-0 "><i class="fa-solid fa-bars " id="bttn"></i></button>
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


    <div class="wrapper">
      <div id="search-container">
        <input
          type="search"
          id="search-input"
          placeholder="Search product name here.."
        />
        <button id="search">Search</button>
      </div>
      <div id="buttons">
        <button class="button-value" onclick="filterProduct('all')">All</button>
        <button class="button-value" onclick="filterProduct('Resistores')">
          Resistores
        </button>
        <button class="button-value" onclick="filterProduct('Diodes')">
          Diodes
        </button>
        <button class="button-value" onclick="filterProduct('Transistors')">
          Transistors
        </button>
        <button class="button-value" onclick="filterProduct('Buzzers')">
          Buzzers
        </button>
        <button class="button-value" onclick="filterProduct('ICs')">
          Ics
        </button>
      </div>
      <div id="products"></div>
    </div>

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

    <!-- Script -->
    <script src="js/search.js"></script>
    <script src="js/cart.js"></script>
		<script src="js/jquery.min.js"></script>
		<script src="js/owl.carousel.min.js"></script>
		<script src="js/script.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script> 
		<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
  </body>
</html>