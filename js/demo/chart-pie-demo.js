// Set new default font family and font color to mimic Bootstrap's default styling
/*Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Pie Chart Example
var ctx = document.getElementById("myPieChart");
var myPieChart = new Chart(ctx, {
  type: 'doughnut',
  data: {
    //tipos de ocorrências
    labels: ["Direct", "Referral", "Social"],
    datasets: [{
      data: [55, 30, 15],
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
});*/
// Define os nomes das tipificações de crimes
var crimeLabels = [
  "Furto", "Roubo", "Receptação", "Arma de Fogo", 
  "Objeto Perfurocortante", "Entorpecentes", 
  "Veículo Recuperado", "Kadron", 
  "Foragido", "Outras Tipificações"
];

// Obtém os dados de crimes a partir de uma variável global definida no HTML
var crimeCounts = JSON.parse(document.getElementById('myPieChart').getAttribute('data-crime-counts'));

// Define os nomes das tipificações de crimes
var crimeLabels = [
    "Furto", "Roubo", "Receptação", "Arma de Fogo", 
    "Objeto Perfurocortante", "Entorpecentes", 
    "Veículo Recuperado", "Kadron", 
    "Foragido", "Outras Tipificações"
];

// Configura o gráfico
var ctx = document.getElementById("myPieChart").getContext('2d');
var myPieChart = new Chart(ctx, {
    type: 'doughnut',
    data: {
        labels: crimeLabels,
        datasets: [{
            data: crimeCounts,
            backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e', '#e74a3b', '#858796', '#f8f9fc', '#5a5c69', '#4e73df', '#1cc88a'],
            hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#dda20a', '#d62a1c', '#6c757d', '#d1d3e2', '#2c2f33', '#3c7dd9', '#17b28a'],
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
            display: true,
            position: 'bottom'
        },
        cutoutPercentage: 80,
    },
});
