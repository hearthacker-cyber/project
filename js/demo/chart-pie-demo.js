
    $ (document).ready(function() {
$.ajax({
url: "http://localhost/hifi11/js/demo/data.php",
method: "GET",
success: function(data) {

    // console.log(data[0].name);

    var name = [] ;
var score = [];
// var colors = [ ] ;
for (var i in data) {
name.push(data[i].name)
score.push(data[i].score);
// colors.push(color());
}




// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'polarArea',
  data: {
    labels: name,
    datasets: [{
      data: score,
      backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
      hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
      hoverBorderColor: "rgba(234, 236, 244, 1)",
    }],
  },
  options: {
    maintainAspectRatio: false,
    tooltips: {
      backgroundColor: "rgb(255,255,255)",
      bodyFontColor: "#858796",
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      caretPadding: 10,
    },
    legend: {
      display: false
    },
    cutoutPercentage: 80,
  },
});


},
error: function (data) {
console.log(data);
}

});



});
  
