<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'on');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //error_reporting(E_ALL);
   
   global $con;
$con = new mysqli("localhost","ignite2K18","2K18@svnce","ignitesvnce");

    
if (mysqli_connect_errno())
    {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
   
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);
    
    $name1 = $data[0]->name;
    $email1 = $data[0]->email;
    $mobno1 = $data[0]->mobno;
    $college1 = $data[0]->college;
    $msg='';
    $e=0;
    
    $sql="select * from user where email='".$email1."'";
    $result=$con->query($sql)->fetch_array(MYSQLI_ASSOC);
    $uid=$result["id"];
    
    
    $e=0;
    $i=1;
    foreach ($data as $key => $value) {
        
        
    $sql="select * from registration where email='".$value->email."' and eid=".$value->eid;
    $result=$con->query($sql);
    if($result->num_rows!=0){
        $msg = "Participent ".$i." already registerd for this event";
        $e=1;
        break;
        
    }
    $i=$i+1;
    }
    
    
        
  
  if($e==1){
      echo '[{"status":"failed","message":"'.$msg.'"}]';
  }else{
     /* foreach($data as $key => $value){
     $query = "INSERT INTO registration SET name=?, email=?, mobileno=?,college=?, eid=?, cat_id=?, reg_uid=?";
        $stmt = $con->prepare($query);
        $stmt->bind_param('sssssss', $value->name, $value->email, $value->mobno,$value->college, $value->eid,$value->cat_id,$uid);
        $result = $stmt->execute();
        
         if($result){
           //$data[i]='{"status":"success","message":"Registration Successfull"}';
        }else{
          
        }
    }*/
      echo '[{"status":"success","message":"Registration Successful","userid":"'.$uid.'"}]';
  }
  
 
    
    /*$sql="select * from user where email='".$email."'";
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
    */

    
     
}
    
    ?>