<?php

require_once('connec.php');

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$friends = $statement->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $pdo = new \PDO(DSN, USER, PASS);
    $lastname = trim($_POST['lastname']);
    $firstname = trim($_POST['firstname']);

    $query = "INSERT INTO friend (lastname, firstname) VALUES (:lastname, :firstname);";

    $statement = $pdo->prepare($query);

    $statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);

    $statement->execute();

    $friends = $statement->fetchAll();

    header("Location: index.php");
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDO</title>
</head>
<body>

    <?php
        foreach($friends as $friend) {
            echo "<br> Firstname : " . $friend['firstname'] . "<br> Lastname : " . $friend['lastname'] ;
        }
    ?>

    <form method="post">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" id="firstname" required >

        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" id="lastname" required >

        <button type="submit">submit</button>
    </form>

</body>
</html> 