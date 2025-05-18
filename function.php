<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blog_bollywood2";

// creat connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
} 
else {

}

if(isset($_POST['btn_login'])) {
   $data_email = $_POST['email'];
   $data_password = $_POST['password'];

   $sql = "SELECT email, password FROM penulis WHERE email = '$data_email' AND password = '$data_password'";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
         $_SESSION["email"] = $data_email;
         $_SESSION["password"] = $data_password;
         header('location:index.php');
      }
   } else {
      echo "0 results";
   }
   
}
?>