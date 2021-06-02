<?php
    function visiteur($record) {
      $db_host = "db5001570552.hosting-data.io";
      $db_username = "dbu1460141"; 
      $db_password = "?EbiZou!31140%";
      $db_name = "dbs1309444";
      $db_table = "visite";
      $counter_page = "access_page";
      $counter_field = "access_counter";

        
        $db = mysqli_connect ($db_host, $db_username, $db_password, $db_name) or ("Host ou base données non disponible");

  $sql_call = "INSERT INTO ".$db_table." (".$counter_page.", ".$counter_field.") VALUES ('".$record."', 1) ON DUPLICATE KEY UPDATE ".$counter_field." = ".$counter_field." + 1"; 
  mysqli_query($db, $sql_call) or die("erreur d‘insertion");
        
$sql_call = "SELECT ".$counter_field. " FROM ".$db_table." WHERE ".$counter_page. " = '".$record. "'";
$sql_result = mysqli_query($db, $sql_call) or ("SQL-demande refusée");
$row = mysqli_fetch_assoc($sql_result);
$x = $row[$counter_field];

mysqli_close($db);
return $x;
        

       /* $db = mysqli_connect($db_host, $db_username, $db_password, $db_name) or ("Host non disponible");
        $db = mysql_select_db ($db_name, $link) or ("base de données non disponible");
    
        $sql_call = "INSERT INTO ".$db_table." (".$counter_page.", ".$counter_field.") VALUES ('".$record."', 1) ON DUPLICATE KEY UPDATE ".$counter_field." = ".$counter_field." + 1"; 
        mysqli_query($db, $sql_call) or die ("erreur d‘insertion");
        
        $sql_call = "SELECT ".$counter_field. " FROM ".$db_table." WHERE ".$counter_page. " = '".$record. "'";
        $sql_result = mysqli_query($db, $sql_call) or ("SQL-demande refusée");
        $row = mysqli_fetch_assoc($sql_result);
        $x = $row[$counter_field];

        mysqli_close($db);
        return $x;
        */
    }
?>