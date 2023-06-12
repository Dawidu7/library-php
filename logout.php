<?php
  setcookie("auth", null, time() - 3600);

  header("Location: index.php");
?>