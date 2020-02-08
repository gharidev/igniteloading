<?php
error_reporting(E_ALL);
ini_set('display_errors', 'on');
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['cat_id'])) {
    //error_reporting(E_ALL);
   
   global $con;
$con = new mysqli("localhost","ignite2K18","2K18@svnce","ignitesvnce");

 function email(){
        $result = $con->query("select * from user");
        if($result->num_rows==0){
            echo "not found";
        }else{
            echo "found";
        }
    }
    
    
if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    $cat_id=$_GET['cat_id'];
    $array=[];
    $sql="select * from events where cat_id=".$cat_id;
    $result=$con->query($sql);
    while($row=$result->fetch_array(MYSQLI_ASSOC)){
        $array[]=$row;
    }
    
    echo json_encode($array);
    
   
   
    
    

    
     
}
    
    ?>