<?php
// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Get form data
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$subject = trim($_POST['subject']);
	$message = trim($_POST['message']);

	// Validate form data
	$errors = array();
	if (empty($name)) {
		$errors[] = "Name is required";
	}
	if (empty($email)) {
		$errors[] = "Email is required";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errors[] = "Invalid email format";
	}
	if (empty($subject)) {
		$errors[] = "Subject is required";
	}
	if (empty($message)) {
		$errors[] = "Message is required";
	}

	// If there are errors, display them to the user
	if (!empty($errors)) {
		echo "<div class='error'>";
		foreach ($errors as $error) {
			echo "<p>$error</p>";
		}
		echo "</div>";
	} else {
		// Send email
		$to = "yourname@example.com"; // Change this to your email address
		$subject = "New message from $name: $subject";
		$body = "Name: $name\nEmail: $email\n\n$message";
		$headers = "From: $name <$email>\r\n";
		$headers .= "Reply-To: $email\r\n";

		if (mail($to, $subject, $body, $headers)) {
			// Display success message to the user
			echo "<div class='success'>";
			echo "<p>Thank you for your message. We will get back to you soon!</p>";
			echo "</div>";
		} else {
			// Display error message if email sending fails
			echo "<div class='error'>";
			echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
			echo "</div>";
		}
	}
} else {
	// Redirect user if accessing this page directly
	header("Location: contact.php");
	exit();
}
?>
