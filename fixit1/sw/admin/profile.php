<?php
include '../../dbconnect9.php';
session_start();
$email = $_SESSION['admin_user'];
$log_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE `email`='$email'");
$rows1=mysqli_num_rows($log_res);
if ((!isset($_SESSION['admin_user'])) OR ($rows1 == 0)){
  header("Location: ../../");
}
$log_row=mysqli_fetch_array($log_res);
$log_name=$log_row['firstname'];
$op_tickets_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` != 'Closed' AND `status` !='Deleted'");
$op_tickets_num_rows=mysqli_num_rows($op_tickets_res);
$cl_tickets_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` = 'Closed'");
$cl_tickets_num_rows=mysqli_num_rows($cl_tickets_res);
$del_tickets_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` = 'Deleted'");
$del_tickets_num_rows=mysqli_num_rows($del_tickets_res);
?>
<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>FiXiT | Your Problem Our Solution</title>

    <link href="../../global/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../global/font-awesome/css/font-awesome.css" rel="stylesheet">

    <!-- Toastr style -->
    <link href="../../global/css/plugins/toastr/toastr.min.css" rel="stylesheet">

    <!-- Gritter -->
    <link href="../../global/js/plugins/gritter/jquery.gritter.css" rel="stylesheet">

    <link href="../../global/css/animate.css" rel="stylesheet">
    <link href="../../global/css/style.css" rel="stylesheet">

    <link href="../../global/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
</head>

<body>
    <div id="wrapper">
        <nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav metismenu" id="side-menu">
                    <li class="nav-header">
                        <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="../../profileimg/admin/<?php echo !empty($log_row['profilepic']) ? $log_row['profilepic'] : 'deafult.png'; ?>?rd=<?php echo rand();?>" height="100px" width="100px"/>
                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $log_name; ?></strong>
                             </span> <span class="text-muted text-xs block">Profil<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">LOGGA UT</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            FiXiT
                        </div>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="opentickets.php">Öppna<span class="label label-success pull-right">
                            <?php echo $op_tickets_num_rows; ?></span></a></li>
                            <li><a href="closedtickets.php">Stängda<span class="label label-success pull-right">
                            <?php echo $cl_tickets_num_rows; ?></span></a></li>
                            <li><a href="deletedtickets.php">Borttagna<span class="label label-success pull-right">
                            <?php echo $del_tickets_num_rows; ?></span></a></li>
                            <li><a href="tickethistory.php">Historik</a></li>
                            <li><a href="ticketcreate.php">Skapa Nytt</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Vendor Management</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="addvendor.php">Lägg Till</a></li>
                            <li><a href="vendorlist.php">Lista</a></li>
                            <li><a href="vendordisabled.php">Inaktiva</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label">Fakturering</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="invoicerequest.php">Invoice Requested</a></li>
                            <li><a href="invoices.php">Lista</a></li>
                            <li><a href="minvoice.php">Skapa Faktura</a></li>
                            <li><a href="invoicegraph.php">Statistik</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="services.php"><i class="fa fa-cog"></i> <span class="nav-label">Tjänster</span></a>
                    </li>
                </ul>
            </div>
        </nav>

        <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
        <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            
        </div>
            <ul class="nav navbar-top-links navbar-right">
                
                <ul class="nav navbar-top-links navbar-right">
                <?php
                $alert_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` = 'New' LIMIT 4");
                $alert_num_rows=mysqli_num_rows($alert_res);
                ?>
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $alert_num_rows; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        
                        <?php
                            
                            while($alert_row=mysqli_fetch_array($alert_res)){
                                $al_ticket_id=$alert_row['ticket_id'];
                                $created_on=$alert_row['created_on'];
                                $current_date=date("d-m-Y",time());
                                $ticket_age=$current_date-$created_on;
                                $created_on1=substr($created_on,0,10);
                                echo '<li><a href="#"><div><i class="fa fa-envelope fa-ticket"></i>'.$al_ticket_id.'<span class="pull-right text-muted small">'.$created_on1.'</span></div></a></li><li class="divider"></li>';
                            } 
                            ?>
                        <li>
                            <div class="text-center link-block">
                                <a href="opentickets.php">
                                    <strong>Se Alla Varningar</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> LOGGA UT
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Profile</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">HEM</a>
                        </li>
                        <li class="active">
                            <strong>Profil</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profil Redigering</h5>                        
                    </div>

                    <div class="ibox-content">
                        <form class="form-horizontal" action="profile.php" method="POST" enctype = "multipart/form-data">
                            <input type="hidden" name="userid" value="<?php echo $log_row['userid'];?>">                                
                                <div class="form-group"><label class="col-lg-3 control-label">Profil Bild</label>
                                    <div class="col-lg-9 profile-image">
                                    <img src="../../profileimg/admin/<?php echo $log_row['profilepic'];?>?rd=rd=<?php echo rand();?>" class="img-circle circle-border m-b-md" alt="profile">
                                    Byt
                                    <input type="file" name="image">
                                    </div>
                                    
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Epostadress</label>
                                    <div class="col-lg-4"><input type="text" class="form-control" name="email" value="<?php echo $log_row['email'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Förnamn</label>
                                    <div class="col-lg-4"><input type="text" class="form-control" name="firstname" value="<?php echo $log_row['firstname'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Efternamn</label>
                                    <div class="col-lg-4"><input type="text" class="form-control" name="lastname" value="<?php echo $log_row['lastname'];?>" required>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Lösenord</label>
                                    <div class="col-lg-4"><input type="password" class="form-control" name="Password" value="" placeholder="password">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-3">
                                        <button class="btn btn-white" type="reset" onclick="javascript:window.location='dashboard.php';">Avbryt</button>
                                        <button class="btn btn-primary" name="update" type="submit">Spara Ändring</button>
                                    </div>
                                </div>
                            </form>                        

                    </div>
                </div>
            </div>
            </div>
        </div>
<?php
if(isset($_POST['update']) ){
        $userid=$_POST['userid'];
        $email=$_POST['email'];
        $firstname=$_POST['firstname'];
        $lastname=$_POST['lastname'];
        $password=$_POST['password'];

//File upload starts here

  if(is_uploaded_file($_FILES['image']['tmp_name'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));      
      $extensions= array("jpeg","jpg","png");      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 26214400){
         echo 'File size must be excately 2 MB';
         exit();
      }
      
      if(empty($errors)==true){
        $new_file_name=$userid.".".$file_ext;
         move_uploaded_file($file_tmp,"../../profileimg/admin/".$new_file_name);
      }else{
         echo "Please check the file you are trying to upload";
         exit();
      }
   }else{
    $profilepic_res=mysqli_query($conn,"SELECT `profilepic` FROM `admin-user` WHERE `userid`='$userid'");
    $profilepic_row=mysqli_fetch_array($profilepic_res);
    $new_file_name=$profilepic_row['profilepic'];
   }
   //File upload ends here
        if($password == ''){
            mysqli_query($conn,"UPDATE `admin-user` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email', `profilepic`='$new_file_name' WHERE `userid`='$userid'");
        }else{
            mysqli_query($conn,"UPDATE `admin-user` SET `firstname`='$firstname',`lastname`='$lastname',`email`='$email',`password`='$password' , `profilepic`='$new_file_name' WHERE `userid`='$userid'");    
        }
        
        echo '<script type="text/javascript">window.document.location = "profile.php";</script>';
}
?>

        <div class="footer">            
            <div>
                <strong>Copyright</strong> Fixit &copy; 2017 | Developed by reitsolution.se
            </div>
        </div>

        </div>
        </div>



    <!-- Mainly scripts -->
    <script src="../../global/js/jquery-3.1.1.min.js"></script>
    <script src="../../global/js/bootstrap.min.js"></script>
    <script src="../../global/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../global/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="../../global/js/plugins/dataTables/datatables.min.js"></script>
    <!-- Toastr script -->
    <script src="../../global/js/plugins/toastr/toastr.min.js"></script>


    <!-- Custom and plugin javascript -->
    <script src="../../global/js/inspinia.js"></script>
    <script src="../../global/js/plugins/pace/pace.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

        });

    </script>

</body>

</html>

<!-- Localized -->
