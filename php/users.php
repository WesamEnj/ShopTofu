<?php
session_start();
require('setupDB.php');


if (isset($_POST['register'])) {

  $pEmail = $conn->real_escape_string($_POST["mail"]);
  $pName = $conn->real_escape_string($_POST["name"]);
  $pVorname = $conn->real_escape_string($_POST["firstName"]);
  $pPwd = $conn->real_escape_string($_POST["pw"]);



  $sql = 'SELECT * FROM users WHERE email = "' . $pEmail . '"';
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $error = "This email address is already taken!<br>";
    echo $error;
  } else {
    $sql = "SELECT id FROM users ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $lastId = $row['id'] + 1;

    $sql = insertUser($lastId, $conn, $pVorname, $pName, $pEmail, $pPwd);
    if ($conn->query($sql)) {
      $_SESSION["loggedIn"] = TRUE;
      $_SESSION["nachname"] = $pName;
      $_SESSION["userID"] = $lastId;
      $_SESSION["email"] = $pEmail;
    } else {
      echo ("Account konnte nicht erstellt werden.");
    }
  }
} else if (isset($_POST['login'])) {

  $pEmail = $conn->real_escape_string($_POST["mail"]);
  $pPwd = $conn->real_escape_string($_POST["pwd"]);

  $sql = "SELECT * FROM users WHERE email = '$pEmail'";
  $result = $conn->query($sql);
  if ($result->num_rows == 0) {
    $error2 = "There is no account associated with this username!<br>";
    echo $error2;
  } else {
    $sql = "SELECT * FROM users WHERE email = '" . $pEmail . "'AND pwd = '" . $pPwd . "'";
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
      $row = $result->fetch_row();
      $_SESSION["loggedIn"] = TRUE;
      $_SESSION["nachname"] = $row[1];
      $_SESSION["userID"] = $row[0];
      $_SESSION["email"] = $row[3];
      echo "login erfolgreich";
    } else {
      $error2 = "Invalid username or password!<br>";
      echo $error2;
    }
  }
}


function insertUser($id, $connection, $vorname, $nachname, $email, $pw)
{

  $ins = "INSERT INTO users (id, firstname, lastname, email, pwd) VALUES  ($id, '$vorname', '$nachname', '$email', '$pw')";


  if ($connection->query($ins) === TRUE) {
    echo "New user inserted successfully <br/>" .
      "<a href=\"../html/forms/registerForm.html\">Again pls!</a>";
  } else {
    echo "Error: " . $ins . "<br>" . $connection->error;
  }
}



// close the connection
