<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
   
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    
    $email = $data->email;
    $password = $data->password;
    $msg='';
    $e=0;
    
    $sql="select * from user where email='".$email."'";
    $result=$con->query($sql);
    if($result->num_rows==0){
        $msg = "User Doesnot Exist";
        $e=1;
    }
    if($e==0){
    $row =$result->fetch_array(MYSQLI_ASSOC);
    if($row['password']!=$password){
        $msg = "Wrong Password";
        $e=1;
    }
    }
    if($e==1){
   echo '{"status":"failed","message":"'.$msg.'"}';
    }else{
      $sql="select * from user where email='".$email."'";
      $result=$con->query($sql)->fetch_array(MYSQLI_ASSOC);
      $name=$result['name'];
      $mobno=$result['mobileno'];
      $college=$result['college'];
      
        if($result){
            echo '{"status":"success","message":"Login Successfull","name":"'.$name.'","mobno":"'.$mobno.'","college":"'.$college.'"}';
        }
    }
    

    
     
}
    
    ?>