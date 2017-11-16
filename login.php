<?php 
session_start();

$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';  

if ( isset($_POST['cancel'])){
header('location:index.php');
return;
}

if ( isset($_POST['email']) && isset($_POST['pass']) ) {
 unset($_SESSION["email"]);
    if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
         $_SESSION["error"] = "User name and password are required";
            header( 'Location: login.php' ) ;
            return;
    } 
     else if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
              $_SESSION["error"] = "Enter proper Email";
            header( 'Location: login.php' ) ;
            return;

}
    else {
        $check = hash('md5', $salt.$_POST['pass']);
        if ( $check == $stored_hash ) {
        	$_SESSION["email"] = $_POST["email"];
            $_SESSION["success"] = "Logged in.";
            header("Location: index.php");
            error_log("Log in success ".$_POST['email']);
            return;
        } else {
             $_SESSION["error"] = "Incorrect password";
            header( 'Location: login.php' ) ;
            error_log("Log in failed ".$_POST['email']);
            return;


        }
    }
}


?>
<!DOCTYPE html>
<html>
<head>
<title>Chinmay Vinchurkar</title>
</head>
<body>

<div class="container">
<h1>Please Log In</h1>

<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
?>
<form method="POST">
<p><label for="nam"><b>Email:</b></label>
<input type="text" name="email" id="nam" size="25"><br/></p>
<p><label for="id_1723"><b>Password:</b></label>
<input type="text" name="pass" id="id_1723" size="25" ><br/></p>
<p><input type="submit" value="Log In">
<input type="submit" value="Cancel" name="cancel">
</form>
</div>
</body>
</html>