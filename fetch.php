<?php
//fetch.php
require_once "db.php";
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM users
  WHERE id LIKE '%".$search."%'
  OR name LIKE '%".$search."%'
  OR email LIKE '%".$search."%'
  OR mobile LIKE '%".$search."%'
 ";
}
else
{
 $query = "
  SELECT * FROM users ORDER BY id
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
  <div class="table-responsive">
   <table class="table table bordered">
    <tr>
     <th>id</th>
     <th>Name</th>
     <th>Email</th>
     <th>Mobile</th>
     <th>Faculty</th>
     <th>Status</th>
     <th>Attended</th>
    </tr>
 ';
 while($row = mysqli_fetch_array($result))
 {
   $checked = "";
   if ($row["attended"] == '1') $checked = "disabled";
  $output .= '
   <tr>
    <td>'.$row["id"].'</td>
    <td>'.$row["name"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$row["mobile"].'</td>
    <td>'.$row["faculty"].'</td>
    <td>'.$row["status"].'</td>
    <td><a class="btn btn-primary confirmation ' . $checked . '" href="attended_update.php?id=' . $row["id"] . '&attended=' . '1' . '" role="button" onclick="return confirm(\'Are you sure?\')">Attended</a></td>
   </tr>
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>
