<?php
  $conn = mysqli_connect("localhost", "root", "", "biblioteka") or die("Connection Error: ".mysqli_error($conn));

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST["type"];
    $search = $_POST["search"];

    switch($type) {
      case "Dzial":
        $books = mysqli_query(
          $conn, 
          "SELECT Tytul, Wydawnictwo, Miejsce_wyd, Rok_wyd, Objetosc_ks, Cena, Nazwa, Imie, Nazwisko FROM ksiazki JOIN dzialy USING (Id_dzial) JOIN autor USING (Id_autor) WHERE Nazwa LIKE '%$search%'"
        );
        break;
      case "Autor":
        $books = mysqli_query(
          $conn, 
          "SELECT Tytul, Wydawnictwo, Miejsce_wyd, Rok_wyd, Objetosc_ks, Cena, Nazwa, Imie, Nazwisko FROM ksiazki JOIN dzialy USING (Id_dzial) JOIN autor USING (Id_autor) WHERE CONCAT(Imie, ' ', Nazwisko) LIKE '%$search%'"
        );
        break;
      default: 
        $books = mysqli_query(
          $conn, 
          "SELECT Tytul, Wydawnictwo, Miejsce_wyd, Rok_wyd, Objetosc_ks, Cena, Nazwa, Imie, Nazwisko FROM ksiazki JOIN dzialy USING (Id_dzial) JOIN autor USING (Id_autor) WHERE $type LIKE '%$search%'"
        );
        break;
    }
  }
  else {
    $books = mysqli_query(
      $conn, 
      "SELECT Tytul, Wydawnictwo, Miejsce_wyd, Rok_wyd, Objetosc_ks, Cena, Nazwa, Imie, Nazwisko FROM ksiazki JOIN dzialy USING (Id_dzial) JOIN autor USING (Id_autor)"
    );
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
      <input type="text" name="search" />
      <select name="type">
        <option value="Tytul">Tytuł</option>
        <option value="Wydawnictwo">Wydawnictwo</option>
        <option value="Miejsce_wyd">Miejsce Wydarzenia</option>
        <option value="Wydawnictwo">Wydawnictwo</option>
        <option value="Dzial">Dział</option>
        <option value="Autor">Autor</option>
      </select>
      <input type="submit" value="Szukaj">
    </div>
  </form>
  <table>
    <thead>
      <tr>
        <td>Tytuł</td>
        <td>Wydawnictwo</td>
        <td>Miejsce Wydarzenia</td>
        <td>Rok Wydarzenia</td>
        <td>Objętość Książki</td>
        <td>Cena</td>
        <td>Dział</td>
        <td>Autor</td>
      </tr>
    </thead>
    <tbody>
      <?php
        while($row = mysqli_fetch_array($books)) {
      ?>
        <tr>
          <td><?php echo $row["Tytul"] ?></td>
          <td><?php echo $row["Wydawnictwo"] ?></td>
          <td><?php echo $row["Miejsce_wyd"] ?></td>
          <td><?php echo $row["Rok_wyd"] ?></td>
          <td><?php echo $row["Objetosc_ks"] ?></td>
          <td><?php echo $row["Cena"] ?></td>
          <td><?php echo $row["Nazwa"] ?></td>
          <td><?php echo $row["Nazwisko"]." ".$row["Imie"] ?></td>
        </tr>
      <?php
        }
      ?>
    </tbody>
  </table>
</body>
</html>