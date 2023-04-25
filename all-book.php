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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        #dishes {
            margin-top: 50px;
        }

        .box {
            height: 300px;
        }

        .box .btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }

        .page-container {
            margin-top: 40px;
            margin-bottom: 50px;
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
    <?php
session_start();
if(isset($_SESSION['user_id'])) {
  $ebook_link = isset($_SESSION['ebook_link']) ? $_SESSION['ebook_link'] : null;
}
?>
        <a href="index.php" class="logo">ebook.</a>

        <nav class="navbar">
            <a href="index.php">home</a>
            <a class="active" href="#dishes">all books</a>
        </nav>

    </header>

    <!-- header section ends-->


    <!-- books section starts  -->

    <section class="dishes" id="dishes">

    <div class="box-container">
    <?php
    include './model/db-connect.php';

    $item_per_page = 10;

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }

    $start = ($page - 1) * $item_per_page;

    $sql = "SELECT * FROM ebook LIMIT $start, $item_per_page";
    $query = mysqli_query($connect, $sql);

    while ($row = mysqli_fetch_assoc($query)) {

        $ebook_nama = strtolower($row['ebook_nama']);
        $ebook_nama = ucwords($ebook_nama);
    ?>
        <div class="box">
            <a href="#" class="fas fa-heart"></a>
            <a href="view-book.php?id=<?= $row['ebook_id'] ?>" class="fas fa-eye"></a>
            <a href="view-book.php?id=<?= $row['ebook_id'] ?>"><img src="data:image;base64,<?php echo base64_encode($row['ebook_gambar']) ?>" alt="<?= $ebook_nama ?>"></a>
            <?php
            if (isset($_SESSION['user_id'])) {
                // user is signed in, display "Baca Sekarang" button with ebook link
                echo '<a href="' . $row['ebook_link'] . '" class="btn">Baca Sekarang</a>';
            } else {
                // user is not signed in, display "Baca Sekarang" button with sign-in link
                echo '<a href="signin.php?ebook_id=' . $row['ebook_id'] . '" class="btn">Baca Sekarang</a>';
            }
            ?>
        </div>
    <?php
    }
    ?>
</div>


        <?php
        $sql = "SELECT * FROM ebook";
        $query = mysqli_query($connect, $sql);

        $total_items = mysqli_num_rows($query);

        $total_pages = ceil($total_items / $item_per_page);
        ?>
        <div class="page-container">
            <?php
            if ($page > 1) {
            ?>
                <a class="btn" href="all-book.php?page=<?= ($page - 1) ?>"><i class="tf-icon bx bx-chevron-left"></i></a>
            <?php
            }
            for ($i = 1; $i <= $total_pages; $i++) {
            ?>
                <a href="all-book.php?page=<?= $i ?>" class="btn"><?= $i ?></a>
            <?php
            }
            if ($page < $total_pages) {
            ?>
                <a class="btn" href="all-book.php?page=<?= ($page + 1) ?>"><i class="tf-icon bx bx-chevron-right"></i></a>
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