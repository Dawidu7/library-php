<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST["title"];
    $publisher = $_POST["publisher"];
    $place = $_POST["place"];
    $year = $_POST["year"];
    $volume = $_POST["volume"];
    $price = $_POST["price"];
    $sector = $_POST["sector"];
    $author = $_POST["author"];

    mysqli_query($conn, "INSERT INTO Ksiazki VALUES (null, '$title', '$publisher', '$place', '$year', '$volume', '$price', '$sector', '$author')");

    header("Location: index.php");
  }

  $sectors = mysqli_query($conn, "SELECT Id_dzial, Nazwa FROM dzialy");
  $authors = mysqli_query($conn, "SELECT Id_autor, Nazwisko, Imie FROM autor");
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
      <label for="title">Tytuł:</label>
      <input type="text" name="title" id="title" />
    </div>
    <div>
      <label for="publisher">Wydawnictwo:</label>
      <input type="text" name="publisher" id="publisher" />
    </div>
    <div>
      <label for="place">Miejsce Wydarzenia:</label>
      <input type="text" name="place" id="place" />
    </div>
    <div>
      <label for="year">Rok Wydarzenia:</label>
      <input type="number" name="year" id="year" />
    </div>
    <div>
      <label for="volume">Objętość Książki:</label>
      <input type="number" name="volume" id="volume" />
    </div>
    <div>
      <label for="price">Cena:</label>
      <input type="number" step="0.01" name="price" id="price" />
    </div>
    <div>
      <label for="sector">Stanowisko:</label>
      <select name="sector" id="sector">
        <?php
          while($row = mysqli_fetch_array($sectors)) {
            echo "<option value='$row[Id_dzial]'>$row[Nazwa]</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label for="author">Autor:</label>
      <select name="author" id="author">
        <?php
          while($row = mysqli_fetch_array($authors)) {
            echo "<option value='$row[Id_autor]'>$row[Imie] $row[Nazwisko]</option>";
          }
        ?>
      </select>
    </div>
    <input type="submit" value="Dodaj Książkę" />
  </form>
</body>
</html>