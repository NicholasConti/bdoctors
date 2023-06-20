import { Chart } from "chart.js/auto";

// assi cartesiani

const labels = [
    'January',
    'February',
    'March',
    'April',
    'May',
    'June',
];

//dati grafico

const data = {
    labels: labels,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5, 2, 20, 30, 45],
    }]
};

//config data

const config = {
    type: 'line',
    data: data,
    options: {}
};

//genera nuovo grafico

new Chart(
    document.getElementById('myChart'),
    config
);