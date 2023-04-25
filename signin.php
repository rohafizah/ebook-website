<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

   <!---Custom CSS File--->
   <link rel="stylesheet" href="style.css">

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


 <style>
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body{
  min-height: 100vh;
  width: 100%;
  background: #EAEDED;
}
.container{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
  max-width: 430px;
  width: 100%;
  background: #fff;
  border-radius: 7px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.3);
}
.container .registration{
  display: none;
}
#check:checked ~ .registration{
  display: block;
}
#check:checked ~ .login{
  display: none;
}
#check{
  display: none;
}
.container .form{
  padding: 2rem;
}
.form header{
  font-size: 2rem;
  font-weight: 500;
  text-align: center;
  margin-bottom: 1.5rem;
  color:#192a56;
}
 .form input{
   height: 60px;
   width: 100%;
   padding: 0 15px;
   font-size: 17px;
   margin-bottom: 1.3rem;
   border: 1px solid #ddd;
   border-radius: 6px;
   outline: none;
 }
 .form input:focus{
   box-shadow: 0 1px 0 rgba(0,0,0,0.2);
 }
.form a{
  font-size: 16px;
  color: #009579;
  text-decoration: none;
}
.form a:hover{
  text-decoration: underline;
}
.form input.button{
  color: #fff;
  background: #192a56;
  font-size: 1.2rem;
  font-weight: 500;
  letter-spacing: 1px;
  margin-top: 1rem;
  cursor: pointer;
  transition: 0.4s;
  padding: 0.25rem 0.5rem;
}
.form input.button:hover{
  background: #27ae60;
}
.signup{
  font-size: 17px;
  text-align: center;
}
.signup label{
  color: #27ae60;
  cursor: pointer;
}
.signup label:hover{
  text-decoration: underline;
}
 </style>

<?php 

session_start();
ob_start();
include('signup.php');
include('./model/db-connect.php');



if(isset($_POST['login-btn'])) {
  // Get the username and password from the form
  $username = $_POST['name'];
  $password = $_POST['password'];

  // Check if the username and password are valid
  $stmt = mysqli_prepare($connect, "SELECT * FROM form WHERE name = ? AND password = ?");
  mysqli_stmt_bind_param($stmt, "ss", $username, $password);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);

  if($row = mysqli_fetch_assoc($result)) {
    // Set session variables for the authenticated user
    $_SESSION['user_id'] = $row['id'];
    $_SESSION['user_name'] = $row['name'];

    $ebook_id = isset($_GET['ebook_id']) ? $_GET['ebook_id'] : null;

if ($ebook_id != null) {
    // If the ebook ID is found, get the ebook link and redirect to it
    $stmt = mysqli_prepare($connect, "SELECT * FROM ebook WHERE ebook_id = ?");
    mysqli_stmt_bind_param($stmt, "i", $ebook_id);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    if ($row != null) {
        $link = $row['ebook_link'];
        header("Location: $link");
        exit();
    } else {
        // Display an error message if the ebook link is not found
        $error = "Ebook link not found.";
        header("Location: signin.php?error=$error");
        exit();
    }
} else {
    // Redirect to the homepage
    header("Location: index.php");
    exit();
}
  }
}

?>



<div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
        <header>Sign In</header>
        <form id="login-form" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name"name="name" placeholder="Enter your name">
            <label for="name">Password:</label>
            <input type="password" id="password" name="password" placeholder="Enter your password">
            <input type="submit" id="login-btn" class="button" name="login-btn" value="Login" style="margin: 0.5px;">
            <input type="button" class="button" value="Back" onclick="goBack()">
        </form>
        <div class="signup">
            <span class="signup">Don't have an account?
            <a href="#" class="signup-label" onclick="showSignupForm()">Sign up</a>     
          </span>
        </div>
    </div>
</div>

<script>
// Function to go back to the previous page
function goBack() {
  window.history.back();
} 
// Function to show the signup form
function showSignupForm() {
}
// Function to validate the signup form
function validateSignupForm() {

}
</script>

</body>

</html>


<script>
function showSignupForm() {
  document.getElementById("signup-form-popup").classList.add("show");
}

function goBack() {
  window.history.back();
}

ob_end_flush();
</script>

</body>
</html>