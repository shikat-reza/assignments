<?php 
	// Define variables and set to empty values
	$first_nameErr = $last_nameErr = $emailErr = $passwordErr = $confirm_passwordErr = "";
	$first_name = $last_name = $email = $password = $confirm_password = "";

	// Check if the form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  if (empty($_POST["first_name"])) {
	    $first_nameErr = "First Name is required";
	  } else {
	    $first_name = test_input($_POST["first_name"]);
	  }

	  if (empty($_POST["last_name"])) {
	    $last_nameErr = "Last Name is required";
	  } else {
	    $last_name = test_input($_POST["last_name"]);
	  }

	  if (empty($_POST["email"])) {
	    $emailErr = "Email is required";
	  } else {
	    $email = test_input($_POST["email"]);
	    // check if e-mail address is well-formed
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      $emailErr = "Invalid email format";
	    }
	  }

	  if (empty($_POST["password"])) {
	    $passwordErr = "Password is required";
	  } else {
	    $password = test_input($_POST["password"]);
	  }

	  if (empty($_POST["confirm_password"])) {
	    $confirm_passwordErr = "Confirm Password is required";
	  } else {
	    $confirm_password = test_input($_POST["confirm_password"]);
	    if($password !== $confirm_password){
	    	$confirm_passwordErr = "Passwords do not match";
	    }
	  }
	}

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}


    if(isset($_POST['submit'])){
		if($first_nameErr == "" && $last_nameErr == "" && $emailErr == "" && $passwordErr == "" && $confirm_passwordErr == ""){
			echo "<h2>Thank you for registering!</h2>";
			echo "<p>Your First Name: " . $first_name . "</p>";
			echo "<p>Your Last Name: " . $last_name . "</p>";
			echo "<p>Your Email: " . $email . "</p>";
		}
	}
?>