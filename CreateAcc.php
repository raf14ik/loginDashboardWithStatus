<?php include('inc/main.php');
      include('inc/student.php');
      include('codes/config.php');
      if(isset($_POST["rpassword"]))
{
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $sname = mysqli_real_escape_string($conn, $_POST['secondname']);
    $spe= mysqli_real_escape_string($conn, $_POST['speciality']);
    $email = mysqli_real_escape_string($conn, $_POST['email']); 
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $rpassword = mysqli_real_escape_string($conn, $_POST['rpassword']); 
    $CreationStudent = CreateEtud($conn,$fname,$sname,$spe,$email,$password,$rpassword);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    <?php echo $softwarename; ?> - Login
  </title>
  <!-- Favicon -->
  <link href="assets/img/brand/favicon.png" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
  <!-- Icons -->
  <link href="assets/js/plugins/nucleo/css/nucleo.css" rel="stylesheet" />
  <link href="assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="assets/css/argon-dashboard.css?v=1.1.0" rel="stylesheet" />
</head>

<body class="bg-default">
  <div class="main-content">
    <!-- Navbar -->
    <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="index.php">
          <img src="assets/img/brand/white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="../index.php">
                  <img src="assets/img/brand/blue.png" />
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="../index.php">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text">Dashboard</span>
              </a>
            </li>
    
          </ul>
        </div>
      </div>
    </nav>
    <!-- Header -->
    <div class="header bg-gradient-primary py-7 py-lg-8">
      <div class="container">
        <div class="header-body text-center mb-7">
          <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
              <h1 class="text-white">Welcome!</h1>
              <p class="text-lead text-light"><?php echo $softwaredescrip; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
          <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
      </div>
    </div>
    <!-- Page content -->
    <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">       
           
            <div class="card-body px-lg-5 py-lg-5">
              <div class="text-center text-muted mb-4">
               Inscription 
              </div>
              <?php
             if(isset($_POST["rpassword"])) 
             {
              if ($_POST['email']==NULL  || $_POST['speciality']==NULL
              || $_POST['secondname']==NULL || $_POST['firstname']==NULL
               ||$_POST["password"]==NULL ||$_POST["rpassword"]==NULL  ){
              echo'<div class="alert alert-danger container" role="alert">
              <strong>Il faut remplir tous les champs</strong> 
              </div> ';
             }
             else if($CreationStudent!=='success')
             {
                echo'<div class="alert alert-danger container" role="alert">
                <strong>Vérifiez la confirmation de mot de passe</strong> 
                </div> ';
              }
              else
              {
                if($CreationStudent=='success')
                {
                  echo '<div class="alert alert-success container" role="alert">
                  <strong>Votre compte a été créé avec succès</strong> 
                  Attendez la vérification de l"administration!
                </div> ';
                }
              }                
             }
             ?>
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
                          </div>
                          <div class="modal-footer text-center">
                            <button type="submit" class="btn btn-primary">S'inscrire</button>
                          </div>
                        </form>
            </div>
          </div>
          <div class="row mt-3">
            <div class="col-6">
              <a href="index.php" class="text-light"><small>Back to sign in </small></a>
            </div>
            <div class="col-6 text-right">
             
            </div>
          </div>
        </div>
      </div>
    </div>
    <footer class="py-5">
      <div class="container">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              © <?php echo date('Y') ?> <a href="#" class="font-weight-bold ml-1" target="_blank"><?php echo $softwarename; ?> </a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
            
            </ul>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!--   Core   -->
  <script src="assets/js/plugins/jquery/dist/jquery.min.js"></script>
  <script src="assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!--   Optional JS   -->
  <!--   Argon JS   -->
  <script src="assets/js/argon-dashboard.min.js?v=1.1.0"></script>
 
</body>

</html>