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

if(isset($_POST['comment']) AND isset($_POST['postcomment'])){
  $comment=$_POST['comment'];
  $ticket_id=$_POST['ticket_id'];
  $commented_by=$_POST['commented_by'];
  $commented_on=date("d-m-Y h:i:s");
  mysqli_query($conn,"INSERT INTO `comments`(`ticket_id`, `commented_by`, `comments`, `commented_on`) VALUES ('$ticket_id','$commented_by','$comment','$commented_on')");
  $his_time=date("d-m-Y h:i:s");
  mysqli_query($conn,"INSERT INTO `history`(`ticket_id`, `time`, `comments`) VALUES ('$ticket_id','$his_time','Comment added by - $email')");

  $mail_res=mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
  $mail_row=mysqli_fetch_array($mail_res);
  $ini_name=$mail_row['ini_name'];
  $ini_phone=$mail_row['ini_phone'];
  $ini_email=$mail_row['ini_email'];
  //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/sw/fixit1';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Vendor added a comment on your ticket '.$ticket_id.'<br><br>';
          
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

  header("Location: ticketedit.php?ticket_id=$ticket_id&comment=success");
}
?>