<?php
include '../dbconnect9.php';
include "../phpmailer/class.phpmailer.php";
?>
<!DOCTYPE html>
<html>
    
<head>
        
        <!-- Title -->
        <title>FiXiT | Your Problem Our Solution</title>
        
        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        
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
                        <li><a href="index.php">HEM</a></li>
                        <li><a href="" data-toggle="modal" data-target="#myModal">LOGGA IN</a></li>
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
                        <h2>Skapa Nytt Ärende</h2>     <em>
                    Här kan du skapa ett nytt ärende, fyll i alla nödvändiga uppgifter. Tack
                </em>                   
                    </div>
                </div>
            </div>
        </div>

<?php
        if(!isset($_POST['create'])){
          if(isset($_POST['create_again']) && isset($_POST['ticket_id'])){
            $ticket_id=$_POST['ticket_id'];
            $tic_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
            $tic_row=mysqli_fetch_array($tic_res);
            $ini_name=$tic_row['ini_name'];
            $ini_phone=$tic_row['ini_phone'];
            //$ini_phone="+46".$ini_phone;
            $ini_email=$tic_row['ini_email'];
            $ini_address=$tic_row['ini_address'];
            $ini_doornum=$tic_row['ini_doornum'];
            $ini_type=$tic_row['ini_type'];
            $pref_time=$tic_row['pref_time'];
            $keys_tube=$tic_row['keys_tube'];
            $pets_home=$tic_row['pets_home'];
            $service=$tic_row['service'];
            $sub_service=$tic_row['sub_service'];
          }
          ?>
<form action="" method="POST" enctype = "multipart/form-data">
<div id="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 rotateInUpLeft">
            
                <!-- BEGIN Portlet PORTLET-->
                <div class="portlet portlet-bordered">
                    <div class="portlet-title">
                        <h3 class="pull-left">Personuppgifter</h3>
                    </div>
                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="pull-left" for="exampleInputName">Namn</label>
                                            <input type="text" class="form-control" name="ini_name" value="<?php if(isset($ini_name)){ echo $ini_name;}?>" placeholder="Förnamn Efternamn">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="exampleInputName">Telefon Nr.</label>
                                            <div class="input-group m-b"><span class="input-group-btn">
                                            <a type="button" class="btn btn-success">+46</a> </span> <input type="number" class="form-control" name="ini_phone" value="<?php if(isset($ini_phone)){ echo $ini_phone;}?>" placeholder="755555555">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">E-postadress</h5>
                                        <input type="email" name="ini_email" value="<?php if(isset($ini_email)){ echo $ini_email;}?>" class="form-control" placeholder="exemple@exemple.se" required>
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
                        <h3 class="pull-left">Din Bostad</h3>
                    </div>
                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Adress</h5>
                                        <input type="text" name="ini_address" value="<?php if(isset($ini_address)){ echo $ini_address;}?>" class="form-control" placeholder="Adress" required>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Dörr kod</h5>
                                        <input type="text" name="ini_doornum" value="<?php if(isset($ini_doornum)){ echo $ini_doornum;}?>" class="form-control" placeholder="0000#" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">BRF/Hyresrätt</h5>
                                        <select name="ini_type" class="js-example-basic-single js-states form-control" tabindex="-1" required>
                                        <?php if(isset($ini_type)){echo "<option value='$ini_type'>$ini_type</option>"; }?>
                                        <option value="select">Välj</option>
                                        <option value="BRF Owner">BRF</option>
                                        <option value="Tenant">Hyresrätt</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Föredragen tid</h5>
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
                                    <div class="col-sm-6"><h5 class="pull-left">Nyckel I Tuben</h5>
                                        <select name="keys_tube" class="js-example-basic-single js-states form-control" tabindex="-1">
                                        <?php if(isset($keys_tube)){echo "<option value='$keys_tube'>$keys_tube</option>"; }?>
                                        <option value="select">Välj</option>
                                        <option value="Yes">Ja</option>
                                        <option value="No">Nej</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Husdjur</h5>
                                        <select name="pets_home" id="pets" class="js-example-basic-single js-states form-control pets" tabindex="-1">
                                        <?php if(isset($pets_home)){echo "<option value='$pets_home'>$pets_home</option>"; }?>
                                        <option value="select">Välj</option>
                                        <option value="Yes">Ja</option>
                                        <option value="No">Nej</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row" id="pets_data" style="display: none;">
                                    <div class="col-sm-6">                                        
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Husdjur Information</h5>
                                        <input type="text" name="pets_data" value="" class="form-control" placeholder="Husdjur Information">
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
                        <h3 class="pull-left">Ärende</h3>
                    </div>

            <?php
            if(isset($_GET['service'])){
              $service=$_GET['service'];
              $service_res1=mysqli_query($conn,"SELECT * FROM `services` WHERE `service`='$service'");
              $service_row1=mysqli_fetch_array($service_res1);
            ?>

                    <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Läge</h5>
                                        <select name="service" onchange="fetch_select(this.value);" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <option value="<?php echo $service_row['service']; ?>"><?php echo $service_row1['service']; ?></option>
                                        <option value="select">Välj</option>
                                        <?php
                                        $select=mysqli_query($conn,"SELECT DISTINCT `service` FROM `services` WHERE 1");
                                        while($service_row=mysqli_fetch_array($select)){
                                            echo "<option value='".$service_row['service']."'>".$service_row['service']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Fel</h5>
                                        <select name="sub_service" id="new_select" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <?php 
                                        while($service_row2=mysqli_fetch_array($service_res1)){
                                            echo "<option value='".$service_row2['sub_service']."'>".$service_row2['sub_service']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="pull-left">Beskrivning</h5><br><br>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="pull-left">Filuppladdning</h5><br><br>
                                        <input type="file" name="image"></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
            <?php
            //above is for GET service selected
            }else{
            //below is for general
            ?>
            <div class="portlet-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6"><h5 class="pull-left">Läge</h5>
                                        <select name="service" onchange="fetch_select(this.value);" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <?php if(isset($service)){echo "<option value='$service'>$service</option>"; }?>
                                        <option value="select">Välj</option>
                                        <?php
                                        $select=mysqli_query($conn,"SELECT DISTINCT `service` FROM `services` WHERE 1");
                                        while($service_row=mysqli_fetch_array($select)){
                                            echo "<option value='".$service_row['service']."'>".$service_row['service']."</option>";
                                        }?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6"><h5 class="pull-left">Fel</h5>
                                        <select name="sub_service" id="new_select" class="js-example-basic-multiple js-states form-control" tabindex="-1">
                                        <?php if(isset($sub_service)){echo "<option value='$sub_service'>$sub_service</option>"; }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h5 class="pull-left">Beskrivning</h5><br><br>
                                        <textarea class="form-control" name="description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="pull-left">Filuppladdning</h5><br><br>
                                        <input type="file" name="image"></span>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <!-- END Portlet PORTLET-->
                <?php
            }
            ?>
            </div>
        </div><br><button type="submit" class="btn btn-success btn-lg" name="create">Skapa</button>
    </form>
	</div>
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
         move_uploaded_file($file_tmp,"../uploads/".$new_file_name);
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
  $result1=mysqli_query($conn,"INSERT INTO `tickets`(`ticket_id`, `ini_name`, `ini_phone`, `ini_email`, `ini_address`, `ini_doornum`, `ini_type`, `pref_time`, `keys_tube`, `pets_home`, `pets_data`, `service`, `sub_service`, `description`,`status`, `vendor`, `created_on`) VALUES ('$ticket_id','$ini_name','$ini_phone', '$ini_email','$ini_address','$ini_doornum','$ini_type','$pref_time','$keys_tube','$pets_home', '$pets_data' ,'$service','$sub_service', '$description', '$status', '', '$created_on')");
  $his_time=date("d-m-Y h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Ticket Created')");
  echo '<script>
        $(document).ready(function () {
          swal({
            type: "success",
            title: "Ticket Created Successfully!",
            html: true
            });  
        });
        </script>';
?>       
<style type="text/css">
    html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #f5f5f5;
}
</style>
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
          <form method="POST" action="ticket.php">
          <input type="hidden" name="ticket_id" value="<?php echo $ticket_id;?>">
          <h6>Want to create another ticket with same details </h6>
          <div class="col-md-2">
          <button name="create_again" type="submit" class="btn btn-primary btn-block btn-sm">
            Create Another
          </button>
          </div>
          </form>
      <?php
        } else{
          header("Location: /error.php");
        }
      }//if(isset create) end here
      
      ?>
		
        <footer class="footer">
            <div class="container">
                <p class="text-center no-s">2017 &copy; Fixit | Developed by qa-masters.</p>
            </div>
        </footer>
    </body>

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
                        <label for="exampleInputEmail1">E-postadress</label>
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