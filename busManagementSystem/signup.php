<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
     <form action="signup-check.php" method="post">
     	<h2>SIGN UP</h2>
     	<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>

          <?php if (isset($_GET['success'])) { ?>
               <p class="success"><?php echo $_GET['success']; ?></p>
          <?php } ?>

          <label>First Name</label>
               <input type="text" 
                      name="firstName" 
                      placeholder="First Name">

          <label>Last Name</label>
               <input type="text" 
                      name="lastName" 
                      placeholder="Last Name">
          
          <label>Date Of Birth</label>
               <input type="date" 
                      name="DOB" 
                      placeholder="Date Of Birth"
                      max="<?php echo date("Y-m-d");?>"><br>

          <label>Phone Number</label>
               <input type="tel" 
                      name="phoneNb"
                      pattern="[0-9]{8}"
                      placeholder="Phone Number"><br>

          <label>Email</label>
               <input type="text" 
                      name="email" 
                      placeholder="Email"><br>

     	<label>Password</label>
     	<input type="password" 
                 name="password" 
                 placeholder="Password"><br>

          <label>Re Password</label>
          <input type="password" 
                 name="re_password" 
                 placeholder="Re_Password"><br>

     	<button type="submit">Sign Up</button>
          <a href="index.php" class="ca">Already have an account?</a>
     </form>
</body>
</html>