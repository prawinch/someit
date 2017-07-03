<?php
include '../../dbconnect9.php';
include "../../phpmailer/class.phpmailer.php";
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
    

    <link href="../../global/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="../../global/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="../../global/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../../global/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../../global/css/style.css" rel="stylesheet">
    <link href="../../global/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">



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
                             </span> <span class="text-muted text-xs block">profile<b class="caret"></b></span> </span> </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li><a href="profile.php">Profil</a></li>
                                <li class="divider"></li>
                                <li><a href="logout.php">LOGGA UT</a></li>
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
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span><span class="fa arrow"></span></a>
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
            <ul class="nav navbar-top-links navbar-right">
                
                <li class="dropdown">
                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell"></i>  <span class="label label-primary"><?php echo $op_tickets_num_rows; ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        
                        <?php
                            $alert_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` = 'New' LIMIT 4");
                            while($alert_row=mysqli_fetch_array($alert_res)){
                                $al_ticket_id=$alert_row['ticket_id'];
                                $created_on=$alert_row['created_on'];
                                $created_on=substr($created_on,0,10);
                                echo '<li><a href="#"><div><i class="fa fa-envelope fa-ticket"></i>'.$al_ticket_id.'<span class="pull-right text-muted small">'.$created_on.'</span></div></a></li><li class="divider"></li>';
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
                    <h2>Tickets</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard.php">Home</a>
                        </li>
                        <li>
                            <a>Tickets</a>
                        </li>
                        <li class="active">
                            <strong>Edit</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
    <?php
      if(isset($_GET['ticket_id'])){
        $ticket_id1=$_GET['ticket_id'];
        $result2=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id1'");
        $rows2=mysqli_num_rows($result2);
        if($rows2 == 1){
          while($rows3=mysqli_fetch_array($result2)){
            $ticket_id=$rows3['ticket_id'];
            $ini_name=$rows3['ini_name'];
            $ini_phone=$rows3['ini_phone'];
            $ini_email=$rows3['ini_email'];
            $ini_address=$rows3['ini_address'];
            $ini_doornum=$rows3['ini_doornum'];
            $ini_type=$rows3['ini_type'];
            $pref_time=$rows3['pref_time'];
            $keys_tube=$rows3['keys_tube'];
            $pets_home=$rows3['pets_home'];
            $pets_data=$rows3['pets_data'];
            $service=$rows3['service'];
            $sub_service=$rows3['sub_service'];
            $description=$rows3['description'];
            $status=$rows3['status'];          
            if($rows3['vendor'] != ''){
              $vendor=$rows3['vendor'];
            }else{
                $vendor='Not Assigned';
            }
          }
      ?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
            <div class="col-lg-7">
                <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>View/Edit Ticket</h5>
                            <div class="ibox-tools">
                                <div class="btn-group">
                                <button data-toggle="dropdown" class="btn btn-primary btn-sm dropdown-toggle" aria-expanded="false">
                                <i class="fa fa-refresh"></i> 
                                Change Status <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo 'changestatus.php?ticket_id='.$ticket_id.'&status=done' ?>">Work Completed</a></li>
                                    <li><a href="<?php echo 'changestatus.php?ticket_id='.$ticket_id.'&status=raiseinvoice' ?>">Raise Invoice</a></li>
                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <form class="form-horizontal" action="ticketedit.php" method="POST" enctype = "multipart/form-data">
                                <div class="form-group"><label class="col-lg-3 control-label">Ticket ID</label>
                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $ticket_id; ?></p><input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Status</label>
                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $status; ?></p>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Vendor</label>
                                    <div class="col-lg-8"><p class="form-control-static"><?php echo $vendor; ?></p>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Name of the Initiator</label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="ini_name" value="<?php echo $ini_name; ?>" >
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-sm-3 control-label">Phone Number</label>

                                    <div class="col-sm-8">
                                        <div class="input-group m-b"><span class="input-group-btn">
                                            <button type="button" class="btn btn-primary">+46</button> </span> <input type="number" class="form-control" name="ini_phone" value="<?php echo $ini_phone; ?>" >
                                        </div>                                        
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Email</label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="ini_email" value="<?php echo $ini_email; ?>" >
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Address</label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="ini_address" value="<?php echo $ini_address; ?>" >
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Door Number</label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="ini_doornum" value="<?php echo $ini_doornum; ?>" >
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Initiator Type</label>
                                    <div class="col-lg-8">
                                    <select class="select2_demo_1 form-control" name="ini_type">
                                        <option value="<?php echo $ini_type; ?>"><?php echo $ini_type; ?></option>
                                        <option value="BRF Owner">BRF Owner</option>
                                        <option value="Tenant">Tenant</option>
                                    </select>
                                    </div>                                    
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Föredragen tid</label>
                                    <div class="col-lg-8">
                                    <select class="select2_demo_1 form-control" name="pref_time">
                                        <option value="<?php echo $pref_time; ?>"><?php echo $pref_time; ?></option>
                                        <option value="8:00 - 11:00">8:00 - 11:00</option>
                                        <option value="9:00 - 12:00">9:00 - 12:00</option>
                                        <option value="10:00 - 13:00">10:00 - 13:00</option>
                                        <option value="11:00 - 14:00">11:00 - 14:00</option>
                                        <option value="12:00 - 15:00">12:00 - 15:00</option>
                                        <option value="13:00 - 16:00">13:00 - 16:00</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Nyckel I Tuben</label>
                                    <div class="col-lg-8">
                                    <select class="select2_demo_1 form-control" name="keys_tube">
                                        <option value="<?php echo $keys_tube; ?>"><?php echo $keys_tube; ?></option>
                                        <option value="Yes">Ja</option>
                                        <option value="No">Nej</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Husdjur</label>
                                    <div class="col-lg-8">
                                    <select class="select2_demo_1 form-control" name="pets_home">
                                    <option value="<?php echo $pets_home; ?>"><?php echo $pets_home; ?></option>
                                    <option value="Yes">Ja</option>
                                    <option value="No">Nej</option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Husdjur Information</label>
                                    <div class="col-lg-8"><input type="text" class="form-control" name="pets_data" value="<?php echo $pets_data; ?>" placeholder="Husdjur Information">
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Location</label>
                                    <div class="col-lg-8">
                                    <select name="service" onchange="fetch_select(this.value);" class="select2_demo_1 form-control">
                                    <option value="<?php echo $service; ?>" selected><?php echo $service; ?></option>
                                    <?php
                                    $select=mysqli_query($conn,"SELECT DISTINCT `service` FROM `services` WHERE 1");
                                    while($service_row=mysqli_fetch_array($select)){
                                        echo "<option value='".$service_row['service']."'>".$service_row['service']."</option>";
                                    }
                                    ?>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Problem</label>
                                    <div class="col-lg-8">
                                    <select name="sub_service" id="new_select" class="select2_demo_1 form-control">
                                    <option value="<?php echo $sub_service; ?>" selected><?php echo $sub_service; ?></option>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Description</label>
                                    <div class="col-lg-8">
                                    <textarea class="form-control" name="description"><?php echo $description; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group"><label class="col-lg-3 control-label">Upload More Files</label>
                                    <div class="col-lg-8"><div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Upload</span><span class="fileinput-exists">Change</span><input type="hidden"><input type="file" name="image"></span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <h4>Images</h4>
                                    </div>                                    
                                </div><hr>                            
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <div class="lightBoxGallery">                                        
                                        <?php
                                        $images = glob("../../uploads/*.*");
                                        $img=0;
                                        foreach($images as $image) {              
                                            $file=substr($image, 14);
                                            $file1=substr( $file, 0, 16 );
                                            //echo $file1." - ".strtolower($ticket_id)."</br>";
                                            if($file1 === strtolower($ticket_id)){
                                                echo '  <a href="'.$image.'"  data-gallery=""><img src="'.$image.'" width="80" height="80"></a>';
                                                $img = $img+1;
                                            }
                                        }
                                        if($img=='0'){
                                            echo "No images found!";
                                        }
                                        ?>                                    
                                        </div>
                                    </div>                                    
                                </div><hr>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset" onclick="javascript:window.location='opentickets.php';">Cancel</button>
                                        <button class="btn btn-primary" name="update" type="submit">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>
                <div class="col-lg-5">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Comments</h5>
                            <?php
                            $commented_by=$log_name;
                            ?>
                        </div>
                        <div class="ibox-content inspinia-timeline">
                        <form method="POST" action="addcomment.php">
                        <div class="timeline-item">
                        <div class="row">
                            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id1; ?>">
                            <input type="hidden" name="commented_by" value="<?php echo $commented_by; ?>">
                            <textarea name="comment" class="form-control" rows="3" placeholder="Add New Comments" required=""></textarea>
                            <button type="submit" name="postcomment" class="btn btn-primary btn-sm pull-right">Post Comment</button>
                            </form>
                        </div>
                        <?php
                        $comment_res=mysqli_query($conn,"SELECT * FROM `comments` WHERE `ticket_id`='$ticket_id1'");
                        $comment_row1=mysqli_num_rows($comment_res);                  
                        if($comment_row1==0){
                            echo "</br><p>No comments found!</p>";
                        } else{
                            while($comment_row2=mysqli_fetch_array($comment_res)){
                                $commented_by=$comment_row2['commented_by'];
                                $comments=$comment_row2['comments'];
                                $commented_on=$comment_row2['commented_on'];
                                $current_date=date("d-m-Y",time());
                                $comment_age=$current_date-$commented_on;
                        ?>
                            <div class="row">
                                <div class="col-xs-3 date">
                                    <i class="fa fa-comments"></i>
                                    <?php 
                                    if ($comment_age=='0'){
                                        echo '<small class="text-navy">Today</small>'; 
                                    }else if($comment_age=='1'){
                                        echo '<small class="text-navy">'.$comment_age.'day ago</small>'; 
                                    }else{
                                        echo '<small class="text-navy">'.$comment_age.'days ago</small>'; 
                                    }
                                    ?>                                     
                                </div>
                                <div class="col-xs-7 content no-top-border">
                                    <p class="m-b-xs"><strong><?php echo $commented_by; ?></strong></p>
                                    <p><?php echo $comments; ?></p>                                    
                                </div>
                            </div>
                            <?php
                            }
                        }
                        ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
?>

<!-- The Gallery as lightbox dialog, should be a child element of the document body -->
<div id="blueimp-gallery" class="blueimp-gallery">
<div class="slides"></div>
<h3 class="title"></h3>
<a class="prev">‹</a>
<a class="next">›</a>
<a class="close">×</a>
<a class="play-pause"></a>
<ol class="indicator"></ol>
</div>

<?php
if(isset($_POST['update'])){

        $ticket_id=$_POST['ticket_id'];
        $ini_name=$_POST['ini_name'];
        $ini_phone=$_POST['ini_phone'];
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
         move_uploaded_file($file_tmp,"../uploads/".$new_file_name);
      }else{
         echo "Please check the file you are trying to upload";
         exit();
      }
   }
   //File upload ends here

   
        //echo "test".$vendor;

        mysqli_query($conn,"UPDATE `tickets` SET `ini_name`='$ini_name',`ini_phone`='$ini_phone',`ini_email`='$ini_email',`ini_address`='$ini_address',`ini_doornum`='$ini_doornum',`ini_type`='$ini_type',`pref_time`='$pref_time',`keys_tube`='$keys_tube',`pets_home`='$pets_home', `pets_data`='$pets_data',`service`='$service',`sub_service`='$sub_service',`description`='$description' WHERE `ticket_id`='$ticket_id'");
        
        //adding comment
        $commented_by=$log_name;
        $commented_on=date("d-m-Y h:i:s");
        mysqli_query($conn,"INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$commented_by','Ticket Updated','$commented_on')");

        //adding history
        $his_time=date( "d-m-Y h:i:s"); 
        mysqli_query($conn, "INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket details updated by Vendor - $email')");


          //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/sw/fixit1';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Your Ticket has been updated by Vendor!<br><br> Your unique tracking code is '.$ticket_id.'<br><br>';
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
        <script type="text/javascript">
        window.location = "opentickets.php";
        </script>
<?php 
  }
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
    <!-- Jasny -->
    <script src="../../global/js/plugins/jasny/jasny-bootstrap.min.js"></script>
    <!-- Sweet alert -->
    <script src="../../global/js/plugins/sweetalert/sweetalert.min.js"></script>
    <!-- Select2 -->
    <script src="../../global/js/plugins/select2/select2.full.min.js"></script>
    <!-- blueimp gallery -->
    <script src="../../global/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
            });

        });

        $(".select2_demo_1").select2();
            $(".select2_demo_2").select2();
            $(".select2_demo_3").select2({
                placeholder: "Select a state",
                allowClear: true
            });
    </script>


</body>

</html>

<!-- Localized -->
    <script type="text/javascript">
function fetch_select(e){$.ajax({type:"post",url:"../fetchservice.php",data:{get_option:e},success:function(e){document.getElementById("new_select").innerHTML=e}})}
</script>