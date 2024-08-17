
<div class="container">

  <div>
    <canvas id="myChart"></canvas>
  </div>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
  <script>
    const ctx = document.getElementById('myChart');
  
    new Chart(ctx, {
      type: 'line',
      data: {
        labels: [
      "January", "February", "March", "April", "May", "June",
      "July", "August", "September", "October", "November", "December"
  ],
        datasets: [{
          label: '# of Votes',
          data: [120, 19, 3, 5, 2, 3],
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>
</div>
