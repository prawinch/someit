
<?php
include '../../dbconnect9.php';

$hall=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Hall'");
$hall1=mysqli_num_rows($hall);

$bathroom=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Bathroom'");
$bathroom1=mysqli_num_rows($bathroom);

$apartment=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Apartment'");
$apartment1=mysqli_num_rows($apartment);

$kitchen=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Kitchen'");
$kitchen1=mysqli_num_rows($kitchen);

$bedroom=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Bedroom'");
$bedroom1=mysqli_num_rows($bedroom);

$livingroom=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Living room'");
$livingroom1=mysqli_num_rows($livingroom);

$other=mysqli_query($conn,"SELECT `service` FROM `tickets` WHERE `service` = 'Other'");
$other1=mysqli_num_rows($other);
?>
<script type="text/javascript">
$(function () {
  var hall = <?php echo $hall1; ?> ;
  var bathroom = <?php echo $bathroom1; ?> ;
  var apartment = <?php echo $apartment1; ?> ;
  var kitchen = <?php echo $kitchen1; ?> ;
  var bedroom = <?php echo $bedroom1; ?> ;
  var livingroom = <?php echo $livingroom1; ?> ;
  var other = <?php echo $other1; ?> ;

    var data = [{
        label: "Hall",
        data: hall,
        color: "#d3d3d3",
    }, {
        label: "Badrum",
        data: bathroom,
        color: "#1c84c6",
    }, {
        label: "Lägenhet",
        data: apartment,
        color: "#f4ee41",
    }, {
        label: "Kök",
        data: kitchen,
        color: "#f47041",
    }, {
        label: "Sovrum",
        data: bedroom,
        color: "#41c4f4",
    }, {
        label: "Vardagsrun",
        data: livingroom,
        color: "#6d41f4",
    }, {
        label: "Övrig",
        data: other,
        color: "#f441eb",
    }];

    var plotObj = $.plot($("#flot-pie-chart"), data, {
        series: {
            pie: {
                show: true
            }
        },
        legend: {
        show: false
        },
        grid: {
            hoverable: false
        },
        tooltip: true,
        tooltipOpts: {
            content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
            shifts: {
                x: 20,
                y: 0
            },
            defaultTheme: false
        }
    });

});
</script>