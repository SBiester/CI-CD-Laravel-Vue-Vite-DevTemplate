<template>
<div class="chart-container">
    <div class="card1">
        <div class="card-header">
            <h5 class="card-title">Chart example</h5>
        </div>
        <div class="card-body">
             <canvas id="status-chart"></canvas>
        </div>
    </div>
</div>

</template>

<script>
import Chart from "chart.js/auto";

export default{
    props:{
        data:Array,
    },
    mounted() {
        this.createChart();
    },
    methods: {
        createChart() {
            const ctx = document.getElementById("status-chart").getContext("2d");
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: ["Approved", "Rejected", "New" ],
                    datasets: [
                        {
                            labels: "Ideas",
                            data: this.data,
                            backgroundColor: ['#28a754', '#dc3545', '#17a2b8'],
                        },
                    ],
                },
                options:{
                    responsive: true,
                    maintainAspectRatio: false,
                },
            });
        },
    },
};
</script>
<style scoped>
.chart-container {
    max-width:100%;
    height: 400px;
    margin: 20px auto;
}
.card1 {
    border: none;
    box-shadow: 0 4px 6px  rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    padding: 15px;
    background-color: #fff;
}
.card-header {
    text-align: center;
    margin-bottom: 10px;
}
.card-title {
    font-weight: bold;
    font-size: 16px;
}
canvas {
    max-width: 100%;
    height: 400px;
}
</style>
