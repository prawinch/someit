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
                    <li>
                        <a href="#"><i class="fa fa-ticket"></i> <span class="nav-label">Tickets</span><span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse">
                            <li><a href="opentickets.php">Öppna<span class="label label-success pull-right">
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

                    <li class="active">
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
                                    <strong>See alla</strong>
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
                <div class="col-lg-8">
                    <h2>Manual Invoice Creation</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>Invoice</strong>
                        </li>
                    </ol>
                </div>

                <!--<div class="col-lg-4">
                    <div class="title-action">                        
                        <a href="invoicepdf.php?ticket_id=<?php echo $ticket_id; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-file"></i> Generate PDF</a>
                    </div>
                </div>-->
            </div>
        <form method="POST" action="invoices.php">
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                <div class="col-sm-6">
                                    <img src="logo.png" width="300px" height="200px">
                                </div>
                                <div class="col-sm-6 table-responsive m-t">
                                    <table class="table table-bordered">
                                    <tr><td colspan="4" width="800px"><h1 align="center"><b>Faktura</b></h1></td></tr>
                                    <tr>
                                    <td align="center" width="25%" height="50px"><b>Fakturanummer</b><br></td>
                                    <td align="center" width="25%"><b>Kundnummber</b> <br></td>
                                    <td align="center" width="25%"><b>Fakturadatum</b> <br><input type="text" class="form-control" name="invoice_date" value="<?php echo date("d-m-Y"); ?>">
                                        </td>
                                    <td align="center" width="25%"><b>Sida</b> <br>1</td></tr>
                                    <tr style="vertical-align: top; text-align: left;">
                                    <td colspan="4" width="25%" height="100px"><b>Faktureringsadress</b><br><textarea class="form-control"></textarea></td></tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <table class="table table-borderless">
                            <tr><td width="50%" height="20px"><b>var referns</b> : </td><td width="50%"><b>Betalningsvillkor</b>  : 
                             <select name="bill_due">
                             <option value="10" selected> 10 days </option><option value="20"> 20 days </option><option value="30"> 30 days </option>                             
                             </select></td></tr>
                            <tr><td width="50%" height="20px"><b>Er referens</b> : </td><td width="50%"><b>förfallodatum</b> : </td></tr>
                            <tr><td width="50%" height="20px"><b>Ert Ordernummer</b> : </td><td width="50%"></td></tr>
                            </table>


                            <table class="table table-bordered">                            
                            <tr><td>Description</td></tr>
                            <tr><td>
                            <textarea class="form-control" name="description"></textarea>
                            </td></tr>
                            </table>
                            
                            <h4>ROT Status: </h4>
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
                                        <th style="width: 5%">Edit</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                                <input type="button" id="addnew" class="calculate btn btn-primary" name="addnew" value="Add Item" />
                            
                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Frakt :</strong></td>
                                    <td></td>
                                </tr>
                                <?php 
                                //$vat=(25/100)*$sub_total;
                                //$g_total=$sub_total+$shipping+$vat;
                                //$g_total1=round($g_total); 
                                //$rounding=abs($g_total-$g_total1); 
                                ?>
                                <tr>
                                    <td><strong>Belopp fore moms :</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Moms :</strong></td><?php ?>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Öresutjämning :</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Skattereduktion :</strong></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td><strong>Summa att betala :</strong></td>
                                    <td></td>
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
/*
if(isset($_POST['save_invoice'])){
    
        $ticket_id=$_POST['ticket_id'];
        $invoice_id=$_POST['invoice_id'];
        $invoice_date=$_POST['invoice_date'];
        $bill_due=$_POST['bill_due'];
        $bill_due_date= date('d-m-Y', strtotime($invoice_date. ' + '.$bill_due.' days'));
        $description=$_POST['description'];
        $ticket_id=$_POST['ticket_id'];
        $item_name=$_POST['item_name'];
        $quantity=$_POST['quantity'];
        $quantity_type=$_POST['quantity_type'];
        $price=$_POST['price'];      
        $discount=$_POST['discount'];
        $total=$_POST['total'];
        mysqli_query($conn,"UPDATE `invoices` SET `invoice_date`='$invoice_date', `bill_due_date`='$bill_due_date', `bill_due`='$bill_due',`description`='$description' WHERE `invoice_id`='$invoice_id'");

        mysqli_query($conn,"DELETE FROM `invoice_items` WHERE `ticket_id`='$ticket_id' AND `invoice_id`='$invoice_id'");

        foreach ($item_name as $key => $item_name1) {
            mysqli_query($conn,"INSERT INTO `invoice_items`(`invoice_id`, `ticket_id`,`item_name`, `quantity`, `quantity_type`, `price`, `discount`, `total`) VALUES ('$invoice_id','$ticket_id','$item_name[$key]','$quantity[$key]','$quantity_type[$key]','$price[$key]','$discount[$key]','$total[$key]')");
          }
          echo '<script>window.location = "invoices.php?ticket_id='.$ticket_id.'" </script>';          
}
*/
?>
        <div class="footer">
            <div>
                <strong>Fixit</strong>  &copy; 2017 Developed by qa-masters.com
            </div>
        </div>

        </div>
        </div>

    <!-- Mainly scripts -->
    <script src="../../global/js/jquery-3.1.1.min.js"></script>
    <script src="../../global/js/bootstrap.min.js"></script>
    <script src="../../global/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../global/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../global/js/inspinia.js"></script>
    <script src="../../global/js/plugins/pace/pace.min.js"></script>

    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
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
    cost = cost1-disc;
  
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
    $("#Rot").click(function(){
        $("#label1").toggle();
        $("#label2").toggle();
        $("#label3").toggle();
        $("#label4").toggle();
        $("#personal_number").toggle();
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

            <form class="form-horizontal" method="POST" action="addrot.php">
            
                <div class="modal-body">
                    <div class="form-group"><label class="col-lg-3 control-label">Fastighetsbeteckning</label>
                        <div class="col-lg-8"><input type="text" name="label1" value="<?php if(isset($label1)){echo $label1;} ?>" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Lägenhetsbeteckning</label>
                        <div class="col-lg-8"><input type="text" name="label2" value="<?php if(isset($label1)){echo $label2;} ?>" class="form-control" required> 
                        </div>
                    </div>
                    <div class="form-group"><label class="col-lg-3 control-label">Bostadsrättsförenings org. nr</label>
                        <div class="col-lg-8"><input type="text" name="label3" value="<?php if(isset($label1)){echo $label3;} ?>" class="form-control" required> 
                        </div>
                    </div>
                    
                    <div class="form-group"><label class="col-lg-3 control-label">Personnummer</label>
                        <div class="col-lg-8"><input type="text" name="personal_number" value="<?php if(isset($label1)){echo $personal_number;} ?>" class="form-control" required> 
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