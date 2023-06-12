<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  function checkLogin($res, $name, $surname) {
    while($row = mysqli_fetch_array($res)) {
      if ($name == $row["Imie"] && $surname == $row["Nazwisko"]) {
        return $row["Id_pracownika"];
      }
    }

    return false;
  }

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_query($conn, "SELECT Id_pracownika, Imie, Nazwisko FROM pracownicy");

    $login = checkLogin($conn, $_POST["name"], $_POST["surname"]);

    if($login != false) {
      setcookie("auth", $login, time() + (86400 * 30));

      header("Location: index.php");
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logowanie</title>
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
<nav>
    <a href="index.php">Biblioteka</a>
    <?php
      if (isset($_COOKIE["auth"])) {
    ?>
      <a href="logout.php">Wyloguj</a>
      <a href="reader.php">Dodaj Czytelnika</a>
      <a href="book.php">Dodaj Książkę</a>
      <a href="author.php">Dodaj Autora</a>
      <a href="rental.php">Dodaj Wypożyczenie</a>
    <?php
      } 
      else {
    ?>
      <a href="login.php">Login</a>
      <a href="register.php">Rejestracja</a>
    <?php
      }
    ?>
  </nav>
  <hr />
  <form action="#" method="POST">
    <div>
      <label for="name">Imie:</label>
      <input type="text" name="name" id="name" />
    </div>
    <div>
      <label for="surname">Nazwisko:</label>
      <input type="text" name="surname" id="surname" />
    </div>
    <input type="submit" value="Zaloguj">
  </form>
</body>
</html>