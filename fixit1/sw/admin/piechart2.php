<?php
include '../../dbconnect9.php';
$invoice_items_res=mysqli_query($conn,"SELECT * FROM `invoice_items` WHERE 1");
$amt_billed=0;
$discount=0;
while($invoice_items_row=mysqli_fetch_array($invoice_items_res)){
    $amt_billed = $amt_billed+$invoice_items_row['price'];
    $discount = $discount+$invoice_items_row['discount'];
}

$rot=0;
$tax=25;
?>
<script type="text/javascript">
var amt_billed = <?php echo $amt_billed;?> ;
var discount = <?php echo $discount;?> ;
var rot = <?php echo $rot;?> ;
var tax = <?php echo $tax;?> ;

var doughnutData = {
        labels: ["Fakturerad Belopp","MOMS", "ROT", "Rabatt" ],
        datasets: [{
            data: [amt_billed,tax,rot,discount],
            backgroundColor: ["#a3e1d4","#dedede","#b5b8cf","#83f441"]
        }]
    } ;


    var doughnutOptions = {
        responsive: true
    };


    var ctx4 = document.getElementById("doughnutChart").getContext("2d");
    new Chart(ctx4, {type: 'doughnut', data: doughnutData, options:doughnutOptions});

</script>