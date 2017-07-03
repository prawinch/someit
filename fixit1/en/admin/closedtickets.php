<?php
include '../../dbconnect9.php';
include "../../phpmailer/class.phpmailer.php";
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
                             </span> <span class="text-muted text-xs block">profile<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Profile</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        <div class="logo-element">
                            FiXiT
                        </div>
                    </li>
                    <li>
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li class="active">
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="opentickets.php">Open Tickets<span class="label label-success pull-right">
                            <?php echo $op_tickets_num_rows; ?></span></a></li>
                            <li><a href="closedtickets.php">Closed Tickets<span class="label label-success pull-right">
                            <?php echo $cl_tickets_num_rows; ?></span></a></li>
                            <li><a href="deletedtickets.php">Deleted Tickets<span class="label label-success pull-right">
                            <?php echo $del_tickets_num_rows; ?></span></a></li>
                            <li><a href="tickethistory.php">Ticket History</a></li>
                            <li><a href="ticketcreate.php">Create New Ticket</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">Vendor Management</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="addvendor.php">Add Vendor</a></li>
                            <li><a href="vendorlist.php">Vendor List</a></li>
                            <li><a href="vendordisabled.php">Disabled Vendors</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label">Invoices</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="invoicerequest.php">Invoice Requested</a></li>
                            <li><a href="invoices.php">Invoices List</a></li>
                            <li><a href="minvoice.php">Create Invoice</a></li>
                            <li><a href="invoicegraph.php">Invoice Statistics</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="services.php"><i class="fa fa-cog"></i> <span class="nav-label">Services</span></a>
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
                                $current_date=date("d-m-Y",time());
                                $ticket_age=$current_date-$created_on;
                                $created_on1=substr($created_on,0,10);
                                $current_date=date("d-m-Y",time());
                                $ticket_age=$current_date-$created_on;
                                $created_on1=substr($created_on,0,10);
                                echo '<li><a href="#"><div><i class="fa fa-envelope fa-ticket"></i>'.$al_ticket_id.'<span class="pull-right text-muted small">'.$created_on1.'</span></div></a></li><li class="divider"></li>';
                            } 
                            ?>
                        <li>
                            <div class="text-center link-block">
                                <a href="opentickets.php">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>


                <li>
                    <a href="logout.php">
                        <i class="fa fa-sign-out"></i> Log out
                    </a>
                </li>
            </ul>

        </nav>
        </div>
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Tickets</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Home</a>
                        </li>
                        <li>
                            <a>Tickets</a>
                        </li>
                        <li class="active">
                            <strong>Closed Tickets</strong>
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
                        <h5>Closed Tickets</h5>
                        
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr>
                        <th>Ticket ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Services</th>
                        <th>Creation Date & Age</th>
                        <th>Status</th>
                        <th style="width: 50px;">Edit</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">
            <?php
            
            while($row = mysqli_fetch_array($cl_tickets_res)){
              $ticket_id=$row['ticket_id'];
              //if($row['vendor'] !=''){
                $status=$row['status'];
              //}else{
                //$status="New";
              //}
              $created_on=$row['created_on'];
              $current_date=date("d-m-Y");
              //$ticket_age=$current_date-$created_on;
              $created_on1=substr($created_on,0,10);
              $date1=date_create($created_on1);
              $date2=date_create($current_date);
              $diff=date_diff($date1,$date2);
              $ticket_age=$diff->format("%a");

              $ini_email=$row['ini_email'];
              echo "<tr style='cursor: pointer;'>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['ticket_id']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['ini_name']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">"."+46".$row['ini_phone']."</td>        
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$row['service']."</td>
              <td onclick=\"window.document.location='ticketedit.php?ticket_id=$ticket_id'\">".$created_on1." - ".$ticket_age." days</td>
              <td>".$status."</td>
              <td>
              <a href='#Delete' data-toggle='modal' data-hover='tooltip' title='Delete Ticket' data-placement='top' data-whatever='".$row[ 'ticket_id']. "' class='btn btn-danger btn-circle btn-outline'><span class='glyphicon glyphicon-trash'></a>

              <a href='#Reopen' data-toggle='modal' data-hover='tooltip' title='Reopen Ticket' data-placement='top' data-whatever='".$row[ 'ticket_id']. "' class='btn btn-primary btn-circle btn-outline'><span class='glyphicon glyphicon-folder-open'></a>
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
                <strong>Copyright</strong> Fixit &copy; 2017 | Developed by qa-masters.com
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
                "order": [[ 5, "desc" ]]
            });

        });

    </script>

</body>

</html>

<!-- Localized -->


<!--=============================Ticket Delete Modal====================-->
<div class="modal fade" id="Delete" tabindex="-1" role="dialog" aria-labelledby="DeleteLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Delete">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="DeleteLabel">Delete the Ticket</h4>
            </div>
            <form id="deleteformdata">
                <div class="modal-body">
                    <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                    <input type="hidden" name="ticketdelete" class="form-control" id="recipient-name">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Comment:</label>
                        <textarea class="form-control" name="comment" minlength=10 id="message-text" required=""></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input id="subscribe-email-submit" type="submit" value="send" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#Delete").on("show.bs.modal",function(e){var a=$(e.relatedTarget),t=a.data("whatever"),o=$(this);o.find(".modal-body input").val(t)}),$(function(){$("#subscribe-email-form").on("submit",function(e){e.preventDefault(),$.ajax({url:"opentickets.php",type:"GET",data:$("#subscribe-email-form").serialize(),success:function(e){$("#Delete").modal("toggle")}})})});
</script>
<?php
if (isset($_GET[ 'ticketdelete']) AND isset($_GET[ 'ticket_id'])){
  $ticket_id=$_GET[ 'ticket_id']; 
  $comments=$_GET[ 'comment']; 
  $status="Deleted" ; 
  $closed_on=date( "d-m-Y h:i:s");
  mysqli_query($conn, "UPDATE `tickets` SET `status`='$status', `closed_on`='$closed_on' WHERE `ticket_id`='$ticket_id'"); 
  $his_time=date( "d-m-Y h:i:s"); 
  mysqli_query($conn, "INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Closed by Admin - $email')"); 
  if($comments != ''){
    mysqli_query($conn, "INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$log_name','$comments','$his_time')"); 
  }

  $mail_res=mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
  $mail_row=mysqli_fetch_array($mail_res);
  $ini_name=$mail_row['ini_name'];
  $ini_phone=$mail_row['ini_phone'];
  $ini_email=$mail_row['ini_email'];

          //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/fixit1/sw';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Your Ticket has been Deleted by admin!<br><br> Your unique tracking code is '.$ticket_id.'<br><br>';
          $message .= 'Phone number associated with this ticket is '.$ini_phone.'<br><br>';
          $message .= 'Track your ticket at <a href="'.$url.'/track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'">'.$url.'/track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'</a><br><br>';
          $message .= 'Regards,<br>Fixit<br><br>For any queries please contact us at +46-9999999<br></body></html>';

          // php mailer code starts
          $mail = new PHPMailer(true);
          $mail->IsSMTP(); // telling the class to use SMTP
          $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
          $mail->SMTPAuth = true;                  // enable SMTP authentication
          $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
          $mail->Host = "mailout.one.com";      // sets GMAIL as the SMTP server
          $mail->Port = 587;                   // set the SMTP port for the GMAIL server
          $mail->Username = 'noreplay@reitsolution.se';
          $mail->Password = 'India2017';
          $mail->SetFrom('noreplay@reitsolution.se', 'FiXiT');
          $mail->AddAddress($ini_email);

          $ven_usr_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
          $ven_usr_row=mysqli_fetch_array($ven_usr_res);
          $vendor=$ven_usr_row['vendor'];
          $ven_usr_res1=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_name`='$vendor'");
          $ven_usr_row1=mysqli_fetch_array($ven_usr_res1);
          $vendor_email=$ven_usr_row1['vendor_email'];
          if($vendor_email){
            $mail->addBCC($vendor_email);
          }
          $ad_usr_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE 1");
          while($ad_usr_row=mysqli_fetch_array($ad_usr_res)){
            $mail->addBCC($ad_usr_row['email']);
          }

          $mail->Subject = trim("[Ticket: ".$ticket_id." ]");
          $mail->MsgHTML($message);
          //$mail->SMTPDebug = 2;
          try {
            $mail->send();
            $msg = "An email has been sent for verfication.";
            $msgType = "success";
          } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msgType = "warning";
          }

  ?>
  <script type="text/javascript">window.document.location = "deletedtickets.php"</script>
<?php
}
?>
<!--=============================Ticket Reopen Modal====================-->
<div class="modal fade" id="Reopen" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="Reopen">Reopen the Ticket</h4>
            </div>
            <form id="reopenformdata" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="ticket_id" class="form-control" id="recipient-name">
                    <input type="hidden" name="ticketreopen" class="form-control" id="recipient-name">
                    <div class="form-group">
                        <label for="message-text" class="control-label">Comment:</label>
                        <textarea class="form-control" name="comment" id="message-text"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input id="subscribe-email-submit" type="submit" value="send" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
$("#Reopen").on("show.bs.modal",function(e){var a=$(e.relatedTarget),t=a.data("whatever"),o=$(this);o.find(".modal-body input").val(t)}),$(function(){$("#subscribe-email-form").on("submit",function(e){e.preventDefault(),$.ajax({url:"closedtickets.php",type:"GET",data:$("#subscribe-email-form").serialize(),success:function(e){$("#Reopen").modal("toggle")}})})});
</script>

<?php
if (isset($_POST[ 'ticketreopen']) AND isset($_POST[ 'ticket_id'])){
  $ticket_id=$_POST[ 'ticket_id']; 
  $comments=$_POST[ 'comment']; 
  $status="New" ; 

  $closed_on=date( "d-m-Y h:i:s");
  mysqli_query($conn, "UPDATE `tickets` SET `status`='$status', `closed_on`='$closed_on' WHERE `ticket_id`='$ticket_id'"); $his_time=date( "d-m-Y h:i:s"); 
  mysqli_query($conn, "INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Closed by Admin - $email')"); 
  if($comments != ''){
    mysqli_query($conn, "INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$log_name','$comments','$his_time')"); 
  }
  $mail_res=mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
  $mail_row=mysqli_fetch_array($mail_res);
  $ini_name=$mail_row['ini_name'];
  $ini_phone=$mail_row['ini_phone'];
  $ini_email=$mail_row['ini_email'];
          //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/fixit1/sw';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Admin Re-opened your ticket - '.$ticket_id.'<br><br>';
          $message .= 'Phone number associated with this ticket is '.$ini_phone.'<br><br>';
          $message .= 'Track your ticket at <a href="'.$url.'/track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'">'.$url.'/track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'</a><br><br>';
          $message .= 'Regards,<br>Fixit<br><br>For any queries please contact us at +46-9999999<br></body></html>';

          // php mailer code starts
          $mail = new PHPMailer(true);
          $mail->IsSMTP(); // telling the class to use SMTP
          $mail->SMTPDebug = 0;                     // enables SMTP debug information (for testing)
          $mail->SMTPAuth = true;                  // enable SMTP authentication
          $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
          $mail->Host = "smtp.gmail.com";      // sets GMAIL as the SMTP server
          $mail->Port = 465;                   // set the SMTP port for the GMAIL server
          $mail->Username = 'noreplyfixit.se@gmail.com';
          $mail->Password = 'Pra@ch99';
          $mail->SetFrom('noreplyfixit.se@gmail.com', 'FiXiT');
          $mail->AddAddress($ini_email);

          $ven_usr_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
          $ven_usr_row=mysqli_fetch_array($ven_usr_res);
          $vendor=$ven_usr_row['vendor'];
          $ven_usr_res1=mysqli_query($conn,"SELECT * FROM `vendors` WHERE `vendor_name`='$vendor'");
          $ven_usr_row1=mysqli_fetch_array($ven_usr_res1);
          $vendor_email=$ven_usr_row1['vendor_email'];
          if($vendor_email){
            $mail->addBCC($vendor_email);
          }
          $ad_usr_res=mysqli_query($conn,"SELECT * FROM `admin-user` WHERE 1");
          while($ad_usr_row=mysqli_fetch_array($ad_usr_res)){
            $mail->addBCC($ad_usr_row['email']);
          }
          
          $mail->Subject = trim("[Ticket: ".$ticket_id." ]");
          $mail->MsgHTML($message);
          try {
            $mail->send();
            $msg = "An email has been sent for verfication.";
            $msgType = "success";
          } catch (Exception $ex) {
            $msg = $ex->getMessage();
            $msgType = "warning";
          }

  ?>
  <script type="text/javascript">window.document.location = "opentickets.php"</script>
<?php
}
?>
<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>