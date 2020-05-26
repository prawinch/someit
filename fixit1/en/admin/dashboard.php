<?php

include '../../dbconnect9.php';
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
                    <li class="active">
                        <a href="dashboard.php"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                    </li>
                    <li>
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
        <nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
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
                                $current_date = date("Y-m-d", time());
                                $ticket_age=$current_date-$created_on;
                                $created_on1=substr($created_on,0,10);
                                echo '<li><a href="ticketedit.php?ticket_id=' . $al_ticket_id . '"><div><i class="fa fa-envelope fa-ticket"></i>' . $al_ticket_id . '<span class="pull-right text-muted small">' . $created_on1 . '</span></div></a></li><li class="divider"></li>';
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

<?php
  $statsclose_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` = 'Closed'");
  $statsclose_row=mysqli_num_rows($statsclose_res);
  $statsvendor_res=mysqli_query($conn,"SELECT * FROM `vendors` WHERE 1");
  $statsvendor_row=mysqli_num_rows($statsvendor_res);
$statsinprogress_res = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `status` != 'Closed' AND `status` != 'New' AND `status` != 'Deleted'");
  $statsinprogress_row=mysqli_num_rows($statsinprogress_res);

$today_date = date("Y-m-d h:i:s");
  $today_date=substr($today_date,0,10);
  $statsopentod_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `created_on` LIKE '%$today_date%' AND `status` != 'Closed'");
  $statsopentod_row=mysqli_num_rows($statsopentod_res);
  $statsclosetod_res=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `closed_on` LIKE '%$today_date%' AND `status` = 'Closed'");
  $statsclosetod_row=mysqli_num_rows($statsclosetod_res);
  ?>

        </div>
        <div class="wrapper wrapper-content">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-envelope-open-o fa-5x"></i>
                                </div>
                                <a href="opentickets.php" style="color: #FFFFFF;">
                                <div class="col-xs-8 text-right">
                                    <span> Open Tickets </span>
                                    <h2 class="font-bold"><?php echo $op_tickets_num_rows; ?></h2>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-envelope-o fa-5x"></i>
                                </div>
                                <a href="closedtickets.php" style="color: #FFFFFF;">
                                <div class="col-xs-8 text-right">
                                    <span> Closed Tickets </span>
                                    <h2 class="font-bold"><?php echo $statsclose_row; ?></h2>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-spinner fa-5x"></i>
                                </div>
                                <a href="opentickets.php" style="color: #FFFFFF;">
                                <div class="col-xs-8 text-right">
                                    <span>Inprogress Tickets </span>
                                    <h2 class="font-bold"><?php echo $statsinprogress_row; ?></h2>
                                </div></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="widget style1 navy-bg">
                            <div class="row">
                                <div class="col-xs-4">
                                    <i class="fa fa-users fa-5x"></i>
                                </div>
                                <a href="vendorlist.php" style="color: #FFFFFF;">
                                <div class="col-xs-8 text-right">
                                    <span>Vendors</span>
                                    <h2 class="font-bold"><?php echo $statsvendor_row; ?></h2>
                                </div></a>
                            </div>
                        </div>
                    </div>                    
                </div> 

                <div class="row">
            
                        <div class="col-lg-4">
                            <div class="ibox float-e-margins">
                                <div class="ibox-title">
                                    <h5>Daily Statistics</h5>           
                                </div>
                                <div class="ibox-content" style="padding-bottom: 170px;">
                                    <ul class="list-group clear-list m-t">
                                        <li class="list-group-item fist-item"><span class="label label-success"><?php echo $statsopentod_row; ?></span> Open Tickets</li>
                                        <li class="list-group-item"><span class="label label-info"><?php echo $statsclosetod_row; ?></span> Closed Tickets</li>
                                    </ul>
                                </div>
                            </div>
                        </div> 
                        <div class="col-lg-8">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content">
                                    <div>                                        
                                        <h3 class="font-bold no-margins">
                                            Monthly Statistics
                                        </h3>
                                    </div>

                                <div>
                                    <canvas id="lineChart" height="120"></canvas>
                                </div>                                
                            </div>
                        </div>
                    </div>   
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Services</h5>                            
                            </div>
                            <div class="ibox-content">
                                <div>
                                    <canvas id="doughnutChart1"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="ibox float-e-margins">
                            <div class="ibox-title">
                                <h5>Invocies</h5>
                            </div>
                            <div class="ibox-content" style="height: 300px;">
                                <table class="table table-striped table-bordered table-hover dataTables-example">
                                    <thead>
                                    <tr><th>Ticket ID</th>
                                    <th class="text-right">Invoice ID</th>
                                    <th class="text-right">Status</th></tr></thead>
                                    <tbody>
                                    <?php
                                    $inv_res=mysqli_query($conn,"SELECT * FROM `invoices` ORDER BY `invoice_id` DESC LIMIT 5");
                                    while($inv_row=mysqli_fetch_array($inv_res)){
                                        $inv_ticket_id = $inv_row['ticket_id'];
                                        $inv_res1 = mysqli_query($conn, "SELECT `status` FROM `tickets` WHERE `ticket_id`='$inv_ticket_id'");
                                        $inv_row1 = mysqli_fetch_array($inv_res1);
                                        if ($inv_row1['status'] == 'Invoice Raised') {
                                            echo '<tr><td>' . $inv_row['ticket_id'] . '</td><td class="text-right">' . $inv_row['invoice_id'] . '</td>';
                                            if ($inv_row['inv_status'] == 'Paid') {
                                                echo '<td class="text-right"><span class="label label-primary">' . $inv_row['inv_status'] . '</span></td>';
                                            } else if ($inv_row['inv_status'] == 'UnPaid') {
                                                echo '<td class="text-right"><span class="label label-danger">' . $inv_row['inv_status'] . '</span></td>';
                                            } else if ($inv_row['inv_status'] == 'Cancelled') {
                                                echo '<td class="text-right"><span class="label">' . $inv_row['inv_status'] . '</span></td>';
                                            }
                                        echo '</tr>';
                                        }
                                    }
                                    ?>                                
                                    </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
                    
                            

    <!-- Mainly scripts -->
    <script src="../../global/js/jquery-3.1.1.min.js"></script>
    <script src="../../global/js/bootstrap.min.js"></script>
    <script src="../../global/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="../../global/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Flot -->
    <script src="../../global/js/plugins/flot/jquery.flot.js"></script>
    <script src="../../global/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
    <script src="../../global/js/plugins/flot/jquery.flot.spline.js"></script>
    <script src="../../global/js/plugins/flot/jquery.flot.resize.js"></script>
    <script src="../../global/js/plugins/flot/jquery.flot.pie.js"></script>

    <!-- Peity -->
    <script src="../../global/js/plugins/peity/jquery.peity.min.js"></script>
    <script src="../../global/js/demo/peity-demo.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="../../global/js/inspinia.js"></script>
    <script src="../../global/js/plugins/pace/pace.min.js"></script>

    <!-- jQuery UI -->
    <script src="../../global/js/plugins/jquery-ui/jquery-ui.min.js"></script>

    <!-- GITTER -->
    <script src="../../global/js/plugins/gritter/jquery.gritter.min.js"></script>

    <!-- Sparkline -->
    <script src="../../global/js/plugins/sparkline/jquery.sparkline.min.js"></script>

    <!-- Sparkline demo data  -->
    <script src="../../global/js/demo/sparkline-demo.js"></script>

    <!-- ChartJS-->
    <script src="../../global/js/plugins/chartJs/Chart.min.js"></script>

    <!-- Toastr -->
    <script src="../../global/js/plugins/toastr/toastr.min.js"></script>
    <!-- Flot demo data -->
    
    <!-- Demo JS -->
 <?php
 include 'piechart3.php';
include 'linechart1.php';
?>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success( 'Welcome to FiXiT');

            }, 1300);            

        });
    </script>

</body>
</html>

<!-- Localized -->