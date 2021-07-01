<?php 

    $mysql_host = "localhost";
    $mysql_user = "root";
    $mysql_password = "8302";
    $mysql_db = "heat_db";
    
    // Create connection
    $conn = mysqli_connect($mysql_host,$mysql_user,$mysql_password,$mysql_db);
    
    // Check connection
    //if (!$conn)
//   {
	//die("Connection failed: " . mysqli_connect_error());
   // }
	//sql to delete a recode    
    $sql = "DELETE FROM collect_data";
    
    $result = mysqli_query($conn,$sql);
    if($result === true)
    {
	header('Location: test.php');
    }
?>
    
