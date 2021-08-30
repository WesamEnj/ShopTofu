<?php
session_start();
require('setupDB.php');

$user = $_SESSION["userID"];
$articleId = 1;

insertOrder($conn, $user, $articleId);
function insertOrder($connection, $userId, $articleId){
    
    $sql = 'SELECT * FROM orders WHERE userId = "'.$userId.'"';

    $result = $connection->query($sql);
    
    if ($result->num_rows == 0){
        addArticleToOrder($connection, $userId, 1, $articleId, 2);
        
        }
    else{
        
        $sql = 'SELECT articleAmount FROM orders WHERE userId = "'.$userId.'"';
        echo $userId;
        $result = $connection->query($sql);
        
        echo $result;
        
    }
}

function addArticleToOrder($connection, $userId, $index, $articleId, $amount, ){
    $article = "article_" . $index;
    $count = "count_" . $index;
    
    $addArticleColumn= "ALTER TABLE orders ADD $article int(10) NOT NULL";
    $addArticleCount= "ALTER TABLE orders ADD $count int(10) NOT NULL";
    
    
    

    if ($connection->query($addArticleColumn) === TRUE && $connection->query($addArticleCount) === TRUE) {
        echo "article column added";}
    $ins = "INSERT INTO orders (userId, articleAmount, $article, $count) VALUES ($userId,$index, $articleId, $amount)";
    if ($connection->query($ins) === TRUE) {
        echo "New user inserted successfully";
      } else {
        echo "Error: " . $ins . "<br>" . $connection->error;
      }
}




// close the connection

?> 