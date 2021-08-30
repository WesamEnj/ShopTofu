<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tofushop";




    
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if ($conn -> connect_error) {
    die("DB-Verbindung fehlgeschlagen: " . mysqli_connect_error());
}



$show = '';


$createUserTable = "CREATE TABLE IF NOT EXISTS users (id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, firstname varchar(30),  lastname varchar(30), email varchar(30), pwd varchar(30) )";
if (!$conn -> query($createUserTable)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}
$show = $show . '<br/>' . $createUserTable . ': erfolgreich!';

$createArticleTable = "CREATE TABLE IF NOT EXISTS articles (id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, name varchar(30),  price varchar(30), description varchar(150), pic LONGBLOB NOT NULL)";
if (!$conn -> query($createArticleTable)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}
$show = $show . '<br/>' . $createArticleTable . ': erfolgreich!';

$createOrderTable = "CREATE TABLE IF NOT EXISTS orders (id int(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,userId int(6), articleAmount int(6), totalPrice varchar(30))";
if (!$conn -> query($createOrderTable)) {
    die('Tabelle-Erzeugen fehlgeschlagen: ' . $conn -> error);
}
$show = $show . '<br/>' . $createOrderTable . ': erfolgreich!';

// adding some tofuu
/* $sql = 'SELECT * FROM articles WHERE name = "'."Tofu1".'"';
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        $error = "This tofu is already in the system";
        //echo $error;
  }else{
    $sql = "INSERT INTO articles (name, price, description) VALUES
    ('Tofu1','2','lecker lecker lecker' )";
    if ($conn->query($sql) === TRUE) {
        echo "article inserted successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
  } */






//echo $show;



// close the connection

?> 