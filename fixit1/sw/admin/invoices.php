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
    

    <link href="../../global/css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="../../global/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="../../global/css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
    <link href="../../global/css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="../../global/css/style.css" rel="stylesheet">
    <link href="../../global/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>


<style type="text/css">
.table-borderless > tbody > tr > td,
.table-borderless > tbody > tr > th,
.table-borderless > tfoot > tr > td,
.table-borderless > tfoot > tr > th,
.table-borderless > thead > tr > td,
.table-borderless > thead > tr > th {
    border: none;
}
.vertical-alignment-helper {
    display:table;
    height: 100%;
    width: 100%;
    pointer-events:none; /* This makes sure that we can still click outside of the modal to close it */
}
.vertical-align-center {
    /* To center vertically */
    display: table-cell;
    vertical-align: middle;
    pointer-events:none;
}
.modal-content {
    /* Bootstrap sets the size of the modal in the modal-dialog class, we need to inherit it */
    width:inherit;
    height:inherit;
    /* To center horizontally */
    margin: 0 auto;
    pointer-events: all;
}        
</style>

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
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Ärendehantering</span><span class="fa arrow"></span></a>
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
                        <a href="#"><i class="fa fa-users"></i> <span class="nav-label">FS Administration</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="addvendor.php">Lägg Till</a></li>
                            <li><a href="vendorlist.php">Lista</a></li>
                            <li><a href="vendordisabled.php">Inaktiva</a></li>
                        </ul>
                    </li>

                    <li class="active">
                        <a href="#"><i class="fa fa-file-o"></i> <span class="nav-label">Fakturering</span><span class="fa arrow"></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="invoicerequest.php">Inkorg</a></li>
                            <li><a href="invoices.php">Lista</a></li>
                            <li><a href="minvoice.php">Skapa Faktura</a></li>
                            <li><a href="invoicegraph.php">Statistik</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="services.php"><i class="fa fa-cog"></i> <span class="nav-label">Tjänser</span></a>
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
                <div class="col-lg-8">
                    <h2>Ärendehantering</h2>
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
                <?php
                if(isset($_GET['ticket_id'])){$ticket_id=$_GET['ticket_id'];?>
                <div class="col-lg-4">
                    <div class="title-action">                        
                        <button id="send" class="btn btn-primary"><i class="fa fa-send"></i> Send</button>
                        <a href="invoicepdf.php?ticket_id=<?php echo $ticket_id; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file"></i> Generate PDF</a>
                    </div>
                </div>
                <?php } ?>
            </div>
<?php 
if(! isset($_POST['save_invoice']) && ! isset($_GET['ticket_id'])){
?>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Invoice</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                    <table class="table table-bordered dataTables-example" >
                    <thead>
                    <tr>
                        <th>Faktura Nummer</th>
                        <th>Ticket Nummer</th>
                        <th>Namn</th>
                        <th>Telefon Nr.</th>
                        <th>Fel</th>
                        <th>O</th>
                        <th>Status</th>
                        <th style="width: 80px;">Redigera</th>
                    </tr>
                    </thead>
                    <tbody class="tooltip-demo">
                    <?php
                    $invoice_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status`='Invoice Raised'");
            while($invoice_row = mysqli_fetch_array($invoice_res)){
              $ticket_id=$invoice_row['ticket_id'];

              $invoice_res1=mysqli_query($conn,"SELECT * FROM `invoices` WHERE `ticket_id`='$ticket_id'");
              $invoice_row1=mysqli_fetch_array($invoice_res1);
              $invoice_id=$invoice_row1['invoice_id'];
              $status=$invoice_row1['inv_status'];

              $created_on=$invoice_row['created_on'];
              $current_date=date("d-m-Y h:i:s");
              $ticket_age=$current_date-$created_on;
              $created_on1=substr($created_on,0,10);

              $ini_email=$invoice_row['ini_email'];
              echo "<tr style='cursor: pointer;'>
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">".$invoice_id."</td>
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">".$invoice_row['ticket_id']."</td>
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">".$invoice_row['ini_name']."</td>
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">"."+46".$invoice_row['ini_phone']."</td>              
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">".$invoice_row['service']."</td>
              <td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\">".$created_on1." - ".$ticket_age." days</td>";
              
              if($status=='Paid'){
                echo "<td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\"><span class='label label-primary'>".$status."</span></td>";
              }else if($status=='UnPaid'){
                echo "<td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\"><span class='label label-danger'>".$status."</span></td>";
              }else if($status=='Cancelled'){
                echo "<td onclick=\"window.document.location='invoices.php?ticket_id=$ticket_id'\"><span class='label'>".$status."</span></td>";
              }
              echo "
              <td>
              <div class='btn-group'>
              <button data-toggle='dropdown' class='btn btn-primary btn-sm dropdown-toggle' aria-expanded='false'>Change Status<span class='caret'></span></button>
              <ul class='dropdown-menu'>
              <li><a href='invoices.php?invoice_id=".$invoice_id."&status=Paid'>Paid</a></li>
              <li><a href='invoices.php?invoice_id=".$invoice_id."&status=Cancelled'>Cancel</a></li>
              </ul></div>
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

<?php
}else if(!empty($_GET['ticket_id'])){
    $ticket_id=$_GET['ticket_id'];
    
    $inv_check=mysqli_query($conn,"SELECT * FROM `invoices` WHERE `ticket_id`='$ticket_id'");
    $inv_check_row=mysqli_num_rows($inv_check);
    if($inv_check_row==0){
        $max_invres=mysqli_query($conn,"SELECT MAX(invoice_id) AS max_inv_id FROM `invoices` WHERE 1");
        $max_invrow=mysqli_fetch_array($max_invres);
        $invoice_id=$max_invrow['max_inv_id']+1;
        if($invoice_id <= 1024){
            $invoice_id='1024';
        }
        $inv_tkt_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
        $inv_tkt_row=mysqli_fetch_array($inv_tkt_res);
        $ini_name=$inv_tkt_row['ini_name'];
        $ini_phone=$inv_tkt_row['ini_phone'];
        $vendor=$inv_tkt_row['vendor'];
        $service=$inv_tkt_row['service'];
        $sub_service=$inv_tkt_row['sub_service'];
        $invoice_date=date("d-m-Y");
        $rot_status1='Disabled';
        $shipping='';

        mysqli_query($conn,"INSERT INTO `invoices`(`invoice_id`, `ticket_id`, `admin`, `ini_name`, `ini_phone`, `vendor`, `service`, `sub_service`, `bill_due`, `description`, `rot`, `inv_status`, `bill_due_date`, `invoice_date`) VALUES ('$invoice_id','$ticket_id','$log_name','$ini_name','$ini_phone','$vendor','$service','$sub_service','10','','','UnPaid','','')");
        mysqli_query($conn,"UPDATE `tickets` SET `status`='Invoice Raised' WHERE `ticket_id`='$ticket_id'");
        ?><script>window.document.location='invoices.php'</script>
        <?php
    }else{
        $inv_detail_res=mysqli_query($conn,"SELECT * FROM `invoices` WHERE `ticket_id`='$ticket_id'");
        $inv_detail_row=mysqli_fetch_array($inv_detail_res);
        $invoice_id=$inv_detail_row['invoice_id'];
        $ini_name=$inv_detail_row['ini_name'];
        $invoice_date=$inv_detail_row['invoice_date'];      
        $bill_due_date=$inv_detail_row['bill_due_date'];
        $bill_due=$inv_detail_row['bill_due'];
        $description=$inv_detail_row['description'];
        $shipping=$inv_detail_row['shipping'];
        $rot=$inv_detail_row['rot'];
        $vendor=$inv_detail_row['vendor'];
        $admin=$inv_detail_row['admin'];
        if($rot=='True'){
            $rot_status1='Enabled';
        }else{
            $rot_status1='Disabled';
        }

    }
?>
    <form method="POST" action="invoices.php">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                        <div class="row">
                            <div class="col-sm-6">
                                <img src="logo.png" width="300px" height="200px">
                            </div>
                            <?php
                            $ticket_data_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `ticket_id`='$ticket_id'");
                            $ticket_data_row=mysqli_fetch_array($ticket_data_res);
                            $ini_name=$ticket_data_row['ini_name'];
                            $ini_address=$ticket_data_row['ini_address'];
                            ?>
                            <div class="col-sm-6 table-responsive m-t">
                                    <table class="table table-bordered">
                                    <tr><td colspan="4" width="800px"><h1 align="center"><b>Faktura</b></h1></td></tr>
                                    <tr>
                                    <td align="center" width="25%" height="50px"><b>Fakturanummer</b> <br><?php echo $invoice_id; ?></td>
                                    <td align="center" width="25%"><b>Kundnummer</b> <br></td>
                                    <td align="center" width="25%"><b>Fakturadatum</b> <br><input type="text" name="invoice_date" value="<?php if(!$invoice_date==''){ echo $invoice_date;} else{echo date("d-m-Y"); } ?>">
                                        </td>
                                    <td align="center" width="25%"><b>Sida</b> <br>1</td></tr>
                                    <tr style="vertical-align: top; text-align: left;">
                                    <td colspan="4" width="25%" height="100px"><b>Faktureringsadress</b><br><?php echo $ini_name."<br>".$ini_address;?></td></tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <table class="table table-borderless">
                            <tr><td width="50%" height="20px"><b>Vår referns</b> : <?php echo $vendor; ?></td><td width="50%"><b>Betalningsvillkor</b>  : 
                             <select name="bill_due">
                             <?php
                             if($bill_due == '10'){
                                echo '<option value="10" selected> 10 days </option><option value="20"> 20 days </option><option value="30"> 30 days </option>';
                             }else if($bill_due == '20'){
                                echo '<option value="10"> 10 days </option><option value="20" selected> 20 days </option><option value="30"> 30 days </option>';
                             }else if($bill_due == '30'){
                                echo '<option value="10"> 10 days </option><option value="20"> 20 days </option><option value="30" selected> 30 days </option>';
                             }
                             ?>
                             </select></td></tr>
                            <tr><td width="50%" height="20px"><b>Er referens</b> : <?php echo $ini_name; ?></td><td width="50%"><b>Förfallodatum</b> : <?php echo $bill_due_date;?></td></tr>
                            <tr><td width="50%" height="20px"><b>Ert Ordernummer</b> : <?php echo $ticket_id; ?></td><td width="50%"></td></tr>
                            </table>


                            <table class="table table-bordered">                            
                            <tr><td>Description</td></tr>
                            <tr><td>
                            <textarea class="form-control" name="description"><?php echo $description?></textarea>
                            </td></tr>
                            </table> 
 
                            <h4>ROT Status: <?php echo $rot_status1; ?></h4>
                            <a href='#Rot' data-toggle='modal' data-hover='tooltip' title='Close Ticket' data-placement='top' data-whatever="<?php echo $ticket_id;?>" class='btn btn-primary'>View/Add ROT Data</a> 

                            <input type="hidden" name="ticket_id" value="<?php echo $ticket_id; ?>">
                            <input type="hidden" name="invoice_id" value="<?php echo $invoice_id; ?>">
                            <div class="table-responsive m-t">
                                <table class="table table-bordered" id="data">
                                    <thead>
                                    <tr>
                                        <th style="width: 10%">Nummer</th>
                                        <th style="width: 35%">Benämning</th>
                                        <th style="width: 10%">Antal</th>
                                        <th style="width: 10%">Enhat</th>
                                        <th style="width: 10%">Pris</th>
                                        <th style="width: 10%">Rabatt %</th>
                                        <th style="width: 10%">Belopp</th>
                                        <th style="width: 5%">Redigera</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    <?php
                                    $itemslist_res=mysqli_query($conn,"SELECT * FROM `invoice_items` WHERE `ticket_id`='$ticket_id' AND `invoice_id`='$invoice_id'");
                                    $sub_total=0;
                                    $shipping=0;
                                    $tax=0;
                                    while($itemslist_row=mysqli_fetch_array($itemslist_res)){
                                        $item_name=$itemslist_row['item_name'];
                                        $quantity=$itemslist_row['quantity'];
                                        $quantity_type=$itemslist_row['quantity_type'];
                                        $price=$itemslist_row['price'];
                                        $discount=$itemslist_row['discount'];
                                        $total=$itemslist_row['total'];
                                        $sub_total = $sub_total+$itemslist_row['total'];
                                        
                                        if(stripos($item_name,'Frakt') !== false ){
                                            $shipping += $total;
                                        }

                                        if(stripos($item_name,'Rot arbete') !== false ){
                                            $tax += $total;
                                        }

                                        echo '<td><input type="text" class="form-control" name="rot_status" value=""></td>
                                    <td><input type="text" class="form-control" name="item_name[]" value="'.$item_name.'"></td>
                                    <td align="center"><input type="text" class="qty form-control" name="quantity[]" value="'.$quantity.'"></td>
                                    <td width="10%"><select name="quantity_type[]" class="form-control" tabindex="-1"><option value="'.$quantity_type.'">'.$quantity_type.'</option>
                                    <td align="center"><input type="text" class="rate form-control" name="price[]" value="'.$price.'"></td>
                                    <td align="center"><input type="text" class="disc form-control" name="discount[]" value="'.$discount.'"></td>
                                    <td align="center"><input type="text" class="cal form-control" name="total[]" value="'.$total.'"></td>
                                    <td><button type="button" class="btn btn-primary btn-sm removebutton" tabindex="4">Delete</button></td>
                                    </tr>';
                                    }

                                    ?>                                    
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                                <input type="button" id="addnew" class="calculate btn btn-primary" name="addnew" value="Add Item" />
                            
                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Frakt :</strong></td>
                                    <td><?php echo $shipping;?></td>
                                </tr>
                                <?php 
                                $vat=(25/100)*$sub_total;
                                $g_total=$sub_total+$shipping+$vat;
                                $g_total1=round($g_total); 
                                $rounding=abs($g_total-$g_total1); 
                                ?>
                                <tr>
                                    <td><strong>Belopp före moms :</strong></td>
                                    <td><?php echo $sub_total;?></td>
                                </tr>
                                <tr>
                                    <td><strong>Moms :</strong></td><?php ?>
                                    <td><?php echo $vat;?></td>
                                </tr>
                                <tr>
                                    <td><strong>Öresutjämning :</strong></td>
                                    <td><?php echo  number_format($rounding,2); ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Skattereduktion :</strong></td>
                                    <td><?php 
                                    $tax1=$tax+((25/100)*$tax);
                                    $tax2=(30/100)*$tax1;
                                    echo $tax2;
                                    ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Summa att betala :</strong></td>
                                    <td><?php  
                                    $g_total2=$g_total1-$shipping; 
                                    echo $g_total2-$tax2;?></td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary" name="save_invoice"> Save Invoice</button>
                            </div>

                        </div>
                </div>
            </div>
        </div>
        </form>
<?php
}else if(isset($_POST['save_invoice'])){
    
        $ticket_id=$_POST['ticket_id'];
        $invoice_id=$_POST['invoice_id'];
        $invoice_date=$_POST['invoice_date'];
        $bill_due=$_POST['bill_due'];
        $bill_due_date= date('d-m-Y', strtotime($invoice_date. ' + '.$bill_due.' days'));
        $description=$_POST['description'];
        $ticket_id=$_POST['ticket_id'];
        //$shipping = 0;
        
        mysqli_query($conn,"UPDATE `invoices` SET `invoice_date`='$invoice_date', `bill_due_date`='$bill_due_date', `bill_due`='$bill_due',`description`='$description' WHERE `invoice_id`='$invoice_id'");
        $inv_aud_res=mysqli_query($conn,"SELECT * FROM `invoice_audit` WHERE 1");
        $inv_aud_num_row=mysqli_num_rows($inv_aud_res);
        $version=$inv_aud_num_row+1;
        //print_r($inv_aud_num_row);
        mysqli_query($conn,"INSERT INTO `invoice_audit`(`version`, `ticket_id`, `invoice_id`, `invoice_date`, `bill_due_date`, `bill_due`, `description`) VALUES ('$version','$ticket_id','$invoice_id','$invoice_date','$bill_due_date','$bill_due','$description')");

        mysqli_query($conn,"DELETE FROM `invoice_items` WHERE `ticket_id`='$ticket_id' AND `invoice_id`='$invoice_id'");
        if(!empty($_POST['item_name'])){
            $item_name=$_POST['item_name'];
            $quantity=$_POST['quantity'];
            $quantity_type=$_POST['quantity_type'];
            $price=$_POST['price'];      
            $discount=$_POST['discount'];
            $total=$_POST['total'];
            foreach ($item_name as $key => $item_name1) {                
            mysqli_query($conn,"INSERT INTO `invoice_items`(`invoice_id`, `ticket_id`,`item_name`, `quantity`, `quantity_type`, `price`, `discount`, `total`) VALUES ('$invoice_id','$ticket_id','$item_name[$key]','$quantity[$key]','$quantity_type[$key]','$price[$key]','$discount[$key]','$total[$key]')");
          }
        }
          echo '<script>window.location = "invoices.php?ticket_id='.$ticket_id.'" </script>';

}if(isset($_GET['invoice_id']) AND isset($_GET['status'])){
    $invoice_id=$_GET['invoice_id'];
    $status=$_GET['status'];
    if($status == 'Paid'){
        $status1='Paid';
    }else if($status == 'Cancelled'){
        $status1='Cancelled';
    }
    mysqli_query($conn,"UPDATE `invoices` SET `inv_status`='$status1' WHERE `invoice_id`='$invoice_id'");
    echo '<script>window.location = "invoices.php" </script>';
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

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 10,
                responsive: true,
                "order": [[ 4, "desc" ]]
            });

        });

    </script>

</body>

</html>

<!-- Localized -->
<script type="text/javascript">
   $(document).ready(function() {
$('#data').on('keyup', '.disc, .qty, .rate, .cal', calculateRow);
$('#addnew').click(function() {
    $('#data').append('<tr>\n\
            <td><input type="text" class="form-control" name="rot_status" placeholder=""></td>\n\
            <td><input type="text" class="form-control" name="item_name[]" placeholder="Name of the Item"></td>\n\
            <td align="center"><input type="text" class="qty form-control" name="quantity[]" placeholder="Quantity"></td>\n\
            <td width="10%"><select name="quantity_type[]" class="form-control" tabindex="-1"><option value="hours">hours</option><option value="pieces">pieces</option></select></td>\n\
            <td align="center"><input type="text" class="rate form-control" name="price[]" value="0"></td>\n\
            <td align="center"><input type="text" class="disc form-control" name="discount[]" value="0" ></td>\n\
            <td align="center"><input type="text" class="cal form-control" name="total[]" value="0"></td>\n\
            <td><button type="button" class="btn btn-primary btn-sm removebutton" tabindex="4">Delete</button></td>\n\
        </tr>'
                     );
    $('#data').off('keyup').on('keyup', ' .disc, .qty, .rate, .cal', calculateRow);
});
function calculateRow() {
    var cost = 0;
    var disc = 0;
    var $row = $(this).closest("tr");

    var qty = parseFloat($row.find('.qty').val());
   var rate = parseFloat($row.find('.rate').val());
   var disc = parseFloat($row.find('.disc').val());
   
   if (isNaN(disc)) {
       disc = 0;
    }
    cost1 = qty * rate;
    disc_per=(disc/100)*cost1
    cost = cost1-disc_per;
    
  
    if (isNaN(cost)) {
        $row.find('.cal').val("0");
    } else {
        $row.find('.cal').val(cost);
    }
    

}
});

   $(document).on('click', 'button.removebutton', function () {
     $(this).closest('tr').remove();
     return false;
 });
</script>
<script>
$(document).ready(function(){
    $("#send").click(function(){
        $.get("invoicesend.php?ticket_id=<?php echo $ticket_id; ?>", function(data){
            alert("Invoice sent successfully!" );
        });
    });
});
</script>
<!--=============================ROT Modal====================-->
<div class="modal fade" id="Rot" tabindex="-1" role="dialog" aria-labelledby="CloseLabel">
<div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center" role="document">
        <div class="modal-content animated fadeIn">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="CloseLabel">Enter ROT details</h4>
            </div>
            <?php
            $rot_res= mysqli_query($conn,"SELECT * FROM `rot` WHERE `ticket_id`='$ticket_id'");
            $rot_row=mysqli_fetch_array($rot_res);
            $label1=$rot_row['label1'];
            $label2=$rot_row['label2'];
            $label3=$rot_row['label3'];
            $label4=$rot_row['label4'];
            $personal_number=$rot_row['personal_number'];
            ?>
            <form class="form-horizontal" method="POST" action="addrot.php">
            <input type="hidden" name="ticket_id" class="form-control ticket_id" id="ticket_id">
                <div class="modal-body">
                    <div class="form-group"><label class="col-lg-3 control-label">Fastighetsbeteckning</label>
                        <div class="col-lg-8"><input type="text" name="label1" value="<?php if(isset($label1)){echo $label1;} ?>" class="form-control">
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Lägenhetsbeteckning</label>
                        <div class="col-lg-8"><input type="text" name="label2" value="<?php if(isset($label1)){echo $label2;} ?>" class="form-control"> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Bostadsrättsförenings org. nr</label>
                        <div class="col-lg-8"><input type="text" name="label3" value="<?php if(isset($label1)){echo $label3;} ?>" class="form-control"> 
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-3 control-label">Personnummer</label>
                        <div class="col-lg-8"><input type="text" name="personal_number" value="<?php if(isset($label1)){echo $personal_number;} ?>" class="form-control"> 
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Add ROT data" name="rot" class="btn btn-primary" />
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script type="text/javascript">
$("#Rot").on("show.bs.modal",function(e){var a=$(e.relatedTarget),t=a.data("whatever"),o=$(this);o.find("#ticket_id").val(t)});
</script>

<script type="text/javascript">
    $("[data-hover='tooltip']").tooltip();
</script>