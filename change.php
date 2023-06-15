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

    <title>Change Password</title>

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
if(isset($_POST['login']))
{
  // Get User Input from Form
  $email = $_POST['nemail'];
  $oldPassword = $_POST['opassword']; 
  $newPassword = $_POST['npassword']; 
  $confirmPassword = $_POST['cpassword']; 

  // Check Old Password against what's stored in DB
  $sql = "SELECT * FROM user WHERE email = '$email' AND password = '$oldPassword'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $count = mysqli_num_rows($result);

  // If Old Password is correct
  if($count == 1)
  {
    // Check if New Password and Confirm Password match
    if($newPassword == $confirmPassword)
    {
        // Update Password in DB 
       $sql = "UPDATE user SET password = '$newPassword' WHERE email = '$email'";

       $result = mysqli_query($conn, $sql);

       // Check Result of Query
       if ($result) 
       {
        ?>
		<script>
			alert("Password Changed Successfully.");
			window.location.href = "success.php";
		</script>
		<?php
       }
       else 
       {
        ?>
		<script>
			alert("The two passwords do not match.");
		</script>
		<?php
       }
    }
    else
    {
        ?>
		<script>
			alert("Error Occured.");
		</script>
		<?php
    }
}
else
{
    ?>
	<script>
		alert("Your old password do not Match with our records.");
	</script>
	<?php
}
}
?>

   <body>
      <div class="wrapper">
         <div class="title">
            Change Password
         </div>
         <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="field">
               <input type="text" name = "nemail" required>
               <label>Email Address</label>
            </div>
            <div class="field">
               <input type="password" name = "opassword" required>
               <label>Old Password</label>
            </div>
            <div class="field">
               <input type="password" name = "npassword" required>
               <label>New Password</label>
            </div>
            <div class="field">
               <input type="password" name = "cpassword" required>
               <label>Confirm Password</label>
            </div>
            <div class="field">
               <input type="submit" name = "login" value="Login">
            </div>
         </form>
      </div>
   </body>
</html>