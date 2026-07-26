new Chart(document.getElementById('chartPendapatan'), {

    type: 'line',

    data: {
        labels: [...],
        datasets: [{
            label: 'Pendapatan',

            data: [...],

            borderColor: '#4e73df',
            backgroundColor: 'rgba(78,115,223,.15)',

            fill: true,

            tension: .4,

            pointRadius: 4,

            pointHoverRadius: 6
        }]
    },

    options: {

        plugins:{
            legend:{
                display:false
            }
        },

        scales:{
            y:{
                beginAtZero:true
            }
        }

    }

});