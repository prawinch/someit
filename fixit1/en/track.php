<?php
include '../dbconnect9.php';
require_once "../phpmailer/class.phpmailer.php";
?>
<!DOCTYPE html>
<html>
<head>
        
        <!-- Title -->
        <title>FiXiT | Your Problem Our Solution</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Modern Landing Page" />
        <meta name="keywords" content="landing" />
        <meta name="author" content="Steelcoders" />
        
        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Raleway:500,400,300' rel='stylesheet' type='text/css'>
        <link href="../assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="../assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/plugins/animate/animate.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/tabstylesinspiration/css/tabs.css" rel="stylesheet" type="text/css">
        <link href="../assets/plugins/tabstylesinspiration/css/tabstyles.css" rel="stylesheet" type="text/css">	
        <link href="../assets/plugins/pricing-tables/css/style.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/landing1.css" rel="stylesheet" type="text/css"/>
        
       <link rel="stylesheet" type="text/css" href="../assets/custom.css">
       <link rel="stylesheet" type="text/css" href="../assets/progress.css">
       <!-- Sweet Alert -->
       <link href="../global/sweetalert/sweetalert.css" rel="stylesheet">
       <script src="../global/sweetalert/sweetalert.min.js"></script>
       <!-- Javascripts -->
       <script src="../assets/plugins/jquery/jquery-2.1.4.min.js"></script>
       <script src="../assets/plugins/jquery-ui/jquery-ui.min.js"></script>
       <script src="../assets/plugins/pace-master/pace.min.js"></script>
       <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
       <script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js"></script>
       <script src="../assets/plugins/uniform/jquery.uniform.min.js"></script>
       <script src="../assets/plugins/wow/wow.min.js"></script>
       <script src="../assets/plugins/tabstylesinspiration/js/cbpfwtabs.js"></script>
       <script src="../assets/plugins/pricing-tables/js/main.js"></script>
       <script src="../assets/js/landing1.js"></script> 
        
    </head>
    <body  >
        <nav id="header" class="navbar navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="#">FiXiT</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="" data-toggle="modal" data-target="#myModal">Login</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="home" id="home">
            <div class="overlay"></div>
            
        </div>

        
       <div id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 rotateInUpLeft" data-wow-duration="1.5s" data-wow-offset="10" data-wow-delay="0.5s">                        
                        <h2>Ticket Track</h2>     <em>
                    Here you can track your already created tickets, Enter Ticket ID and mobile number used for ticket creation
                </em>                   
                    </div>
                </div>
            </div>
        </div>

          

<?php

if(empty($_GET['ticket_id']) AND empty($_GET['phone'])){
        echo '<script>
        $(document).ready(function () {
            swal({
                title: "Ticket Not Found!",
                text: "Redirecting to homepage",
                timer: 2000,
                type: "error",
                showConfirmButton: false
            }, function(){
                window.location.href = "index.php#track";
            });
        });
        </script>';
      }else{
        if(isset($_GET['ticket_id'])){
            $ticket_id=$_GET['ticket_id'];
            $ini_phone=$_GET['phone'];
          }else{
            $ticket_id=$_POST['ticket_id'];
            $ini_phone=$_POST['ini_phone'];
            $ini_phone="+46".$ini_phone;
          }          
          $result=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id' AND `ini_phone`='$ini_phone' AND `status` != 'Deleted' AND `status` != 'Closed'");
          $rows1=mysqli_num_rows($result);
          if($rows1 != 0){
            while($rows2=mysqli_fetch_array($result)){
              $ini_name=$rows2['ini_name'];
              $ini_phone=$rows2['ini_phone'];
              $ini_email=$rows2['ini_email'];
              $ini_address=$rows2['ini_address'];
              $ini_doornum=$rows2['ini_doornum'];
              $ini_type=$rows2['ini_type'];
              $pref_time=$rows2['pref_time'];
              $keys_tube=$rows2['keys_tube'];
              $pets_home=$rows2['pets_home'];
              $service=$rows2['service'];
              $sub_service=$rows2['sub_service'];
              $description=$rows2['description'];
              $status=$rows2['status'];
            }
            if(substr($status, 0,3)=='New'){
                $created='complete';
                $processing='disabled';
                $done='disabled';
                $closed='disabled';
            }else if(substr($status, 0,3)=='Ass' OR substr($status, 0,3)=='Rej' OR substr($status, 0,3)=='Acc'){
                $created='complete';
                $processing='active';
                $done='disabled';
                $closed='disabled';
            }else if(substr($status, 0,3)=='Wor'){
                $created='complete';
                $processing='complete';
                $done='active';
                $closed='disabled';
            }else if(substr($status, 0,3)=='Clo'){
                $created='complete';
                $processing='complete';
                $done='complete';
                $closed='complete';
            }else if(substr($status, 0,3)=='Del'){
                $created='disabled';
                $processing='disabled';
                $done='disabled';
                $closed='disabled';
            }
?>
        <div class="container">
            <div class="row bs-wizard" style="border-bottom:0;">
                <div class="col-xs-3 bs-wizard-step <?php echo $created;?>">
                  <div class="text-center bs-wizard-stepnum">Created</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  
                </div>
                
                <div class="col-xs-3 bs-wizard-step <?php echo $processing;?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Processing</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  
                </div>
                
                <div class="col-xs-3 bs-wizard-step <?php echo $done;?>"><!-- complete -->
                  <div class="text-center bs-wizard-stepnum">Done</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  
                </div>
                
                <div class="col-xs-3 bs-wizard-step <?php echo $closed;?>"><!-- active -->
                  <div class="text-center bs-wizard-stepnum">Closed</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                  
                </div>
            </div>
          </div>
<form action="track.php" method="POST" enctype = "multipart/form-data">
<div id="contact">
    <div class="container">
        <div class="row" style="text-align: left">
            <div class="col-sm-10 col-sm-offset-1 rotateInUpLeft">
                <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <h3 class="pull-left">Personal Information</h3>
                    </div>
                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5>Initiator Name</h5>
                                        <input type="text" name="ini_name" value="<?php echo $ini_name;?>" class="form-control" placeholder="Initiator Name" required>
                                    </div>
                                    <div class="col-sm-6"><h5>Initiator Phone</h5>
                                        <div class="input-group m-b"><span class="input-group-btn">
                                            <a type="button" class="btn btn-success">+46</a> </span>
                                            <input type="number" name="ini_phone" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" value="<?php echo $ini_phone;?>" class="form-control" placeholder="755555555" required></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Initiator Email</h5>
                                        <input type="email" name="ini_email" value="<?php if(isset($ini_email)){ echo $ini_email;}?>" class="form-control" placeholder="Email" required>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
                <br>

                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <h3 class="pull-left">Address Information</h3>
                    </div>
                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Initiator Address</h5>
                                        <input type="text" name="ini_address" value="<?php if(isset($ini_address)){ echo $ini_address;}?>" class="form-control" placeholder="Address" required>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Door Code</h5>
                                        <input type="text" name="ini_doornum" value="<?php if(isset($ini_doornum)){ echo $ini_doornum;}?>" class="form-control" placeholder="Door Code" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Initiator Type</h5>
                                        <select name="ini_type" class="js-example-basic-single js-states form-control" tabindex="-1" required>
                                        <?php if(isset($ini_type)){echo "<option value='$ini_type'>$ini_type</option>"; }?>
                                        <option value="select">Select</option>
                                        <option value="BRF Owner">BRF Owner</option>
                                        <option value="Tenant">Tenant</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Preferred Time</h5>
                                        <select name="pref_time" class="js-example-basic-single js-states form-control" tabindex="-1" required>
                                        <?php if(isset($pref_time)){echo "<option value='$pref_time'>$pref_time</option>"; }?>
                                        <option value="8:00 - 11:00">8:00 - 11:00</option>
                                        <option value="9:00 - 12:00">9:00 - 12:00</option>
                                        <option value="10:00 - 13:00">10:00 - 13:00</option>
                                        <option value="11:00 - 14:00">11:00 - 14:00</option>
                                        <option value="12:00 - 15:00">12:00 - 15:00</option>
                                        <option value="13:00 - 16:00">13:00 - 16:00</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Keys in Tube</h5>
                                        <select name="keys_tube" class="js-example-basic-single js-states form-control" tabindex="-1">
                                        <?php if(isset($keys_tube)){echo "<option value='$keys_tube'>$keys_tube</option>"; }?>
                                        <option value="select">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Pets at Home</h5>
                                        <select name="pets_home" id="pets" class="js-example-basic-single js-states form-control pets" tabindex="-1">
                                        <?php if(isset($pets_home)){echo "<option value='$pets_home'>$pets_home</option>"; }?>
                                        <option value="select">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row" id="pets_data" style="display: none;">
                                    <div class="col-sm-6">                                        
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Pets Information</h5>
                                        <input type="text" name="pets_data" value="" class="form-control" placeholder="Pet Details">
                                    </div>
                                </div>
                            </div>                            
                    </div>
                </div>
                <!-- END Portlet PORTLET-->

                <br>
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <h3 class="pull-left">Service Information</h3>
                    </div>
                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Location</h5>
                                        <select name="service" onchange="fetch_select(this.value);" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <?php if(isset($service)){echo "<option value='$service'>$service</option>"; }?>
                                        <option value="select">Select</option>
                                        <?php
                                        $select=mysqli_query($conn,"SELECT DISTINCT `service` FROM `services` WHERE 1");
                                        while($service_row=mysqli_fetch_array($select)){
                                            echo "<option value='".$service_row['service']."'>".$service_row['service']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Problem</h5>
                                        <select name="sub_service" id="new_select" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <?php if(isset($sub_service)){echo "<option value='$sub_service'>$sub_service</option>"; }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="pull-left">Description</h5><br><br>
                                        <textarea class="form-control" name="description"><?php echo $description;?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="pull-left">File Upload</h5><br><br>
                                        <input type="file" name="image"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="pull-left">Images</h5><br><br>
                                        <?php
                                        $images = glob("../uploads/*.*");
                                        $img=0;
                                        foreach($images as $image) { 

                                            $file=substr($image, 11);
                                            $file1=substr( $file, 0, 16 );
                                            //echo $image;
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
                            </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            </div>
        </div><br><button type="submit" class="btn btn-success btn-lg" name="update">Update Ticket</button>
    </form>
	</div>
</div>
<?php
      }else{
        echo '<script>
        $(document).ready(function () {
            swal({
                title: "Ticket Not Found!",
                text: "Redirecting to homepage",
                timer: 2000,
                type: "error",
                showConfirmButton: false
            }, function(){
                window.location.href = "index.php#track";
            });
        });
        </script>';
      }
    }//isset track

    
if(isset($_POST['update'])){
      $ticket_id=$_POST['ticket_id'];
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

      mysqli_query($conn,"UPDATE `tickets` SET `ini_name`='$ini_name',`ini_phone`='$ini_phone',`ini_email`='$ini_email',`ini_address`='$ini_address',`ini_doornum`='$ini_doornum',`ini_type`='$ini_type',`pref_time`='$pref_time',`keys_tube`='$keys_tube',`pets_home`='$pets_home',`service`='$service',`sub_service`='$sub_service',`description`='$description' WHERE `ticket_id`='$ticket_id'");
      $his_time=date("d-m-Y h:i:s");
      mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket details Updated')");
      //echo $ticket_id.$ini_name.$ini_phone.$ini_email;
      //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/fixit1/sw';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Your Ticket has been Updated!<br><br>';
          $message .= 'To know more about what has been changed <a href="'.$url.'/track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'">click here </a><br><br>';
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
          $mail->addBCC($vendor_email);

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
      echo '<script type="text/javascript">
        window.location = "track.php?ticket_id='.$ticket_id.'&phone='.$ini_phone.'";
        </script>';
    }

      ?>
		
        <footer>
            <div class="container">
                <p class="text-center no-s">2017 &copy; Fixit | Developed by qa-masters.</p>
            </div>
        </footer>
        
    </body>

<!-- Mirrored from steelcoders.com/modern/landing/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 05 Jun 2017 07:06:21 GMT -->
</html>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Login</h4>
            </div>
            <div class="modal-body">
                <form method="POST" action="login.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
                    </div>                                                                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Login</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
function fetch_select(val)
{
 $.ajax({
 type: 'post',
 url: 'fetchservice.php',
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