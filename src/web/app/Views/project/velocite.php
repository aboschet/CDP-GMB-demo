  <?php if(isset($error)) : ?>
  <div class="col-md-12 alert alert-danger">
    <?php 
    foreach($error as $value) {
        echo "<p>".$value."</p>";
     }?>
  </div>
 <?php endif; ?>
 <?php if(isset($message)) : ?>
  <div class="col-md-12 alert alert-success">
    <?= $message; ?>
  </div>
 <?php endif; ?>
 
 <div class="col-md-12">
  <canvas id="myChart"></canvas>

   <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

   <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: [<?= $velociteInfo["name"]; ?>],
        datasets: [{
          label: 'Wanted',
          fill: false,
          data: [<?= $velociteInfo["wanted"]; ?>],
          borderColor: "rgba(153,255,51,0.4)",
          spanGaps: false
        }, {
          label: 'Done',
          fill: false,
          data: [<?= $velociteInfo["done"]; ?>],
          borderColor: "rgba(255,153,0,0.4)",
          spanGaps: false
        }]
      }
    });
   </script>
   
  </div>
