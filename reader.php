<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $dateOfBirth = $_POST["dateOfBirth"];
    $street = $_POST["street"];
    $postcode = $_POST["postcode"];
    $city = $_POST["city"];
    $dateOfSave = $_POST["dateOfSave"];
    $nr = $_POST["nr"];
    $function = $_POST["function"];
    $gender = $_POST["gender"];

    mysqli_query($conn, "INSERT INTO Czytelnicy VALUES (null, '$surname', '$name', '$dateOfBirth', '$street', '$postcode', '$city', '$dateOfSave', null, '$nr', '$function', '$gender')");

    header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteka</title>
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
      <label for="dateOfBirth">Data Urodzenia:</label>
      <input type="date" name="dateOfBirth" id="dateOfBirth" />
    </div>
    <div>
      <label for="street">Ulica:</label>
      <input type="text" name="street" id="street" />
    </div>
    <div>
      <label for="postcode">Kod:</label>
      <input type="text" name="postcode" id="postcode" />
    </div>
    <div>
      <label for="city">Miasto:</label>
      <input type="text" name="city" id="city" />
    </div>
    <div>
      <label for="dateOfSave">Data Zapsiania:</label>
      <input type="date" name="dateOfSave" id="dateOfSave" />
    </div>
    <div>
      <label for="nr">Nr Legitymacji:</label>
      <input type="text" name="nr" id="nr" />
    </div>
    <div>
      <label for="function">Funckja:</label>
      <select name="function" id="function">
        <option value="PD">PD</option>
        <option value="S">S</option>
      </select>
    </div>
    <div>
      <label for="gender">Płeć:</label>
      <select name="gender" id="gender">
        <option value="K">K</option>
        <option value="M">M</option>
      </select>
    </div>
    <input type="submit" value="Dodaj Czytelnika" />
  </form>
</body>
</html>