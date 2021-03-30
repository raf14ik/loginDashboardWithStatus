<?php
// created by rafik hammas
// student related functions 



//get admin details
	function GetStudent($conn,$eid)
	{
		$sqlq = mysqli_query($conn,"SELECT * FROM `etudiant` WHERE `eid`=$eid");
        $rowstudents =mysqli_fetch_array($sqlq);        
		$students['name'] = $rowstudents['firstname']; 
		$students['email'] = $rowstudents['email']; 
		$students['password'] = $rowstudents['password']; 
		$students['created'] = $rowstudents['created']; 
		$students['status'] = $rowstudents['status']; 
		return $students;
	}	

//student login
	function StudentLogin($conn,$email,$pass,$rem)
	{
		//encrypting new pasword
		$password=md5(sha1($pass));

		$query =mysqli_query($conn,"SELECT * FROM `etudiant` WHERE email ='$email'and password ='$password'");	
		$rowcounts = mysqli_num_rows($query);	
			if($rowcounts==1)
			{
				$row =mysqli_fetch_array($query);		
				$stat=$row['status'];
				if($stat==1)
				{
					$_SESSION['student'] = $row['eid'];

					$response ='success';
					return $response;
					if($rem==1)
					{
						setcookie('eid',$row['eid'], time() + (86400 * 365), "/");
					}
				}
			}
			else
			{
				$response ='error';
				return $response;	 	 		
			}
	}
	


//logout
	function StudentLogout($conn)
	{
		session_destroy();		
		setcookie("eid", "", time() - 3600);
		echo"<script> window.setTimeout(function() { window.location.href = './index.php'; }, 0);</script>";
	}

//get admins list
	function GetAdminList($conn)
	{
		$sqlq = mysqli_query($conn,"SELECT * FROM `admins` ");
    	$data =array();
        while($row =mysqli_fetch_assoc($sqlq))
        {
            $data[] = $row; 
        }    
        return $data;
	}


//change password
	function ChangePassword($conn,$aid,$newpass,$rpass)
	{		
		if($aid!=NULL)
		{
			if($newpass==$rpass)
			{
				$password=md5(sha1($newpass));
				mysqli_query($conn,"UPDATE `admins` SET `password` = '$password' WHERE `admins`.`aid` = $aid");
				$response ='success';
				return $response;
			}
			else
			{
				$response ='pwmiss';
				return $response;
			}
		}
		else
		{
			$response ='error';
			return $response;
		}
	}


//delete admin
	function DeleteAdmin($conn,$aid)
	{
		mysqli_query($conn,"DELETE FROM admins WHERE aid ='$aid'"); 
	}	


//creation new student
//create student
function CreateEtud($conn,$firstname,$secondname,$speciality,$email,$password,$rpassword)
{		
	$datetoday = date('Y-m-d'); 
	if($firstname==NULL ||$secondname==NULL || $speciality==NULL ||$email==NULL || $password==NULL || $rpassword==NULL)
	{
		$response ='error';
		return $response;
	}
	else{
		$password=md5(sha1($password));
		mysqli_query($conn,"INSERT INTO `etudiant` (`firstname`, `secondname`, `speciality`, `email`, `password`, `created`, `status`) VALUES
		('$firstname','$secondname','$speciality','$email','$password','$datetoday','0')"); 

			$response ='success';
			return $response;
	}
}


?>
