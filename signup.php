<!DOCTYPE html>
<html>
  <head>
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
        top: 30%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        width: 500px;
        height: 500px;
      }

      .form-popup form label {
        display: block;
        margin-bottom: 10px;
        font-size: 16px;
      }

      .form-popup form input[type="text"],
      .form-popup form input[type="phone"],
      .form-popup form input[type="password"],
      .form-popup form select {
        display: block;
        margin-bottom: 20px;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #ccc;
      }

      .form-popup form button[type="submit"] {
        background-color: #192a56;
        color: #fff;
        border: none;
        padding: 15px;
        border-radius: 5px;
        font-size: 15px;
        cursor: pointer;
        display: block;
        margin: auto;
      }

      .form-popup form button:hover {
        background: #27ae60;
      }

      h2 {
        text-align: center;
        color: #27ae60;
        font-size: 20px;
      }
      .form-select {
        height: 40px;
      }

      .close-btn {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 24px;
        font-weight: bold;
        color: #aaa;
        cursor: pointer;
      }
    </style>

  </head>

  <?php
include('./model/db-connect.php');

if(isset($_POST['signup-btn'])) {
  // Get the user data from the form
  $name = $_POST['name'];
  $password = $_POST['password'];
  $phone = $_POST['phone'];
  $method = $_POST['method'];

  // Insert the user data into the database
  $stmt = mysqli_prepare($connect, "INSERT INTO form (name, password, phone, method) VALUES (?, ?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "ssss", $name, $password, $phone, $method);
  mysqli_stmt_execute($stmt);

  // Redirect to the login page
  // header("Location: signin.php");
  // exit();
 
$_SESSION['signup-btn'] = true;
}
?>



<body>
  <div id="signup-form-popup" class="form-popup">
    <form method="post">
      <h2>Sign Up</h2><br><br>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      <label for="phone">Phone Number:</label>
      <input type="phone" id="phone" name="phone" required>
      <label for="method" class="form-label">Where did you hear about us?</label>
      <select class="form-select" id="method" name="method" required>
        <option value="" disabled selected>Select an option</option>
        <option value="Media">Media</option>
        <option value="Contact">Contact</option>
      </select>
      <button type="submit" name="signup-btn">Sign Up</button>
      <span class="close-btn" onclick="document.getElementById('signup-form-popup').classList.remove('show')">&times;</span>
    </form>
  </div>

</body>

</html>




