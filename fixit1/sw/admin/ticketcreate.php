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
                    <li  class="active">
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
                            <strong>Create New Ticket</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
<?php
if(!isset($_POST['create'])){
?>
    <div class="wrapper wrapper-content animated fadeInRight">
    <form class="form-horizontal" action="" method="POST" enctype = "multipart/form-data">
        <div class="row">
            <div class="col-lg-10">            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>                        
                    </div>

                    <div class="ibox-content">
                    
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Initiator Name</label> 
                                <input type="text" name="ini_name" class="form-control" placeholder="Enter Name" required>
                            </div>
                            <div class="col-sm-6"><label>Phone Number</label>
                                <div class="input-group m-b"><span class="input-group-btn">
                                            <a type="button" class="btn btn-primary">+46</a> </span> <input type="number" class="form-control" placeholder="Phone Number" name="ini_phone" required="">
                                        </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Initiator Email</label> 
                                <input type="text" name="ini_email" class="form-control" placeholder="Enter Email" required>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div><!--row ends here-->
        <div class="row">
            <div class="col-lg-10">            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Address Information</h5>                        
                    </div>

                    <div class="ibox-content">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Initiator Address</label> 
                                <input type="text" name="ini_address" class="form-control" placeholder="Address" required>
                            </div>
                            <div class="col-sm-6">
                                <label>Initiator Door Code</label>
                                <input type="text" name="ini_doornum" class="form-control" placeholder="Door Code" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Initiator Type</label> 
                                <select name="ini_type" class="js-example-basic-single js-states form-control" tabindex="-1" required>
                                <option value="select">Select</option>
                                <option value="BRF Owner">BRF Owner</option>
                                <option value="Tenant">Tenant</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Preferred Time</label>
                                <select name="pref_time" class="js-example-basic-single js-states form-control" tabindex="-1" required>
                                <option value="8:00 - 11:00">8:00 - 11:00</option>
                                <option value="9:00 - 12:00">9:00 - 12:00</option>
                                <option value="10:00 - 13:00">10:00 - 13:00</option>
                                <option value="11:00 - 14:00">11:00 - 14:00</option>
                                <option value="12:00 - 15:00">12:00 - 15:00</option>
                                <option value="13:00 - 16:00">13:00 - 16:00</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Keys in Tube</label> 
                                <select name="keys_tube" class="js-example-basic-single js-states form-control" tabindex="-1">
                                <option value="select">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Pets at Home</label>
                                <select name="pets_home" id="pets" class="js-example-basic-single js-states form-control pets" tabindex="-1">
                                <option value="select">Select</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="pets_data" style="display: none;">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <label>Pets Information</label>
                                <input type="text" name="pets_data" value="" class="form-control" placeholder="Pet Details">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--row ends here-->
        <div class="row">
            <div class="col-lg-10">            
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Service Information</h5>                        
                    </div>

                    <div class="ibox-content">
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>Location</label> 
                                <select name="service" onchange="fetch_select(this.value);" class="js-example-basic-multiple js-states form-control" tabindex="-1">  
                                <option value="select">Select</option>
                                <?php
                                $select=mysqli_query($conn,"SELECT DISTINCT `service` FROM `services` WHERE 1");
                                while($service_row=mysqli_fetch_array($select)){
                                    echo "<option value='".$service_row['service']."'>".$service_row['service']."</option>";
                                }?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Problem</label>
                                <select name="sub_service" id="new_select" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                <?php 
                                while($service_row2=mysqli_fetch_array($service_res1)){
                                    echo "<option value='".$service_row2['sub_service']."'>".$service_row2['sub_service']."</option>";
                                        }?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label>Description</label> 
                                <textarea class="form-control" name="description"></textarea>
                            </div>                            
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label>File Upload</label> 
                                <input type="file" name="image">
                            </div>                            
                        </div>
                        
                    </div>
                </div>
            </div>
        </div><!--row ends here-->
        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-3">
                <button class="btn btn-primary" name="create" type="submit">Create Ticket</button>
                <button class="btn btn-white" type="reset" onclick="javascript:window.location='opentickets.php';">Cancel</button>
            </div>
        </div>
        </form>
    </div>

<?php
} else if(isset($_POST['create'])){      
    $ini_name=$_POST['ini_name'];
    $ini_phone=$_POST['ini_phone'];
  //$ini_phone="+46".$ini_phone;
  $ini_email=$_POST['ini_email'];
  $ini_address=$_POST['ini_address'];
  $ini_doornum=$_POST['ini_doornum'];
  $ini_type=$_POST['ini_type'];
  $pref_time=$_POST['pref_time'];
  $keys_tube=$_POST['keys_tube'];
  $pets_home=$_POST['pets_home'];
  $pets_data=$_POST['pets_data'];
  $service=$_POST['service'];
  $sub_service=$_POST['sub_service'];
  $description=$_POST['description'];
  $status="New";
  $ticket_id=strtoupper(uniqid("TKT"));
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
        $timestamp=date('now').time();
        $new_file_name=strtolower($ticket_id).$timestamp.".".$file_ext;
         move_uploaded_file($file_tmp,"uploads/".$new_file_name);
      }else{
         echo "Please check the file you are trying to upload";
         exit();
      }
   }
   //File upload ends here

  $created_on=date("d-m-Y h:i:s");
  $result=mysqli_query($conn,"SELECT `ticket_id` FROM `tickets` WHERE `ticket_id`='$ticket_id'");
  $rows1=mysqli_num_rows($result);
  //echo $rows1;
  if($rows1==0){
  $result1=mysqli_query($conn,"INSERT INTO `tickets`(`ticket_id`, `ini_name`, `ini_phone`, `ini_email`, `ini_address`, `ini_doornum`, `ini_type`, `pref_time`, `keys_tube`, `pets_home`, `pets_data`, `service`, `sub_service`,`description`, `status`, `vendor`, `created_on`) VALUES ('$ticket_id','$ini_name','$ini_phone', '$ini_email','$ini_address','$ini_doornum','$ini_type','$pref_time','$keys_tube','$pets_home', '$pets_data' ,'$service','$sub_service', '$description', $status', '', '$created_on')");
  $his_time=date("d-m-Y h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Created')");
?>
          <div class="alert alert-success">
            <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
            Your Ticket created successfully.</br>
            Ticket ID<strong> <?php echo $ticket_id; ?></strong> </br>
            Phone Number<strong> <?php echo $ini_phone; ?></strong> </br>
            <i>Save this for future reference.</i>
          </div> <!-- /.alert -->
          <?php
          
          //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/fixit1/sw';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Your Ticket has been created Successfully!<br><br> Your unique tracking code is '.$ticket_id.'<br><br>';
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
            if($vendor_email){
            $mail->addBCC($vendor_email);
          }
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
          
      <?php
        } else{
          header("Location: /error.php");
        }
      }//if(isset create) end here
      
      ?>

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
            });

        });

    </script>

</body>

</html>

<!-- Localized -->

<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: '../fetchservice.php',
 data: {
  get_option:val
 },
 success: function (response) {
  document.getElementById("new_select").innerHTML=response; 
 }
 });
}
</script>

<script>
$(document).ready(function(){
  $( "#pets" ).change(function() {
    var x= $("#pets").val();
    if(x=='Yes'){
      $("#pets_data").show();
    }else{
      $("#pets_data").hide();
    }
  });
});
</script>
