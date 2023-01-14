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

    <style>
        #dishes {
            margin-top: 50px;
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

    <!-- loader part  -->
    <div class="loader">
        <img src="images/book.gif" alt="">
    </div>
    <!-- loader part  -->

    <!-- header section starts      -->

    <header>

        <a href="index.php" class="logo">ebook.</a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a class="active" href="#dishes">all books</a>
        </nav>

        <div class="icons">
            <i class="fas fa-bars" id="menu-bars"></i>
        </div>
        
    </header>

    <!-- header section ends-->


    <!-- books section starts  -->

    <section class="dishes" id="dishes">

        <div class="box-container">
            <?php
            include './model/db-connect.php';

            $sql = "SELECT * FROM ebook";
            $query = mysqli_query($connect, $sql);

            while ($row = mysqli_fetch_assoc($query)) {

                $ebook_nama = strtolower($row['ebook_nama']);
                $ebook_nama = ucwords($ebook_nama);
            ?>
                <div class="box">
                    <!-- <a href="#" class="fas fa-heart"></a> -->
                    <a href="view-book.php?id=<?= $row['ebook_id'] ?>" class="fas fa-eye"></a>
                    <a href="view-book.php?id=<?= $row['ebook_id'] ?>">
                        <img src="data:image;base64,<?php echo base64_encode($row['ebook_gambar']) ?>" alt="<?= $ebook_nama ?>">
                    </a>
                    <h3><?= $ebook_nama ?></h3>
                    <a href="<?= $row['ebook_link'] ?>" class="btn">baca sekarang</a>
                </div>
            <?php
            }
            ?>
        </div>

    </section>

    <!-- dishes section ends -->


    <!-- footer section starts  -->

    <section class="footer">
        <div class="credit"> copyright @ 2023 by <span>Murtadha Dakwah Centre (MADAD)</span> </div>
    </section>

    <!-- footer section ends -->

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- custom js file link  -->
    <script src="js/script.js"></script>

</body>

</html>