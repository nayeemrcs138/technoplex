<?php
session_start();
$flag=0;
$conn = mysqli_connect("localhost", "root", "","technoplex_website");
		$sql="select * from users where user_name='".$_REQUEST["user_name"]."'";
		$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
	//session_start();
	while($row = mysqli_fetch_assoc($result)) {
			$temp["user_name"] = $row["user_name"];
			$temp["password"] = $row["password"];
            $temp["utype"] = $row["utype"];
			

            if($_REQUEST["user_name"] == $temp["user_name"] && sha1($_REQUEST["password"]) == $temp["password"]){
                $flag=1;
                break;
            }
            else{
                $flag=0;
            }
    }

if($flag==1){
	if($temp["utype"]=="admin"){
	session_start();
	setcookie("admin",$_REQUEST["user_name"], time() + 1800);
	header("Location:admin_index.html");
	}
}

else if($flag==0){
    echo "<script>alert('Wrong Username or Password!')</script>";
	echo "<script>window.location.href ='login.html'</script>";
}