<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome Icons  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
        integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
        crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/f89d107cc5.js" crossorigin="anonymous"></script>

    <!-- Google Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <title>Forgot Password</title>

     <!-- PHP CONNECTION FILE -->
	 <?php include 'connect.php' ?>

      <style>
        @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
html,body{
  display: grid;
  height: 100%;
  width: 100%;
  place-items: center;
  background: #f2f2f2;
  /* background: linear-gradient(-135deg, #c850c0, #4158d0); */
}
::selection{
  background: #4158d0;
  color: #fff;
}
.wrapper{
  width: 380px;
  background: #fff;
  border-radius: 15px;
  box-shadow: 0px 15px 20px rgba(0,0,0,0.1);
}
.wrapper .title{
  font-size: 35px;
  font-weight: 600;
  text-align: center;
  line-height: 100px;
  color: #fff;
  user-select: none;
  border-radius: 15px 15px 0 0;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
}
.wrapper form{
  padding: 10px 30px 50px 30px;
}
.wrapper form .field{
  height: 50px;
  width: 100%;
  margin-top: 20px;
  position: relative;
}
.wrapper form .field input{
  height: 100%;
  width: 100%;
  outline: none;
  font-size: 17px;
  padding-left: 20px;
  border: 1px solid lightgrey;
  border-radius: 25px;
  transition: all 0.3s ease;
}
.wrapper form .field input:focus,
form .field input:valid{
  border-color: #4158d0;
}
.wrapper form .field label{
  position: absolute;
  top: 50%;
  left: 20px;
  color: #999999;
  font-weight: 400;
  font-size: 17px;
  pointer-events: none;
  transform: translateY(-50%);
  transition: all 0.3s ease;
}
form .field input:focus ~ label,
form .field input:valid ~ label{
  top: 0%;
  font-size: 16px;
  color: #4158d0;
  background: #fff;
  transform: translateY(-50%);
}
form .content{
  display: flex;
  width: 100%;
  height: 50px;
  font-size: 16px;
  align-items: center;
  justify-content: space-around;
}
form .content .checkbox{
  display: flex;
  align-items: center;
  justify-content: center;
}
form .content input{
  width: 15px;
  height: 15px;
  background: red;
}
form .content label{
  color: #262626;
  user-select: none;
  padding-left: 5px;
}
form .content .pass-link{
  color: "";
}
form .field input[type="submit"]{
  color: #fff;
  border: none;
  padding-left: 0;
  margin-top: -10px;
  font-size: 20px;
  font-weight: 500;
  cursor: pointer;
  background: linear-gradient(-135deg, #c850c0, #4158d0);
  transition: all 0.3s ease;
}
form .field input[type="submit"]:active{
  transform: scale(0.95);
}
form .signup-link{
  color: #262626;
  margin-top: 20px;
  text-align: center;
}
form .pass-link a,
form .signup-link a{
  color: #4158d0;
  text-decoration: none;
}
form .pass-link a:hover,
form .signup-link a:hover{
  text-decoration: underline;
}
        </style>
   </head>

   <?php

if(isset($_POST['submit']))
{
    $email = $_POST['memail'];

    $email_search = "SELECT * FROM user WHERE email = '$email'";
    $query = mysqli_query($conn, $email_search);
    $count = mysqli_num_rows($query);
    if($count == 1)
    {
        // Generate a random password
        $newPassword = substr(uniqid(mt_rand(), true), 0, 8); // Generate an 8-character random password

        // Encrypt the new password with MD5
        $hashedPassword = ($newPassword);

        // Update the password in the database
        $sql = "UPDATE user SET password = '$hashedPassword', cpassword = '$hashedPassword' WHERE email = '$email'";

        // Check if the password update was successful
        if(mysqli_query($conn, $sql))
        {
            ?>
            <script>
                alert("Successfull");
            </script>
            <?php
        }
        else
        {
            ?>
            <script>
                alert("Failed");
            </script>
            <?php
        }
        ?>
        <script>
            var variableData = "<?php echo $newPassword; ?>";
            alert(variableData);
            window.location.href = "change.php";
        </script>
        <?php
    }
    else
    {
        ?>
        <script>
            alert("Inavlid Email-ID")
        </script>
        <?php
    }
}
?>


   <body>
      <div class="wrapper">
         <div class="title">
            Forgot Password
         </div>
         <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="field">
               <input type="text" name = "memail" required>
               <label>Email Address</label>
            </div>
            <div class="field">
            </div>
            
            <div class="field">
               <input type="submit" name = "submit" value="Submit">
            </div>
         </form>
      </div>
   </body>
</html>