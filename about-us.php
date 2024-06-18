
<?php 

session_start();
$_SESSION['userID'];
$_SESSION['loggedUser'];

if(empty($_SESSION['loggedUser'])){
    header('Location: Log-in-Form.php');
    exit;
}
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About us | Dime Footwear</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-rfhP/KuX8Vvp3sEVSJrF2T4taK3jnuHBeq5KoxRYhAaQb5vohK6c9m3KBcAG2wn7g73Em1zR/ubqyLkHXvHgCA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

  <link rel="stylesheet" type="text/css" href="product-card.css">
<script src="product-card.js"></script>
</head>
<style type="text/css">
           i {
    color: white;
  }
  span {
    color: white;
  }
  i:hover {
    color: #443f38;
  }
  span:hover {
    color: #443f38;
  }
  a {
    color: white;
    text-decoration: none;
  }
  .nav-pills .nav-link {
    width: 200px;
  }
  .nav-pills .nav-link:hover {
    width: 200px;
    background-color: #6c757d;
    transition: background-color 0.3s ease, padding 0.3s ease;
  }
  .nav-link.active {
    background-color: #6c757d;
  }
  .carousel-control-prev,
  .carousel-control-next {
    border-radius: 50%;
    background-color: #6c757d;
    opacity: 0.8;
  }
  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: white;
  }
  .close-btn-container {
    display: block;
    margin-bottom: 20px;
  }
  .topnav2 {
    position: sticky;
    top: 0;
    z-index: 1000;
    background-color: #333;
    padding: 10px 0;
  }
  .blur-background {
    background-image: url('img/bg.jpeg');
    background-size: cover;
    backdrop-filter: blur(5px);
  }
  .col-md-4 {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .col-md-4:hover {
    transform: scale(1.05);
  }
  @import url('https://fonts.googleapis.com/css?family=Roboto:400,500,700');
  * {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  body {
    font-family: 'Roboto', sans-serif;
  }
  a {
    text-decoration: none;
  }
  .product-card {
    width: 320px;
    position: relative;
    box-shadow: 0 2px 7px #dfdfdf;
    margin: 20px;
    background: #fafafa;
  }
  .badge {
    position: absolute;
    left: 0;
    top: 20px;
    text-transform: uppercase;
    font-size: 13px;
    font-weight: 700;
    background: red;
    color: #fff;
    padding: 3px 10px;
  }
  .product-tumb {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 300px;
    padding: 0;
    background: #f0f0f0;
  }
  .product-tumb img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
  }
  .product-details {
    padding: 30px;
  }
  .product-catagory {
    display: block;
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #ccc;
    margin-bottom: 18px;
  }
  .product-details h4 a {
    font-weight: 500;
    display: block;
    margin-bottom: 18px;
    text-transform: uppercase;
    color: #363636;
    text-decoration: none;
    transition: 0.3s;
  }
  .product-details h4 a:hover {
    color: #fbb72c;
  }
  .product-details p {
    font-size: 15px;
    line-height: 22px;
    margin-bottom: 18px;
    color: #999;
  }
  .product-bottom-details {
    overflow: hidden;
    border-top: 1px solid #eee;
    padding-top: 20px;
  }
  .product-bottom-details div {
    float: left;
    width: 50%;
  }
  .product-price {
    font-size: 18px;
    color: #fbb72c;
    font-weight: 600;
  }
  .product-price small {
    font-size: 80%;
    font-weight: 400;
    text-decoration: line-through;
    display: inline-block;
    margin-right: 5px;
  }
  .product-links {
    text-align: right;
  }
  .product-links a {
    display: inline-block;
    margin-left: 5px;
    color: #e1e1e1;
    transition: 0.3s;
    font-size: 17px;
  }
  .product-links a:hover {
    color: #fbb72c;
  }
  h4 {
    font-size: 14px;
  }
  .products {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    margin: 50px 0;
  }
  .footer {
    background-color: gray;
    position: static;
    bottom: 0;
    left: 0;
    width: 100%;
  }
  .footer p {
    padding: 10px;
    margin: 0;
    text-align: center;
  }
  about-section {
      padding: 60px 20px;
      text-align: center;
      background-color: #f9f9f9;
    }

    .about-section h1 {
      font-size: 2.5em;
      margin-bottom: 20px;
      color: #333;
    }

    .about-section p {
      font-size: 1.1em;
      margin-bottom: 20px;
      color: #555;
    }

    .mission, .vision, .values {
      margin: 40px 0;
    }

    .mission h2, .vision h2, .values h2 {
      font-size: 2em;
      margin-bottom: 15px;
      color: #333;
    }

    .mission p, .vision p, .values p, .values ul {
      font-size: 1.1em;
      color: #555;
    }

    .values ul {
      list-style: none;
      padding: 0;
    }

    .values ul li {
      margin-bottom: 10px;
    }

    .team {
      margin-top: 40px;
      display: flex;
      justify-content: center;
      flex-wrap: wrap;
    }

    .team-member {
      margin: 20px;
      text-align: center;
    }

    .team-member img {
      border-radius: 50%;
      width: 150px;
      height: 150px;
      object-fit: cover;
    }

    .team-member h3 {
      margin-top: 15px;
      font-size: 1.2em;
      color: #333;
    }

    .team-member p {
      font-size: 1em;
      color: #777;
    }

    footer {
      background-color: #333;
      color: #fff;
      padding: 20px 0;
    }

    footer p {
      margin: 0;
    }
</style>
<body class="blur-background">
<div style="position: sticky; top: 0px; left: 0px; overflow: ; background-color: red;">

</div>
<div class="topnav2" style="padding-bottom: 0px;padding-top: 0px;">
  <a href="index.php" style="text-decoration:none;">
    <p class="dimelogo2" name="dimelogo" style="font-family: arial black;padding-bottom: 0px;padding-top: 0px;">DIME FOOTWEAR</p>
  </a>
  <a href="#home" style="text-decoration:none;">NEW ARRIVALS</a>
  <a href="lifestyle-classification.php" style="text-decoration:none;">LIFESTYLE</a>
  <a href="sports-classification.php" style="text-decoration:none;">SPORTS</a>
  <a href="about-us.php" style="text-decoration:none;">CONTACT US</a>

  <div class="search-container">
    <form action="search-product.php">
      <input type="text" placeholder="Search.." name="search">
      <button type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
        </svg>
      </button>
    </form>
     <button class="btn cart" type="button" onclick="redirectToCart()">
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
        <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
      </svg>
    </button>
    <button class="dropdown-btn hamburger" onclick="toggleSidebar()">
     <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
</svg>
    </button>
  </div>
</div>

<!-- Sidebar -->
<div id="sidebar" class="sidebar" >
    
    <!-- "X" button container -->
    <div class="close-btn-container" style="">
        <button class="close-btn" onclick="closeSidebar()">
            <span aria-hidden="true" style="color: black;">&times;</span>
        </button>
    </div>
    <!-- Sidebar content -->
    <div class="sidebar-content" >
        <a href="myAccount.php">
            <i class="fas fa-user"></i> <!-- User icon -->
            My Account
        </a>
        
        <a data-toggle="modal" data-target="#registrationSuccessModal" href="">
            <i class="fas fa-sign-out-alt"></i> <!-- Sign-out icon -->
            Log Out
        </a>
    </div>
</div>
<div id="brandCarousel" class="carousel slide" data-bs-ride="carousel" style="background-color: lightgray; padding: 20px;">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="nike-index.php">
              <img src="img/nike.png" class="card-img-top" alt="Brand 1" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="under-armour-index.php">
              <img src="img/Under_armour_logo.svg.png" class="card-img-top" alt="Brand 2" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="adidas-index.php">
              <img src="img/Adidas_logo.png" class="card-img-top" alt="Brand 3" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
      <div class="row">
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="anta-index.php">
              <img src="img/Anta_logo.svg.png" class="card-img-top" alt="Brand 4" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="puma-index.php">
              <img src="img/Puma-logo.png" class="card-img-top" alt="Brand 5" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mb-3">
            <a href="jordan-index.php">
              <img src="img/98e5a4811e32177795897d60231a016f.jpg" class="card-img-top" alt="Brand 6" style="object-fit: contain; height: 150px;">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

 <a class="carousel-control-prev" href="#brandCarousel" role="button" data-slide="prev" onclick="prevCarousel()" style="width: 50px;height: 50px; margin-top: 75px;">
   <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
  <path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg>
    <span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#brandCarousel" role="button" data-slide="next" onclick="nextCarousel()" style="width: 50px;height: 50px; margin-top: 75px;">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right-fill" viewBox="0 0 16 16">
  <path d="m12.14 8.753-5.482 4.796c-.646.566-1.658.106-1.658-.753V3.204a1 1 0 0 1 1.659-.753l5.48 4.796a1 1 0 0 1 0 1.506z"/>
</svg>
    <span class="sr-only">Next</span>
</a>

</div>
</center>
<main style="background-color: ghostwhite; padding-bottom: 50px; margin-right: 20px; margin-left: 20px; margin-top: 30px;">
  <br>
  <center>
  <div style="background-color:darkgrey; margin-top: 0px; margin-right: 35px; margin-left: 35px; padding-bottom: 5px; padding-top: 5px; ">
  <h2 align="center" style=" margin-bottom: 0px; font-family: arial;font-weight: bold;">CONTACT US</h2>
  </div>
  <div class="products" style="margin: 50px;" >
<main>
  <div class="about-section">
    <!-- <h1>CONTACT US</h1> -->
    <p>
      <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
  <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
      </svg>
      +6309951745475
    </p>
    <p>
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
      <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
      <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
    </svg>
      dimefootwear@gmail.com
    </p>
  </div>
  <div class="about-section">
    <h1>About Dime Footwear</h1>
    <p>Welcome to Dime Footwear, your number one source for the latest in footwear fashion.<br> We're dedicated to giving you the very best of shoes, with a focus on quality, customer service, and uniqueness.</p>
    
    
    
     <div >
      <h2>Meet Our Team</h2>
      </div>
    <div class="team">
     
      <div class="team-member">
        <img src="img/90928a53a423035f4af61e56710b6e1a.jpg" alt="Team Member 1">
        <h3>PAUL DANCILA</h3>
        <p>Founder & CEO</p>
      </div>
      <div class="team-member">
        <img src="img/Empoy-Marquez.jpg" alt="Team Member 2">
        <h3>LUCKY JAME BUDLAO</h3>
        <p>WEB DESIGNER</p>
      </div>
      <div class="team-member">
        <img src="img/20240517_090231.png" alt="Team Member 3">
        <h3>VALENTINO BABATE</h3>
        <p>RESEARCHER</p>
      </div>
    </div>
  </div>
  </center>
</main>   

  </div>
</main>

<div class="modal fade" id="registrationSuccessModal" tabindex="-1" role="dialog" aria-labelledby="registrationSuccessModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="registrationSuccessModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Do you want to Log Out?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="redirectToLogin()">YES</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="index.js"></script>
<script>
    function redirectToCart() {
    window.location.href = 'myCart.php';
  }
function redirectToLogin() {
  window.location.href = 'log_out.php';
}
function toggleSidebar() {
  var sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('active');
}

function closeSidebar() {
  var sidebar = document.getElementById('sidebar');
  sidebar.classList.remove('active');
}
function handleCarouselControls(direction) {
  var carousel = document.getElementById('brandCarousel');
  var carouselInstance = bootstrap.Carousel.getInstance(carousel);

  if (direction === 'prev') {
    carouselInstance.prev();
  } else if (direction === 'next') {
    carouselInstance.next();
  }
}

 function handleCarouselControls(direction) {
    var carousel = document.getElementById('brandCarousel');
    var carouselInstance = bootstrap.Carousel.getInstance(carousel);

    if (direction === 'prev') {
      carouselInstance.prev();
    } else if (direction === 'next') {
      carouselInstance.next();
    }
  }

  // Event listeners for the carousel controls
  document.querySelector('.carousel-control-prev').addEventListener('click', function() {
    handleCarouselControls('prev');
  });

  document.querySelector('.carousel-control-next').addEventListener('click', function() {
    handleCarouselControls('next');
  });

  // Function to trigger next slide
  function nextCarousel() {
    handleCarouselControls('next');
  }

  // Function to trigger previous slide
  function prevCarousel() {
    handleCarouselControls('prev');
  }
</script>
<div class="footer" style="background-color: gray; position: ; bottom: 0px; left: 0px; width: 100%;">
<footer align="center">
    <p style="padding-top:10px;padding-left:10px; margin: 0px ; padding-bottom: 15px; padding-top: 15px; margin-top:10px;"> &#169 Disclaimer for School Purposes</p>
</footer>
</div>
</body>
</html>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
