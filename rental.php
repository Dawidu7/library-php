<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $book = $_POST["book"];
    $worker = $_POST["worker"];
    $reader = $_POST["reader"];
    $date = $_POST["date"];

    mysqli_query($conn, "INSERT INTO Wypozyczenia VALUES (null, '$book', '$worker', '$reader', '$date', null)");

    header("Location: index.php");
  }

  $workers = mysqli_query($conn, "SELECT Id_pracownika, Nazwisko, Imie FROM Pracownicy");
  $books = mysqli_query($conn, "SELECT Sygnatura, Tytul FROM ksiazki");
  $readers = mysqli_query($conn, "SELECT Nr_czytelnika, Nazwisko, Imie FROM Czytelnicy");
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
      <label for="worker">Pracownik:</label>
      <select name="worker" id="worker">
        <?php
          while($row = mysqli_fetch_array($workers)) {
            echo "<option value='$row[Id_pracownika]'>$row[Imie] $row[Nazwisko]</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label for="book">Książka:</label>
      <select name="book" id="book">
        <?php
          while($row = mysqli_fetch_array($books)) {
            echo "<option value='$row[Sygnatura]'>$row[Tytul]</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label for="reader">Czytelnik:</label>
      <select name="reader" id="reader">
        <?php
          while($row = mysqli_fetch_array($readers)) {
            echo "<option value='$row[Nr_czytelnika]'>$row[Imie] $row[Nazwisko]</option>";
          }
        ?>
      </select>
    </div>
    <div>
      <label for="date">Date Wypożyczenia:</label>
      <input type="date" name="date" id="date" />
    </div>
    <input type="submit" value="Dodaj Wypożyczenie" />
  </form>
</body>
</html>