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

    <style>
        .form-popup {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    z-index: 9999;
}

.show {
    display: block;
}

.form-popup form {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width: 500px;
    height: 400px;
}
.form-popup form label {
  display:block;
  margin-bottom: 10px;
  font-size: 16px;
}
.form-popup form input[type="text"],
.form-popup form input[type="password"] {
  display: block;
  margin-bottom: 20px;
  width: 100%;
  padding: 10px;
  border-radius: 5px;
  border: 1px solid #ccc;
}
.form-popup form button[type="submit"] {
  background-color:  #192a56;
  color: #fff;
  border: none;
  padding: 10px;
  border-radius: 5px;
  cursor: pointer;
  display: block;
  margin: auto;
}
.form-popup form button:hover{
  background: #27ae60;
}
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

    <!-- header section starts      -->

    <header>
        <a href="#" class="logo">ebook.</a>

        <nav class="navbar">
            <a class="active" href="#home">home</a>
            <a href="all-book.php">all books</a>
            <a href="#" class="signup-btn">Sign in</a>
        </nav>

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

                <?php
                include './model/db-connect.php';

                $sql = "SELECT * FROM ebook WHERE ebook_id = 1";
                $query = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($query)) {

                    $ebook_nama = strtolower($row['ebook_nama']);
                    $ebook_nama = ucwords($ebook_nama);
                    $image = $row['ebook_gambar'];
                }
                ?>

                <div class="swiper-slide slide">
                    <div class="content">
                        <span>buku teristimewa kami</span>
                        <h3><?= $ebook_nama ?></h3>
                        <p>Dapatkan dan baca buku istimewa dari kami <?= $ebook_nama ?></p>
                        <a href="signin.php"class="btn">baca sekarang</a>

               
                    
                    </div>
                    <div class="image">
                        <img src="data:image;base64,<?php echo base64_encode($image) ?>" alt="<?= $ebook_nama ?>">
                    </div>
                </div>
            </div>
        </div>

    <div id="signup-form" class="form-popup">
    <form action="#">
    <h2>Sign In</h2>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Sign In</button>
    </form>
    </div>

    <script>
        const signupBtn = document.querySelector(".signup-btn");
const signupForm = document.querySelector("#signup-form");

signupBtn.addEventListener("click", function() {
    signupForm.classList.toggle("show");
});

        </script>


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