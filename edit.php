<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['make']) && isset($_POST['year'])
     && isset($_POST['model']) && isset($_POST['autos_id']) ) {

    $sql = "UPDATE autos SET make = :make,
            year = :year, model = :model,
            mileage = :mileage
            WHERE autos_id = :autos_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':make' => $_POST['make'],
        ':year' => $_POST['year'],
        ':model' => $_POST['model'],
        ':mileage' => $_POST['mileage'],

        ':autos_id' => $_POST['autos_id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: index.php' ) ;
    return;
}


$stmt = $pdo->prepare("SELECT * FROM autos where autos_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['autos_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for autos_id';
    header( 'Location: index.php' ) ;
    return;
}
?>
<p><b>Edit User</b></p>
<form method="post">
<p><b>Make:</b>
<input type="text" name="make" value="<?= htmlentities($row['make']); ?>"></p>
<p><b>Year:</b>
<input type="text" name="year" value="<?=  htmlentities($row['year']); ?>"></p>
<p><b>Model:</b>
<input type="text" name="model" value="<?= htmlentities($row['model']); ?>"></p>
<p><b>Mileage:</b>
<input type="text" name="mileage" value="<?= htmlentities($row['mileage']); ?>"></p>
<input type="hidden" name="autos_id" value="<?= $autos_id ?>">
<p><input type="submit" value="Update"/>
<a href="index.php">Cancel</a></p>
</form>
