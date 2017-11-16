
<?php
require_once("pdo.php");	//require pdo.php to connect to the database

Session_start();

?>

<!DOCTYPE=htm>
<html>
<head>
<title>Chinmay Vinchurkar</title>
<body>
<h1> Welcome to the Autos Database</h1>
<p>  




<?php
// php code to check if logged in 
if (! isset($_SESSION["email"]) ) { 
echo "<p><a href=\"login.php\"> Please log in </a></p>";
echo "<p>Attempt to <a href=\"add.php\">add data </a> without logging in.</p>";
} 
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
if (isset($_SESSION["email"]) ) { 
$stmt = $pdo->query("SELECT make, model, year, mileage, autos_id FROM autos");
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if (isset($row["autos_id"]) ) {
echo('<table border="1">'."\n");
 echo "<tr><td>";
    echo "<b>Make</b>";
    echo "</td><td>";
    echo "<b>Model</b>";
    echo "</td><td>" ;
    echo "<b>Year</b>";
    echo "</td><td>";
    echo "<b>Mileage</b>";
    echo "</td><td>";
    echo "<b>Action</b>";
        echo "</td><td></tr>";

while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
   

    echo "<tr><td>";
    echo(htmlentities($row['make']));
    echo("</td><td>");
    echo(htmlentities($row['model']));
    echo("</td><td>");
    echo(htmlentities($row['year']));
    echo("</td><td>");
    echo(htmlentities($row['mileage']));
    echo("</td><td>");
    echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / ');
    echo('<a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
    echo("</td></tr>\n");
}

}
else{
echo  "<p>no rows found</p>";}
echo "<p><a href=\"add.php\">Add New Entry</a></p>";
echo "<p><a href=\"logout.php\">Logout</a></p>";
}
?>



</body>
</head>
</html>
