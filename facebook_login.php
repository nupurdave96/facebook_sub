<?php
require_once './config.php';
// Only if user is logged in and given permission, we can fetch user details
if ($userID) {
  try {
    if ($_SESSION["user_id"] == "") {
      // fetch user details.
      $user_profile = $facebook->api('/me');

      // Now check if user exist with same email ID
      
      try {
        $con=mysql_connect('aliassurbhi.db.9462939.hostedresource.com','aliassurbhi','Demo5@1212');
	mysql_select_db('aliassurbhi',$con);
	
		$email=$user_profile["id"];
		$res=mysql_query("select * from user_tbl where p_u_id='$email'",$con);
		$cnt=mysql_num_rows($res);
        if ($cnt > 0) {
          // User Exist 

          $_SESSION["name"] = $user_profile["name"];
          $_SESSION["email"] = $user_profile["email"];
		   $_SESSION["gender"] = $user_profile["gender"];
		    $_SESSION["link"] = $user_profile["link"];
         
         
          $_SESSION["new_user"] = "no";
        } else {
          // New user, Insert in database

       $con=mysql_connect('aliassurbhi.db.9462939.hostedresource.com','aliassurbhi','Demo5@1212');
	mysql_select_db('aliassurbhi',$con);
		$name=$user_profile["name"];
		$st="f";
		$em=$_SESSION["email"];
	$type="user";
		$ge=$_SESSION["gender"];
		$name=$_SESSION["name"];
	$pw='123';
	$mob='9090987867';
	$res=mysql_query("insert into user_tbl values('$em','$name','$pw','$ge','$mob',Null,'$type',Null,'$st')",$con);
	 
		 if ($res > 0) {
            $_SESSION["name"] = $user_profile["name"];
            $_SESSION["email"] = $user_profile["email"];
            $_SESSION["new_user"] = "yes";
          }
        }
      } catch (Exception $ex) {
        #echo $ex->getMessage();
      }
	  echo "hello";
	echo  $name;
	echo  $em;
	echo  $user_profile["email"];
//	  header("location:home.php");
    }
    $_SESSION["user_id"] = $userID;
  } catch (FacebookApiException $e) {
    $userID = NULL;
  }
} else {
	// if not a authentic facebook user
	header("location:../main_logsign2.php");
}
?>