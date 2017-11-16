<?php
session_start();
require_once("pdo.php");	//require pdo.php to connect to the database

if (! isset($_SESSION["email"]) ) { 
echo "ACCESS DENIED";
die();
}


if ( isset($_POST['logout']) ) {
    header('Location: logout.php');
    return;
}

if ( isset($_POST['make']) && isset($_POST['year']) 
     && isset($_POST['mileage'])) {
     
     if( strlen($_POST['make']) < 1 && strlen($_POST['model']) < 1 &&strlen($_POST['year']) < 1 && strlen($_POST['mileage']) < 1 ){
              $_SESSION["error"] = "All fields required";
            header( 'Location: add.php' ) ;
            return;
            }
     
     if( strlen($_POST['make']) < 1 ){
              $_SESSION["error"] = "Make is required";
            header( 'Location: add.php' ) ;
            return;
     }
     

     if(!  is_numeric($_POST['year']) || !  is_numeric($_POST['mileage'])){
     
            $_SESSION["error"] = "Mileage and year must be numeric";
            header( 'Location: add.php' ) ;
            return;
}
 
else{
     
    $stmt = $pdo->prepare('INSERT INTO autos (make, model, year, mileage) VALUES ( :make, :model, :year, :mileage)');
$stmt->execute(array(

':make' => $_POST['make'],

':model' => $_POST['model'],

':year' => $_POST['year'],

':mileage' => $_POST['mileage'])

); 
$_SESSION['success'] = "Record inserted";

header("Location: index.php");
return;
}
}
 
?>
<!DOCTYPE=html>
<html>
<head>
<title> Chinmay Vinchurkar </title>
<body>
<h1> Tracking Autos for <?php if ( isset($_SESSION["email"]) ) {
    echo htmlentities($_SESSION["email"]);
} ?> </h1>
<p>
<?php if ( isset($record) ) {
    echo htmlentities($record);
} ?></p>
<?php
    if ( isset($_SESSION["error"]) ) {
        echo('<p style="color:red">'.$_SESSION["error"]."</p>\n");
        unset($_SESSION["error"]);
    }
?>
<form method="post">
<p>Make:
<input type="text" name="make" size="40"></p>
<p>Model:
<input type="text" name="model" size="40"></p>
<p>Year:
<input type="text" name="year" size="40"></p>
<p>Mileage:
<input type="text" name="mileage" size="40"></p>

<p><input type="submit" value="Add"> <input type="submit" value="cancel" name="logout"></p>
</form>

</head>
</body>
</html>

