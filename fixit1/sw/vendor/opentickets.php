<?php
include '../../dbconnect9.php';
session_start();
$email = $_SESSION['vendor_user'];
$log_res=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_email`='$email'");
$rows1=mysqli_num_rows($log_res);
if ((!isset($_SESSION['vendor_user'])) OR ($rows1 == 0)){
  header("Location: ../../");
}
$log_row=mysqli_fetch_array($log_res);
$log_name=$log_row['vendor_name'];

$op_tickets_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `vendor` = '$log_name' AND `status` !='Deleted' AND `status` != 'Closed' AND `status` != 'New'");
$op_tickets_num_rows=mysqli_num_rows($op_tickets_res);
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
                            <img alt="image" class="img-circle" src="../../profileimg/vendor/<?php echo !empty($log_row['profilepic']) ? $log_row['profilepic'] : 'deafult.png'; ?>?rd=<?php echo rand();?>" height="100px" width="100px"/>

                             </span>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $log_name; ?></strong>
                             </span> <span class="text-muted text-xs block">Profil<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">LOGGA OUT</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            IN+
                        </div>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ärendehantering</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="opentickets.php">Öppna<span class="label label-success pull-right">
                            <?php echo $op_tickets_num_rows; ?></span></a></li>
                        </ul>
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
        <?php
        $alert_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status`='Assigned to: $log_name' LIMIT 4");
        $alert_num_rows=mysqli_num_rows($alert_res);
        ?>
            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $alert_num_rows; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                            <?php
                            
                            while($alert_row=mysqli_fetch_array($alert_res)){
                                $al_ticket_id=$alert_row['ticket_id'];
                                $created_on=$alert_row['created_on'];
                                $created_on=substr($created_on,0,10);
                                echo '<li><a href="ticketedit.php?ticket_id=' . $al_ticket_id . '"><div><i class="fa fa-envelope fa-ticket"></i>' . $al_ticket_id . '<span class="pull-right text-muted small">' . $created_on . '</span></div></a></li><li class="divider"></li>';
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
                    <h2>Öppna</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Hem</a>
                        </li>
                        <li>
                            <a>Ärendehantering</a>
                        </li>
                        <li class="active">
                            <strong>Öppna</strong>
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
                        <h5>Öppna</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-bordered dataTables-example" >
                    <thead>
                    <tr>
                        <th>Ärende ID</th>
                        <th>Namn</th>
                        <th>Telefon Nr.</th>
                        <th>Läge</th>
                        <th>Öppnat när</th>
                        <th>Status</th>
                        <th style="width: 80px;">Redigera</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">
                    <?php
            while($row = mysqli_fetch_array($op_tickets_res)){
              $ticket_id=$row['ticket_id'];
              $status=$row['status'];
              $tb_color='';
              $status1=substr($status, 0,3);
              if ($status1 == 'Acc'){
                $tb_color='#ceefd8';
              }else if($status1 == 'Ass'){
                $tb_color='#cee8ef';
              }
              else if($status1 == 'Rej'){
                $tb_color='#f4cdcd';
              }else if($status1 == 'Inv'){
                $tb_color='#f7dfc0';
              }if($status1 == 'Wor'){
                $tb_color='#c0d0f7';
              }
              $created_on=$row['created_on'];
                $current_date = date("Y-m-d");
              //$ticket_age=$current_date-$created_on;
              $created_on1=substr($created_on,0,10);
              $date1=date_create($created_on1);
              $date2=date_create($current_date);
              $diff=date_diff($date1,$date2);
              $ticket_age=$diff->format("%a");

              $ini_email=$row['ini_email'];
              echo "<tr bgcolor='".$tb_color."' style='cursor: pointer;'>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['ticket_id']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['ini_name']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">"."+46".$row['ini_phone']."</td>              
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['service']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$created_on1." - ".$ticket_age."days</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$status."</td>
              <td>
              
              <a href='#Accept' data-toggle='modal' data-hover='tooltip' title='Accept Ticket' data-placement='top' data-whatever='".$row[ 'ticket_id']. "' class='btn btn-primary btn-circle btn-outline'><i class='fa fa-check fa-lg'></i></a>

              <a href='#Giveup' data-toggle='modal' data-hover='tooltip' title='Reject Ticket' data-placement='top' data-whatever='".$row[ 'ticket_id']. "' class='btn btn-danger btn-circle btn-outline'><i class='fa fa-close fa-lg'></i></a>
              </td></tr>";
            }
            ?>
                    </tbody>
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
<!--=============================Ticket accept Modal====================-->
<div class="modal fade" id="Accept" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="CloseLabel">Acceptera</h4>
            </div>
            <form id="closeformdata">
                <div class="modal-body">
                    <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                    <input type="hidden" name="ticketaccept" class="form-control" id="recipient-name">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Kommentera:</label>
                        <textarea class="form-control" name="comment" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Stäng</button>
                    <input type="submit" value="send" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#Accept").on("show.bs.modal",function(e){var a=$(e.relatedTarget),t=a.data("whatever"),o=$(this);o.find(".modal-body input").val(t)});
</script>

<?php
if (isset($_GET[ 'ticketaccept']) AND isset($_GET[ 'ticket_id'])){
  $ticket_id=$_GET[ 'ticket_id'];   
  $comments=$_GET[ 'comment']; 
  $status="Accepted by - ".$log_name ; 

  $test_res=mysqli_query($conn,"UPDATE `tickets` SET `status`='$status' WHERE `ticket_id`='$ticket_id'"); 
  print_r($test_res);
    $his_time = date("Y-m-d h:i:s");
  mysqli_query($conn, "INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Closed by Vendor - $vendor_email')"); 
  if($comments != ''){
    mysqli_query($conn, "INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$log_name','$comments','$his_time')"); 
  }
echo '<script>window.location = "opentickets.php" </script>';
}
?>
<!--=============================Ticket giveup Modal====================-->
<div class="modal fade" id="Giveup" role="dialog" aria-labelledby="DeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Delete">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="DeleteLabel">Avbryt jobbet</h4>
            </div>
            <form id="deleteformdata">
                <div class="modal-body">
                    <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                    <input type="hidden" name="ticketgiveup" class="form-control" id="recipient-name">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Kommentera:</label>
                        <textarea class="form-control" name="comment" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Avbryt</button>
                    <input id="subscribe-email-submit" type="submit" value="send" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#Giveup").on("show.bs.modal",function(e){var a=$(e.relatedTarget),t=a.data("whatever"),o=$(this);o.find(".modal-body input").val(t)});
</script>
<?php
if (isset($_GET[ 'ticketgiveup']) AND isset($_GET[ 'ticket_id'])){
  $ticket_id=$_GET[ 'ticket_id'];
  $comments=$_GET[ 'comment'];
  $status="Rejected by - ".$log_name ;
    $closed_on = date("Y-m-d h:i:s");
    mysqli_query($conn, "UPDATE `tickets` SET `status`='$status', `vendor`='' WHERE `ticket_id`='$ticket_id'");
    $his_time = date("Y-m-d h:i:s");
  mysqli_query($conn, "INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Rejected by - $vendor_email')"); 
  if($comments != ''){
    mysqli_query($conn, "INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$log_name','$comments','$his_time')"); 
  }
echo '<script>window.location = "opentickets.php" </script>';
}
?>
<!--=============================Ticket giveup Modal ends====================-->
<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>