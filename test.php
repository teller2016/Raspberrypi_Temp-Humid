<?php 
    $mysql_host = "localhost";
    $mysql_user = "pi";
    $mysql_password = "8302";
    $mysql_db = "heat_db";
    
    $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
    
    
    
    
    
    
    $query = "SELECT * FROM collect_data ORDER BY collect_time DESC";
    $result = mysqli_query($conn,$query);
    
    echo("<table border=3 align=center>
    <caption>온습도계 측정</caption>
    <tr>
		<th>측정 시간</th>
		<th>습도</th>
		<th>온도</th>
    </tr>
		");
		
	while($row = mysqli_fetch_array($result))
    {
        $secTOTime = gmdate('H:i:s',$row[collect_time]);
        
        echo("<tr>");
        
        echo("<td>". $secTOTime ."</td>");
        echo("<td>". $row['value2'] ."%</td>");
        echo("<td>". $row['value1'] ."℃</td>");
        
        
        echo("</tr>");
        
        
    }
    
		
	echo("</table>");

    
?>
