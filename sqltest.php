<?php
    $serverName = "mysqlassign.mysql.database.azure.com"; // update me
    $connectionOptions = array(
        "Database" => "earthquake", // update me
        "Uid" => "mysql@mysqlassign", // update me
        "PWD" => "qwerty@123" // update me
    );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if ($conn==TRUE)
        echo("Connected!");
    //$tsql= "SELECT * FROM earthquake.eq;";
    //$getResults= sqlsrv_query($conn, $tsql);
    //echo ("Reading data from table" . PHP_EOL);
    //if ($getResults == FALSE)
    //    echo (sqlsrv_errors());
    //while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
    // echo ($row['CategoryName'] . " " . $row['ProductName'] . PHP_EOL);
  //  }
   // sqlsrv_free_stmt($getResults);
?>
