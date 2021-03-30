<?php include('Components/header.php'); 
if(isset($_POST["password"]))
{
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $sname = mysqli_real_escape_string($conn, $_POST['secondname']);
    $spe= mysqli_real_escape_string($conn, $_POST['speciality']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rpassword = mysqli_real_escape_string($conn, $_POST['rpassword']); 
    $studid = mysqli_real_escape_string($conn, $_POST['studid']);       
    $updatepassword = ChangeDetail($conn,$studid,$fname,$sname,$spe,$email,$password,$rpassword);
}
if(isset($_POST["stt"]))
{
    $stt = mysqli_real_escape_string($conn, $_POST['stt']);
    $studid = mysqli_real_escape_string($conn, $_POST['studid']);       
    $updatestatus = ChangeStatuts($conn,$studid,$stt);
}
if(isset($_POST["newpassword"]))
{
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $sname = mysqli_real_escape_string($conn, $_POST['secondname']);
    $spe= mysqli_real_escape_string($conn, $_POST['speciality']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $newpassword = mysqli_real_escape_string($conn, $_POST['newpassword']);       
    CreateEtud($conn,$fname,$sname,$spe,$email,$newpassword);
}

$delstudent =htmlentities($_GET['stid']);
if($delstudent!=NULL){
DeleteStudent($conn,$delstudent); } 
?>
    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
      <div class="container-fluid">
        <div class="header-body">
         
         
        </div>
      </div>
    </div>
    <div class="container-fluid mt--7">
      <!-- Table -->
      <div class="row">
        <div class="col">
         <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Liste des étudiant</h3>
                </div>
                <div class="col text-right">
                  <a href="#" data-toggle="modal" data-target="#newadmin" class="btn btn-sm btn-primary">Ajouter nouveau étudiant</a>
                </div>
              </div>
            </div>
            <?php
             if(isset($_POST["newpassword"])) 
             {
               if ($_POST["newpassword"]==NULL || $_POST['email']==NULL 
               || $_POST['speciality']==NULL || $_POST['secondname']==NULL 
               || $_POST['firstname']==NULL )
               {
                echo'<div class="alert alert-danger container" role="alert">
                <strong>Il faut remplir tous les champs</strong> 
                </div> ';
               }
                else
                {
  
                      echo '<div class="alert alert-success container" role="alert">
                               <strong>Un nouveau etudiant est ajouté</strong> 
                               avec Succès !
                             </div> ';
                  
                }
             }
               if(isset($_POST["password"])) 
               {
                 if ($_POST['email']==NULL  || $_POST['speciality']==NULL
                  || $_POST['secondname']==NULL || $_POST['firstname']==NULL
                   ||$_POST["password"]==NULL ||$_POST["rpassword"]==NULL  ){
                  echo'<div class="alert alert-danger container" role="alert">
                  <strong>Il faut remplir tous les champs</strong> 
                  </div> ';
                 }
                 else if($updatepassword!=='success')
                 {
                    echo'<div class="alert alert-danger container" role="alert">
                    <strong>Vérifiez la confirmation de mot de passe</strong> 
                    </div> ';
                  }
                  else
                  {
                    if($updatepassword=='success')
                    {
                        echo '<div class="alert alert-success container" role="alert">
                                 <strong>Mot de passe est modifié</strong> 
                                 avec Succès !
                               </div> ';
                    }
                  }
               }
            ?>
            <div class="table-responsive">
              <!-- Projects table -->
              <table id="" class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                  <th scope="col">Code étudiant</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Spécialité</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Date de création</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $studsdata= GetStudList($conn); 
                    foreach($studsdata as $stu) {
                    
                  ?>
                  <tr>
                    <th scope="row">
                     <?php echo $stu['eid']; ?>
                    </th>
                    <td>
                      <?php echo $stu['firstname']; ?>
                    </td>
                    <td>
                      <?php echo $stu['secondname']; ?>
                    </td>
                    <td>
                      <?php echo $stu['speciality']; ?>
                    </td>
                    <td>
                      <?php echo $stu['email']; ?>
                    </td>                             
                    <td>
                      <?php echo $stu['created']; ?>
                    </td>
                    <td>
                      <?php 
                      if($stu['status']==1){
                        echo 'Actif';
                      } else {
                        echo'Désactivé';
                      }
                      ?>
                      <a href="#" data-toggle="modal" data-target="#studentstt<?php echo $stu['eid']; ?>"><i class="ni ni-settings text-info mr-2"></i></a>
                    </td>
                    <td>
                     <a href="#" data-toggle="modal" data-target="#studentsetting<?php echo $stu['eid']; ?>"><i class="ni ni-settings text-info mr-2"></i></a>                     
                     <a href="?stid=<?php echo $stu['eid']; ?>" onclick="return confirm('Êtes-vous sûr ?');"><i class="ni ni-button-power text-warning"></i></a>
                    </td>
                  </tr>
                  <!-- Modal status -->
                    <div class="modal fade" id="studentstt<?php echo $stu['eid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier l'état d'étudiant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                           <form role="form" action="" method="post">
                            <div class="modal-body">                             
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open">Changer l'état de compte d'étudiant <?php echo $stu['firstname']?> <?php echo $stu['secondname']?> :</i></span>
                                    </div>
                                      <div class="modal-body">
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" name="stt" type="checkbox" id="inlineCheckbox1" value="1">
                                          <label class="form-check-label" for="inlineCheckbox1">Activer</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                          <input class="form-check-input" name="stt" type="checkbox" id="inlineCheckbox1" value="0">
                                          <label class="form-check-label" for="inlineCheckbox1">Désactiver</label>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                                <input type="hidden" value="<?php echo $stu['eid']; ?>" name="studid">
                            </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                     <!-- Modal -->
                    <div class="modal fade" id="studentsetting<?php echo $stu['eid']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier étudiant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form role="form" action="" method="post">
                          <div class="modal-body">                             
                          <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input  class="form-control" name="firstname" placeholder="Prénom"  type="text" value="<?php echo $stu['firstname']; ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input  class="form-control" name="secondname" placeholder="Nom"  type="text" value="<?php echo $stu['secondname']; ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input  class="form-control" name="speciality" placeholder="Spécialité"  type="text" value="<?php echo $stu['speciality']; ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input  class="form-control" name="email" placeholder="Adresse e-mail"  type="email" value="<?php echo $stu['email']; ?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input autocomplete="off" class="form-control" name="password" placeholder="Nouveau mot de passe"  type="password">
                                  </div>
                                </div>
                                 <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input autocomplete="off" class="form-control" name="rpassword" placeholder="Confirmer le mot de passe"  type="password">
                                  </div>
                                </div>
                                <input type="hidden" value="<?php echo $stu['eid']; ?>" name="studid">
                               
                                
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>

                        </div>
                      </div>
                    </div>

                  <?php } ?> 
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

                     <!-- Modal -->
                    <div class="modal fade" id="newadmin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Nouveau étudiant</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                        <form role="form" action="" method="post">
                          <div class="modal-body">                             
                                
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input  class="form-control" name="firstname" placeholder="Prénom"  type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                    </div>
                                    <input  class="form-control" name="secondname" placeholder="Nom"  type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="fas fa-book"></i></span>
                                    </div>
                                    <input  class="form-control" name="speciality" placeholder="Spécialité"  type="text">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input  class="form-control" name="email" placeholder="Adresse e-mail"  type="email">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input autocomplete="off" class="form-control" name="newpassword" placeholder="Mot de passe"  type="password">
                                  </div>
                                </div>                        
                               
                                
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                          </div>
                        </form>

                        </div>
                      </div>
                    </div>

<?php include('Components/footer.php'); ?>    