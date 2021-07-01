<?php
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachement; filename=text.csv");
    echo("\xEF\xBB\xBF");
    
    $mysql_host = "localhost";
    $mysql_user = "pi";
    $mysql_password = "8302";
    $mysql_db = "heat_db";
    
    $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
    
    echo("Time,Humid,Temp");
    echo("\n");
    $query = "SELECT * FROM collect_data ORDER BY collect_time DESC";
    
    // return Data of query
    $result = mysqli_query($conn,$query);
    
    // mysqpl_fetch_array() returns data of record one by one
    while($row = mysqli_fetch_array($result))
    {
        $secTOTime = gmdate('H:i:s',$row[collect_time]);
        echo("{$secTOTime},{$row['value2']},{$row['value1']}");
        echo("\n");
    }
    exec("sudo python3 /home/pi/python_code/dht3.py");
    header('Location: test.php');
?>
