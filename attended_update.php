<?php
  require_once "db.php";
  if(isset($_GET["id"]) && isset($_GET["attended"]))
  {
    echo "string";
   $user_id = mysqli_real_escape_string($conn, $_GET["id"]);
   $attended = mysqli_real_escape_string($conn, $_GET["attended"]);
   $query = "
    UPDATE users
    SET attended = " . $attended . "
    WHERE id = " . $user_id . "
   ";
   mysqli_query($conn, $query);

   header("location: search.php");

}
