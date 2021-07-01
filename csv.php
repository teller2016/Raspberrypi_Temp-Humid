<?php
    header("Content-Type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachement; filename=text.csv");
    echo("\xEF\xBB\xBF");
    
    $mysql_host = "localhost";
    $mysql_user = "pi";
    $mysql_password = "8302";
    $mysql_db = "heat_db";
    
    $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
    
    echo("측정 시간,습도,온도");
    echo("\n");
    $query = "SELECT * FROM collect_data ORDER BY collect_time DESC";
    $result = mysqli_query($conn,$query);
    while($row = mysqli_fetch_array($result))
    {
        $secTOTime = gmdate('H:i:s',$row[collect_time]);
        echo("{$secTOTime},{$row['value2']},{$row['value1']}");
        echo("\n");
    }
?>    

