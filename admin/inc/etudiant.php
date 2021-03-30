<?php
// created by rafik hammas
// etudiant related functions 

//create student
function CreateEtud($conn,$firstname,$secondname,$speciality,$email,$password)
{		
	$datetoday = date('Y-m-d'); 
	if($firstname==NULL ||$secondname==NULL || $speciality==NULL ||$email==NULL || $password==NULL)
	{
		$response ='error';
		return $response;
	}
	else{
		$password=md5(sha1($password));
		mysqli_query($conn,"INSERT INTO `etudiant` (`firstname`, `secondname`, `speciality`, `email`, `password`, `created`, `status`) VALUES
		('$firstname','$secondname','$speciality','$email','$password','$datetoday','1')"); 

			$response ='success';
			return $response;
	}
}
//get Student details
function GetStud($conn,$eid)
{
    $sqlq = mysqli_query($conn,"SELECT * FROM `etudiant` WHERE `eid`=$eid");
    $rowstud =mysqli_fetch_array($sqlq);        
    $studs['firstname'] = $rowstud['firstname']; 
    $studs['secondname'] = $rowstud['secondname']; 
    $studs['speciality'] = $rowstud['speciality']; 
    $studs['email'] = $rowstud['email']; 
    $studs['password'] = $rowstud['password']; 
    $studs['created'] = $rowstud['created']; 
    $studs['status'] = $rowstud['status']; 
    return $studs;
}	

//get students list
function GetStudList($conn)
{
    $sqlq = mysqli_query($conn,"SELECT * FROM `etudiant` ");
    $data =array();
    while($row =mysqli_fetch_assoc($sqlq))
    {
        $data[] = $row; 
    }    
    return $data;
}
//update student statuts
function ChangeStatuts($conn,$eid,$stat)
{		
    if($eid!=NULL)
    {

            mysqli_query($conn,"UPDATE `etudiant` SET `status` = '$stat' WHERE `etudiant`.`eid` = $eid");
            $response ='success';
            return $response;
    }
    else
    {
        $response ='error';
        return $response;
    }
}

//update student detail
function ChangeDetail($conn,$eid,$firstname,$secondname,$speciality,$email,$newpass,$rpass)
{		
    if($eid!=NULL)
    {
        if($newpass==$rpass)
        {
            $password=md5(sha1($newpass));
            mysqli_query($conn,"UPDATE `etudiant` SET `firstname`='$firstname',`secondname`='$secondname',`speciality`='$speciality',`email`='$email', `password` = '$password' WHERE `etudiant`.`eid` = $eid");
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

//delete student
function DeleteStudent($conn,$eid)
{
    mysqli_query($conn,"DELETE FROM etudiant WHERE eid ='$eid'"); 
}	

?>