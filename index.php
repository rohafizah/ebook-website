<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MADAD Ebook Website</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

        
        </style>

    <script> 
    
        window.addEventListener("load", () => {
            const loader = document.querySelector(".loader");

            loader.classList.add("loader--hidden");

            loader.addEventListener("transitionend", () => {
                document.body.removeChild(loader);
            });
        });
    </script>
</head>

<body>

    
<?php include('signup.php');?>
<?php
session_start();
if (isset($_GET['logout'])) {
  // Unset session variables and destroy the session
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit();
}
?>

<!-- header section starts -->
<header>
    <a href="#" class="logo">ebook.</a>

    <nav class="navbar">
  <a class="active" href="#home">home</a>
  <a href="all-book.php">all books</a>
  <?php
  if (isset($_SESSION['user_id'])) {
    // User is logged in, show "Log out" button
    echo '<a href="index.php?logout=true" class="signup-btn">Log out</a>';
  } else {
    // User is not logged in, show "Sign up" button
    echo '<a href="#" class="signup-btn" onclick="toggleSignupForm()">Sign up</a>';
  }
  ?>
</nav>
    

    <script>
   function toggleSignupForm() {
            const signupBtn = document.querySelector(".signup-btn");
            const signupPopup = document.getElementById("signup-form-popup");
            if (signupBtn.textContent === "Sign up") {
                // change text to "Log out"
                signupBtn.textContent = "Log out";
                // remove sign up event listener
                signupBtn.removeEventListener("click", toggleSignupForm);
                // add logout event listener
                signupBtn.addEventListener("click", logOut);
            }
            // show or hide sign up form popup
            signupPopup.classList.toggle("show");
        }

        function logOut() {
            // unset session variable
            <?php unset($_SESSION['signed_up']); ?>
            // redirect to index.php
            window.location.href = "index.php";
        }
</script>



        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
            <!-- <i class="fas fa-search" id="search-icon"></i>
            <a href="#" class="fas fa-heart"></a>
            <a href="#" class="fas fa-shopping-cart"></a> -->
        </div>

    </header>

    <!-- header section ends-->

    <!-- search form  -->

    <form action="" id="search-form">
        <input type="search" placeholder="search here..." name="" id="search-box">
        <label for="search-box" class="fas fa-search"></label>
        <i class="fas fa-times" id="close"></i>
    </form>

    <!-- home section starts  -->

    <section class="home" id="home">

        <div class="swiper-container home-slider">

            <div class="swiper-wrapper wrapper">

                <!-- <?php
                // include './model/db-connect.php';

                // $sql = "SELECT * FROM ebook WHERE ebook_id = 1";
                // $query = mysqli_query($connect, $sql);

                // while ($row = mysqli_fetch_assoc($query)) {

                //     $ebook_nama = strtolower($row['ebook_nama']);
                //     $ebook_nama = ucwords($ebook_nama);
                //     $image = $row['ebook_gambar'];
                // }
                ?> -->
   
   <?php
include './model/db-connect.php';

$sql = "SELECT * FROM ebook WHERE ebook_id = 1";
$query = mysqli_query($connect, $sql);

while ($row = mysqli_fetch_assoc($query)) {

    $ebook_nama = strtolower($row['ebook_nama']);
    $ebook_nama = ucwords($ebook_nama);
    $image = $row['ebook_gambar'];
    $ebook_link = $row['ebook_link'];
}
?>

<div class="swiper-slide slide">
  <div class="content">
    <span>buku teristimewa kami</span>
    <h3><?= $ebook_nama ?></h3>
    <p>Dapatkan dan baca buku istimewa dari kami <?= $ebook_nama ?></p>
    <a href="signin.php?ebook_id=1" class="btn">baca sekarang</a>

                   
</div>
  <div class="image">
    <img src="data:image;base64,<?php echo base64_encode($image) ?>" alt="<?= $ebook_nama ?>">
  </div>
</div>

            </div>
        </div>
 
    </section>

    <!-- home section ends -->


    <!-- loader part  -->
    <div class="loader">
        <img src="images/book.gif" alt="">
    </div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>