<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
  <title>ONLINE AUCTION SYSTEM</title>
</head>
    <link rel="stylesheet" type="text/css" href="createacc.css">
    <body>
  <?php
  
       $con=mysqli_connect('127.0.0.1',"root","rumrum");
$db=mysqli_select_db($con,"online_auction2");
      
   

       /* if (!isset($_POST['productname'])||!isset($_POST['productdesc'])||!isset($_POST['startbidamt'])||!isset($_POST['strtdate'])||!isset($_POST['enddate']))
        {
            echo "<p> You have not entered all details.<br/>
             try again. </p>";
             exit;
        }/*/
		

     $iid=$_POST['itemid'];
     $b=$_POST['newbid'];
	 $query="SELECT item_name from item where item_id='".$iid."'";
	 $res=mysqli_query($con,$query);
	 $row = mysqli_fetch_assoc($res);
     $query1="SELECT sid from item where item_id='".$iid."'";
	 $res1=mysqli_query($con,$query1);
	 $row1 = mysqli_fetch_assoc($res1);
	 $query2="SELECT name from user where user_id='".$row1['sid']."'";
	 $res2=mysqli_query($con,$query2);
	 $row2= mysqli_fetch_assoc($res2);
	 $query3="SELECT min_amt from item where item_id='".$iid."'";
	 $res3=mysqli_query($con,$query3);
	 
	 $row3= mysqli_fetch_assoc($res3);
	  
	  
	  $query4="SELECT bid_start from item where item_id='".$iid."'";
	 $res4=mysqli_query($con,$query4);
	  $row4= mysqli_fetch_assoc($res4);
	  
	  $query5="SELECT end_bid from item where item_id='".$iid."'";
	 $res5=mysqli_query($con,$query5);
	  $row5= mysqli_fetch_assoc($res5);
	  
	  $date= date('Y-m-d');
	 $s=$_SESSION['id'];
	 $s1=$_SESSION['name'];
	 if($b>=$row3['min_amt'] && $row1['sid']!=$s && strtotime($date)>=strtotime($row4['bid_start']) && strtotime($row5['end_bid'])>strtotime($date))
	 {
		mysqli_autocommit($con,FALSE);
     
	 $sql = "UPDATE bids SET bidamt='".$b."' WHERE itemid='".$iid."' AND bidderid='".$s."'";
	 $sql1= "SELECT bidamt from bids WHERE itemid='".$iid."' AND bidderid='".$s."'";
      $result=mysqli_query($con,$sql);
$result1=mysqli_query($con,$sql1);
$row=mysqli_fetch_array($result1);	  
if ($row['bidamt']!=NULL) {
    echo "Bid amount updated successfully";
} else {
    echo "Error in updating.Check whether you have already placed a bid";
}
 mysqli_commit($con);
     mysqli_close($con);
	 }
	 else
	 {
		 echo "error in placing bid";
	 }
	 


        ?>
        
   </body>
</html> 