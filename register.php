<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $position = $_POST["position"];
    $city = $_POST["city"];
    $date = $_POST["date"];
    $salary = $_POST["salary"];

    mysqli_query($conn, "INSERT INTO Pracownicy VALUES (null, '$surname', '$name', '$position', '$city', '$date', '$salary')");

    header("Location: index.php");
  }

  $res = mysqli_query($conn, "SELECT Id_stanowisko, Nazwa FROM stanowiska");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rejestracja</title>
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
    <div>
      <label for="position">Stanowisko:</label>
      <select name="position" id="position">
        <?php
          while($row = mysqli_fetch_array($res)) {
            echo "<option value='$row[Id_stanowisko]'>$row[Nazwa]</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label for="city">Miasto:</label>
      <input type="text" name="city" id="city" />
    </div>
    <div>
      <label for="date">Data Zatrudnienia:</label>
      <input type="date" name="date" id="date" />
    </div>
    <div>
      <label for="salary">Wynagrodzenie:</label>
      <input type="number" name="salary" id="salary" />
    </div>
    <input type="submit" value="Zarejestruj">
  </form>
</body>
</html>