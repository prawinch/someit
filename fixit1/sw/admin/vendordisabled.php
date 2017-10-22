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
                             </span> <span class="text-muted text-xs block">Profil<b class="caret"></b></span> </span>
                            </a>
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
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ärendehantering</span><span
                                    class="fa arrow"></span></a>
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
                    <li class="active">
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">FS Administration</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="addvendor.php">Lägg Till</a></li>
                            <li><a href="vendorlist.php">Lista</a></li>
                            <li><a href="vendordisabled.php">Inaktiva</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label">Fakturering</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="invoicerequest.php">Inkorg</a></li>
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
                                $current_date = date("Y-m-d", time());
                                $ticket_age=$current_date-$created_on;
                                $created_on1=substr($created_on,0,10);
                                echo '<li><a href="ticketedit.php?ticket_id=' . $al_ticket_id . '"><div><i class="fa fa-envelope fa-ticket"></i>' . $al_ticket_id . '<span class="pull-right text-muted small">' . $created_on1 . '</span></div></a></li><li class="divider"></li>';
                            } 
                            ?>
                        <li>
                            <div class="text-center link-block">
                                <a href="opentickets.php">
                                    <strong>See alla</strong>
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
                    <h2>Inaktiva</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Hem</a>
                        </li>
                        <li>
                            <a>FS</a>
                        </li>
                        <li class="active">
                            <strong>Inaktiva</strong>
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
                        <h5>Inaktiva FS</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>FS Namn</th>
                        <th>Telefon Nr.</th>
                        <th>E-postadress</th>
                        <th>Status</th>
                        <th>Redigera</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">
             <?php
          //check if the starting row variable was passed in the URL or not
          if (!isset($_GET['startrow']) or !is_numeric($_GET['startrow'])) {
          //we give the value of the starting row to 0 because nothing was found in URL
          $startrow = 0;
          //otherwise we take the value from the URL
          } else if (isset($_GET['startrow']) and is_numeric($_GET['startrow'])){
          $startrow = (int)$_GET['startrow'];
          }

            $result=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_status`='Disabled'");
            while($row = mysqli_fetch_array($result)){
              $vendor_name=$row['vendor_name'];
              $vendor_email=$row['vendor_email'];
              $vendor_status=$row['vendor_status'];
              echo "<tr style='cursor: pointer;'>
              <td onclick=\"window.document.location='vendoredit.php?vendor_name=$vendor_name&vendor_email=$vendor_email'\">".$row['vendor_name']."</td>
              <td onclick=\"window.document.location='vendoredit.php?vendor_name=$vendor_name&vendor_email=$vendor_email'\">".$row['vendor_phone']."</td>
              <td onclick=\"window.document.location='vendoredit.php?vendor_name=$vendor_name&vendor_email=$vendor_email'\"><a href=mailto:".$vendor_email.">".$vendor_email."</a></td>
              <td onclick=\"window.document.location='vendoredit.php?vendor_name=$vendor_name&vendor_email=$vendor_email'\">".$vendor_status."</td>
              <td>
              <a class='btn btn-success btn-circle btn-outline' data-toggle='modal' href='vendordisabled.php?vendor_name=$vendor_name&enabled=true'><i class='fa fa-check'></i></a>
              <a class='btn btn-danger btn-circle btn-outline' data-toggle='modal' href=''><i class='fa fa-trash-o'></i></a> 
              </td></tr>";
            }
            ?>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </div>

        <div class="footer">            
            <div>
                <strong>Copyright</strong> Fixit &copy; 2017 | Utvecklad av reitsolution.se
            </div>
        </div>

        </div>
        </div>

<?php
if (isset($_GET[ 'vendor_name']) AND isset($_GET[ 'enabled'])){
  $vendor_name=$_GET[ 'vendor_name']; 
  $status="Enabled" ; 
  mysqli_query($conn, "UPDATE `vendors` SET `vendor_status`='$status' WHERE `vendor_name`='$vendor_name'"); 
  ?>
  <script type="text/javascript">
        window.location = "vendorlist.php";
        </script>
<?php
}
?>


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