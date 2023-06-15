<?php
?>
<!DOCTYPE html>
<!-- Coding by CodingLab || www.codinglabweb.com -->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Website with Login & Registration Form</title>
    <link rel="stylesheet" href="style.css" />
    <!-- Unicons -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />

    <!-- PHP CONNECTION FILE -->
	 <?php include 'connect.php' ?>
</head>

<?php

if(isset($_POST['submit']))
{
    $name = mysqli_real_escape_string($conn, $_POST['nname']);
    $address = mysqli_real_escape_string($conn, $_POST['naddress']);
    $email = mysqli_real_escape_string($conn, $_POST['nemail']);
    $mobile = mysqli_real_escape_string($conn, $_POST['nphone']);
    $password = mysqli_real_escape_string($conn, $_POST['npassword']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['ncpassword']);

	// $pass = md5($password);
	// $cpass = md5($password);

    $emailquery = "select * from user where email = '$email'"; 
    $emailquery_run = mysqli_query($conn, $emailquery);

    $emailquery_num = mysqli_num_rows($emailquery_run);
	
    if($emailquery_num > 0)
    {
		?>
		<script>
			alert("Email Already Exists");
		</script>
		<?php
    }
	else 
	{
		if($password === $cpassword)
		{
			$insertquery = "insert into user (name, address, email, number, password, cpassword) values ('$name', '$address','$email', '$mobile', '$password', '$cpassword')";
			$iquery = mysqli_query($conn, $insertquery);
			if($iquery)
            {
				?>
				<script>
					alert("Account Created Successfully");
					window.location.href = "success.php";
				</script>
				<?php
            }
            else
            {
               ?>
			   <script>
				alert("Error Occured");
				</script>
				<?php
            }
		}
		else
		{
			?>
			<script>
				alert("Passwords do not match");
			</script>
			<?php
		}
	}
}
?>

<?php
if(isset($_POST['login'])){
    $email = $_POST['nemail'];
    $password = $_POST['npassword'];

    $email_search="select * from user where email = '$email'";
    $query = mysqli_query($conn,$email_search);

    $email_count = mysqli_num_rows($query);

    if($email_count){
        $pass = mysqli_fetch_assoc($query);

        // $db_pass = $pass['Password'];

        // $pass_decode = password_verify($password,$db_pass);
        if ($password === $pass["password"]) {
        // if($pass_decode){
            ?>
            <script>
                alert("Successful")
            </script>
            <?php
             header("Location: success.php");
        }
        else{
            ?>
    <script>
        alert("invalid password")
    </script>
    <?php
        }
      }
        else{
            ?>
            <script>
                alert("Invalid Email")
            </script>
            <?php
        }
    }

?>

  <body>
    <!-- Header -->
    <header class="header">
      <nav class="nav">
        <a href="#" class="nav_logo">My library</a>
        <div class="logo">
          <img src="logo3.jpg">
        </div>
        

        <ul class="nav_items">
          <li class="nav_item">
            <a href="#" class="nav_link">Home</a>
            <a href="#" class="nav_link">Product</a>
            <a href="#" class="nav_link">Services</a>
            <a href="#" class="nav_link">Contact</a>
          </li>
        </ul>

        <button class="button" id="form-open">Login</button>
      </nav>
    </header>

    <!-- Home -->
    <section class="home">
      <div class="form_container">
        <i class="uil uil-times form_close"></i>
        <!-- Login From -->
        <div class="form login_form">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2>Login</h2>

            <div class="input_box">
              <input type="email" name="nemail"  placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="password" name="npassword" placeholder="Enter your password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <div class="option_field">
              <a href="change.php" class="forgot_pw">change password</a>
              <a href="forgot.php" class="forgot_pw">Forgot password?</a>
            </div>

            <button class="button" type="submit" name="login">Login Now</button>

            <div class="login_signup">Don't have an account? <a href="#" id="signup">Signup</a></div>
          </form>
        </div>

        <!-- Signup From -->
        <div class="form signup_form">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h2>Signup</h2>
            <div class="input_box">
              <input type="name" name="nname" placeholder="Enter your name" required />
              <i class="uil uil-user name"></i>
            </div>
            <div class="input_box">
              <input type="address" name="naddress" placeholder="Enter your address" required />
              <i class="uil uil-home address"></i>
            </div>

            <div class="input_box">
              <input type="email" name="nemail" placeholder="Enter your email" required />
              <i class="uil uil-envelope-alt email"></i>
            </div>
            <div class="input_box">
              <input type="number" name="nphone" placeholder="Enter your number" required />
              <i class="uil uil-phone number"></i>
            </div>
            <div class="input_box">
              <input type="password" name="npassword" placeholder="Create password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>
            <div class="input_box">
              <input type="password" name="ncpassword" placeholder="Confirm password" required />
              <i class="uil uil-lock password"></i>
              <i class="uil uil-eye-slash pw_hide"></i>
            </div>

            <button class="button" type="submit" name="submit">Sign Up</button>

            <div class="login_signup">Already have an account? <a href="#" id="login">Login</a></div>
          </form>
        </div>
      </div>
    </section>

    <script src="script.js"></script>
  </body>
</html>
