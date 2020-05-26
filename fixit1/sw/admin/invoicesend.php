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

$ticket_id=$_GET['ticket_id'];
$invoice_res=mysqli_query($conn,"SELECT * FROM `invoices` WHERE `ticket_id`='$ticket_id'");
$invoice_row=mysqli_fetch_array($invoice_res);
$invoice_id=$invoice_row['invoice_id'];
$bill_due=$invoice_row['bill_due'];
$bill_due_date=$invoice_row['bill_due_date'];
$invoice_date=$invoice_row['invoice_date'];
$invoice_date=$invoice_row['invoice_date'];
$ini_name=$invoice_row['ini_name'];
$description=$invoice_row['description'];
//$shipping=$invoice_row['shipping'];
$rot=$invoice_row['rot'];
$vendor=$invoice_row['vendor'];


$item_res=mysqli_query($conn,"SELECT * FROM `invoice_items` WHERE `ticket_id`='$ticket_id'");
$sub_total='';
$items_tbl='';
$item_rows_space=0;
$shipping=0;
$tax=0;
while($itemslist_row=mysqli_fetch_array($item_res)){
    $item_name=$itemslist_row['item_name'];
    $quantity=$itemslist_row['quantity'];
    $quantity_type=$itemslist_row['quantity_type'];
    $price=$itemslist_row['price'];
    $discount=$itemslist_row['discount'];
    $total=$itemslist_row['total'];
    $sub_total = $sub_total+$itemslist_row['total'];

    $items_tbl .= '<tr><td height="30px;"></td><td>'.$item_name.'</td><td>'.$quantity.'</td><td>'.$quantity_type.'</td><td>'.$price.'</td><td>'.$discount.'</td><td>'.$total.'</td></tr>';

    if(stripos($item_name,'Frakt') !== false ){
        $shipping += $total;
    }
    if(stripos($item_name,'Rot arbete') !== false ){
        $tax += $total;
    }
    $item_rows_space=$item_rows_space+1;
}

//rows spacing
$item_rows_space='375'-($item_rows_space*30);
//$items_tbl .= '</table>';

if($rot=='True'){
  $rot_res=mysqli_query($conn,"SELECT * FROM `rot` WHERE `ticket_id`='$ticket_id'");
  $rot_row=mysqli_fetch_array($rot_res);
  $rot_data='Om Skatteverket i nagon omfattning nekar utbetaining eller om uppdragstagaren blir aterbetainingskuldig dor utbe tat belopp har uppdragstagaren i efterhand ratt att krava uppdragsgivaren pa motsvarande belopp.<br>'.$rot_row['label1'].'<br>'.$rot_row['label2'].'<br>'.$rot_row['label3'].'<br>'.$rot_row['label4'];
} else {
    $rot_data = '';
}

$vat=(25/100)*$sub_total;
$g_total=$sub_total+$shipping+$vat;
$g_total1=round($g_total); 
$rounding=abs($g_total-$g_total1); 

$tax1=$tax+((25/100)*$tax);
$tax2=(30/100)*$tax1;

$g_total2=$g_total1-$shipping;
$g_total3=$g_total2-$tax2;

$ticket_data_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
$ticket_data_row=mysqli_fetch_array($ticket_data_res);
$ini_address=$ticket_data_row['ini_address'];


$html = '
<html>
<head>
<style>
.table-cls, .table-cls td, .table-cls th {
    border-collapse: collapse;
    border: 1px solid black;
}
.table-1{
    border-collapse: collapse;
    border: 1px solid black;
}
.table-1 td td{
    border-collapse: collapse;
    border: 0px solid black;
}

</style>
</head>
<body style="font-family: sans-serif; font-size:11px;">

<table width="100%">
<tr>
<td width="50%" rowspan="3"><img src="../../logo.png" width="300px" height="200px"></td>
<td width="60%" height="50px">
<table width="100%" class="table-cls">
<tr><td height="50px" colspan="4" align="center" style="font-size:14px;"><h2>Faktura</h2></td></tr>
<tr><td height="50px" align="center"><b>Fakturanummer</b><br>'.$invoice_id.'</td>
<td align="center"><b>Kundnummber</b><br>&nbsp;&nbsp;</td>
<td align="center"><b>Fakturadatum</b><br>'.$invoice_date.'</td>
<td align="center"><b>Sida</b><br>1</td></tr>
<tr><td colspan="4" height="100px" style="vertical-align: top; text-align: left;"><b>Faktureringsadress</b><br>'.$ini_name.'<br>'.$ini_address.'</td></tr>
</table>
</td></tr>
</table>
<br>
<table width="100%" border="0">
<tr><td width="50%" height="25px"><b>var referns</b> : ' . $vendor . '</td>
<td width="50%" ><b>Betalningsvillkor</b>  : '.$bill_due.' days</td></tr>
<tr><td width="50%" height="25px"><b>Er referens</b> : '.$ini_name.'</td>
<td width="50%" ><b>förfallodatum</b>  : ' . $bill_due_date . '</td></tr>
<tr><td width="50%" height="25px"><b>Ert Ordernummer</b> : '.$ticket_id.'</td></tr>
</table>

<br>

<table width="100%" class="table-1">
<tr><th style="width: 10%; height:30px;" align="left">Nummer</th>
<th style="width: 35%" align="left">Benämning</th>
<th style="width: 10%" align="left">Antal</th>
<th style="width: 10%" align="left">Enhat</th>
<th style="width: 13%" align="left">Pris</th>
<th style="width: 12%" align="left">Rabatt %</th>
<th style="width: 10%" align="left">Belopp</th>
</tr>
<tr><td colspan="7" height="100px"><i>'.$description.'</i></td>
</tr>'.$items_tbl.'
<tr><td colspan="7" height="'.$item_rows_space.'px"></td></tr>
<tr><td colspan="4" height="100px" rowspan="7" style="padding: 0px 0px 0px 10px;">'.$rot_data.'</td><td></td></tr>
<tr><td colspan="2" height="20px;">Frakt </td><td align="right" style="padding: 0px 20px 0px 0px;">'.$shipping.'</td></tr>
<tr><td colspan="2" height="20px;">Belopp fore moms </td><td align="right" style="padding: 0px 20px 0px 0px;">'.$sub_total.'</td></tr>
<tr><td colspan="2" height="20px;">Moms </td><td align="right" style="padding: 0px 20px 0px 0px;">'.$vat.'</td></tr>
<tr><td colspan="2" height="20px;">Öresutjämning </td><td align="right" style="padding: 0px 20px 0px 0px;">'.number_format($rounding,2).'</td></tr>
<tr><td colspan="2" height="20px;">Skattereduktion </td><td align="right" style="padding: 0px 20px 0px 0px;">'.$tax2.'</td></tr>
<tr><td colspan="2" height="20px;"><b>Summa att betala </b></td><td align="right" style="padding: 0px 20px 0px 0px;"><b>'.$g_total3.'</b></td>
</tr>
</table>

</body>
</html>
';

$bank_res=mysqli_query($conn,"SELECT * FROM `bank_details` WHERE 1");
$bank_row=mysqli_fetch_array($bank_res);

$footer = '<table width="100%" class="table-1">
<tr><td height="30px">'.$bank_row['c_name'].'</td>
<td>Telefon</td>'.$bank_row['phone'].'<td></td><td>Bankgiro</td><td>'.$bank_row['ac_num'].'</td></tr>
<tr><td height="30px">'.$bank_row['d1'].'</td>
<td>E-post</td><td>'.$bank_row['email'].'</td><td colspan="2">'.$bank_row['d2'].'</td></tr>
<tr><td height="30px">'.$bank_row['d3'].'</td>
<td>Hemsida</td><td>'.$bank_row['website'].'</td><td colspan="2">'.$bank_row['d4'].'</td></tr>
<tr><td colspan="5" align="right" height="30px">'.$bank_row['d5'].'</td></tr>
</table>';
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================

define('_MPDF_PATH','');
include("../../mpdf60/mpdf.php");

$mpdf=new mPDF('c','A4','','',20,15,10,25,10,10); 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Fixit - Invoice");
$mpdf->SetAuthor("pradeep");
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetHTMLFooter($footer);

$mpdf->SetWatermarkText('FIXIT');
$mpdf->watermark_font = 'DejaVuSansCondensed';
$mpdf->showWatermarkText = true;


$mpdf->WriteHTML($html);

$file_path = "../../invoices/" . $invoice_id . ".pdf";
$mpdf->Output($file_path,'F');


$mail_res = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
$mail_row = mysqli_fetch_array($mail_res);
$ini_name = $mail_row['ini_name'];
$ini_phone = $mail_row['ini_phone'];
$ini_email = $mail_row['ini_email'];
          //phpmailer starts here
          $url='http://'. $_SERVER['SERVER_NAME'].'/fixit1/sw';
          $message = '<html><head><title>Ticket</title></head><body>';
          $message .= '<h4>Hi ' . $ini_name . '!</h4></br>';
          $message .= 'Invoice Created for your ticket<br><br> Please Find the attachement <br><br>';
          
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
$mail->AddAttachment("../../invoices/" . $invoice_id . ".pdf");

$ven_usr_res = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
$ven_usr_row = mysqli_fetch_array($ven_usr_res);
$vendor = $ven_usr_row['vendor'];
$ven_usr_res1 = mysqli_query($conn, "SELECT * FROM `vendors` WHERE `vendor_name`='$vendor'");
$ven_usr_row1 = mysqli_fetch_array($ven_usr_res1);
$vendor_email = $ven_usr_row1['vendor_email'];
if ($vendor_email) {
    $mail->addBCC($vendor_email);
}
$ad_usr_res = mysqli_query($conn, "SELECT * FROM `admin-user` WHERE 1");
while ($ad_usr_row = mysqli_fetch_array($ad_usr_res)) {
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
//$mail->SMTPDebug = 2;
          
?>