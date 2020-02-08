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
    
    $name = $data->name;
    $email = $data->email;
    $mobno = $data->mobno;
    $college = $data->college;
    $password = $data->password;
    $msg='';
    $e=0;
    
    $sql="select * from user where email='".$email."'";
    $result=$con->query($sql);
    if($result->num_rows!=0){
        $msg = "Email Already Exist";
        $e=1;
    }
    if($e==0){
    $sql="select * from user where mobileno='".$mobno."'";
    $result=$con->query($sql);
    if($result->num_rows!=0){
        $msg = "Mobile No Already Exist";
        $e=1;
    }
    }
    if($e==1){
   echo '{"status":"failed","message":"'.$msg.'"}';
    }else{
       $query = "INSERT INTO user SET name=?, email=?, mobileno=?,college=?, password=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('sssss', $name, $email, $mobno,$college, $password);
        $result = $stmt->execute();
        if($result){
            echo '{"status":"success","message":"Registration Successfull"}';
        }
    }
    

    
     
}
    
    ?>