
<?php
include '../../dbconnect9.php';
$ticket_res = mysqli_query($conn, "SELECT * FROM `tickets` WHERE `status` !='Closed' AND `status`!='Deleted'");

$jan= $feb= $mar= $apr= $may= $jun= $jul= $aug= $sep= $oct= $nov= $dec=0;

while($ticket_row=mysqli_fetch_array($ticket_res)){
    $date = $ticket_row['created_on'];
    //echo $date."</br>";
    $month = date('F', strtotime($date));
    if($month=='January'){
        $jan = $jan+1;
    }else if($month=='February'){
        $feb=$feb+1;
    }else if($month=='March'){
        $mar=$mar+1;
    }else if($month=='April'){
        $apr=$apr+1;
    }else if($month=='May'){
        $may=$may+1;
    }else if($month=='June'){
        $jun=$jun+1;
    }else if($month=='July'){
        $jul=$jul+1;
    }else if($month=='August'){
        $aug=$aug+1;
    }else if($month=='September'){
        $sep=$sep+1;
    }else if($month=='October'){
        $oct=$oct+1;
    }else if($month=='November'){
        $nov=$nov+1;
    }else if($month=='December'){
        $dec=$dec+1;
    }
}

$jan1= $feb1= $mar1= $apr1= $may1= $jun1= $jul1= $aug1= $sep1= $oct1= $nov1= $dec1=0;
$ticket_res1=mysqli_query($conn,"SELECT * FROM `tickets` WHERE `status` ='Closed'");
while($ticket_row1=mysqli_fetch_array($ticket_res1)){
    $date = $ticket_row1['closed_on'];
    //echo $date."</br>";
    $month = date('F', strtotime($date));
    if($month=='January'){
        $jan1 = $jan1+1;
    }else if($month=='February'){
        $feb1=$feb1+1;
    }else if($month=='March'){
        $mar1=$mar1+1;
    }else if($month=='April'){
        $apr1=$apr1+1;
    }else if($month=='May'){
        $may1=$may1+1;
    }else if($month=='June'){
        $jun1=$jun1+1;
    }else if($month=='July'){
        $jul1=$jul1+1;
    }else if($month=='August'){
        $aug1=$aug1+1;
    }else if($month=='September'){
        $sep1=$sep1+1;
    }else if($month=='October'){
        $oct1=$oct1+1;
    }else if($month=='November'){
        $nov1=$nov1+1;
    }else if($month=='December'){
        $dec1=$dec1+1;
    }
}
?>
<script type="text/javascript">


        $(document).ready(function() {
    var jan=<?php echo $jan;?>;
    var feb=<?php echo $feb;?>;
    var mar=<?php echo $mar;?>;
    var apr=<?php echo $apr;?>;
    var may=<?php echo $may;?>;
    var jun=<?php echo $jun;?>;
    var jul=<?php echo $jul;?>;
    var aug=<?php echo $aug;?>;
    var sep=<?php echo $sep;?>;
    var oct=<?php echo $oct;?>;
    var nov=<?php echo $nov;?>;
    var dec=<?php echo $dec;?>;

    var jan1=<?php echo $jan1;?>;
    var feb1=<?php echo $feb1;?>;
    var mar1=<?php echo $mar1;?>;
    var apr1=<?php echo $apr1;?>;
    var may1=<?php echo $may1;?>;
    var jun1=<?php echo $jun1;?>;
    var jul1=<?php echo $jul1;?>;
    var aug1=<?php echo $aug1;?>;
    var sep1=<?php echo $sep1;?>;
    var oct1=<?php echo $oct1;?>;
    var nov1=<?php echo $nov1;?>;
    var dec1=<?php echo $dec1;?>;
            var d1, d2, data, chartOptions;

            var lineData = {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [
                    {
                        label: "Open Tickets",
                        backgroundColor: "rgba(26,179,148,0.5)",
                        borderColor: "rgba(26,179,148,0.7)",
                        pointBackgroundColor: "rgba(26,179,148,1)",
                        pointBorderColor: "#fff",
                        data: [jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec]
                    },
                    {
                        label: "Closed Tickets",
                        backgroundColor: "rgba(220,220,220,0.5)",
                        borderColor: "rgba(220,220,220,1)",
                        pointBackgroundColor: "rgba(220,220,220,1)",
                        pointBorderColor: "#fff",
                        data: [jan1, feb1, mar1, apr1, may1, jun1, jul1, aug1, sep1, oct1, nov1, dec1]
                    }
                ]
            };

            var open_max = Math.max(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec);
            var close_max = Math.max(jan, feb, mar, apr, may, jun, jul, aug, sep, oct, nov, dec);
            var max = Math.max(open_max, close_max);

            var lineOptions = {
                responsive: true,
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black',
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 15,
                            max: max + 10 //max value for the chart is 60
                        }
                    }]
                }
            };


            var ctx = document.getElementById("lineChart").getContext("2d");
            new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});

        });
</script>