<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Responsive Food Website Design Tutorial</title>

    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

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
        </nav>

        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
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

                $sql = "SELECT * FROM ebook LIMIT 3";
                $query = mysqli_query($connect, $sql);

                while ($row = mysqli_fetch_assoc($query)) {

                    $ebook_nama = strtolower($row['ebook_nama']);
                    $ebook_nama = ucwords($ebook_nama);
                    $image = $row['ebook_gambar'];
                }
                ?>
                <div class="swiper-slide slide">
                    <div class="content">
                        <span>buku teristemewa kami</span>
                        <h3><?= $ebook_nama ?></h3>
                        <p>Dapatkan dan baca buku istemewa dari kami <?= $ebook_nama ?></p>
                        <a href="<?= $row['ebook_link'] ?>" class="btn">baca sekarang</a>
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