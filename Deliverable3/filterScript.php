<?php

      header('Content-Type: text/csv');
      header('Content-Disposition: attachment; filename="results.csv"');

  $hostname = "db1.mcs.slu.edu";
  $username = "edstat";
  $password = "LAqes3FbK3";
  $db = "edstat";

$dbconnect=mysqli_connect($hostname,$username,$password,$db);

if ($dbconnect->connect_error) {
  die("Database connection failed: " . $dbonnect->connect_error);
}

     //$where = $_GET["h1"];	
     $select = $_REQUEST["h1"];
     $where = $_REQUEST["h2"];
     $from = $_REQUEST["h3"];
     $sql = mysqli_query($dbconnect, "Select ".$select." from ".$from." where districtName = '{$where}'")
        or die (mysqli_error($dbconnect));

      $output = fopen('php://output', 'x');

      $first = true;
      while($row = mysqli_fetch_assoc($sql)) {
        if ($first) {
          fputcsv($output, array_keys($row));
          $first = false;
        }
        fputcsv($output, $row);
      }

      
      fclose($output);
?>
