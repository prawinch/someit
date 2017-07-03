<?php

$html = '
<html>
<head>
</head>
<body>

<table> 
<tr>
<td><img src="logo.png" width="300px" height="200px"></td>
<td>
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
                                    <td align="center" width="25%" height="50px"><b>Fakturanummer</b> <br><?php echo $inv_id; ?></td>
                                    <td align="center" width="25%"><b>Kundnummber</b> <br><?php echo $ticket_id; ?></td>
                                    <td align="center" width="25%"><b>Fakturadatum</b> <br>
                                        <a href="#" id="invoice_date" data-pk="<?php echo $ticket_id;?>" data-url="invoiceupdate.php">12-1-2017</a></td>
                                    <td align="center" width="25%"><b>Sida</b> <br>1</td></tr>
                                    <tr style="vertical-align: top; text-align: left;">
                                    <td colspan="4" width="25%" height="100px">Faktureingsadress</td></tr>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <table class="table table-borderless">
                            <tr><td width="50%" height="20px"><b>Leveransvillkor</b></td><td width="50%"><b>Betalningsvillkor</b>  : <a href="#" id="bill_due" data-pk="" data-type="select" data-value="" data-url="invoiceupdate.php"></a></td></tr>
                            <tr><td width="50%" height="20px"><b>Leveranssätt</b></td><td width="50%"><b>förfallodatum</b> : <?php echo $bill_due_date;?></td></tr>
                            <tr><td width="50%" height="20px"><b>Er referens</b></td><td width="50%"><b>var referns</b> : <?php echo $ini_name; ?></td></tr>
                            <tr><td width="50%" height="20px"><b>Ert Ordernummer</b></td><td width="50%"><b>Ordernummer</b> : <?php echo $inv_id; ?></td></tr>
                            </table>


                            <table class="table table-bordered">                            
                            <tr><td>Description<a href="#" id="pencil"><i class="icon-pencil" style="padding-right: 5px"></i>[edit]</a></td></tr>
                            <tr><td>
                            <div id="description" data-pk="<?php echo $ticket_id;?>" data-type="textarea" data-toggle="manual" data-title="Description" data-placement="top" data-url="invoiceupdate.php"><?php echo $description?></a></div>
                            </td></tr>
                            </table>


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
                                    </tr>

                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->

                                <input type="button" id="addnew" class="calculate btn btn-primary" name="addnew" value="Add Item" />
                            
                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td><span class="sub_total">00.00</span></td>
                                </tr>
                                <tr>
                                    <td><strong>TAX :</strong></td>
                                    <td>00.00</td>
                                </tr>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td>00.00</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="text-right">
                                <button class="btn btn-primary"> Save Invoice</button>
                            </div>

                            <div class="well m-t"><strong>Comments</strong>
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less
                            </div>
                        </div>
                </div>
            </div>
        </div>


</body>
</html>
';
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================
//==============================================================

define('_MPDF_PATH','');
include("mpdf.php");

$mpdf=new mPDF('c','A4','','',20,15,10,25,10,10); 
$mpdf->SetProtection(array('print'));
$mpdf->SetTitle("Fixit - Invoice");
$mpdf->SetAuthor("pradeep");
$mpdf->SetDisplayMode('fullpage');



$mpdf->WriteHTML($html);


$mpdf->Output(); exit;

exit;

?>