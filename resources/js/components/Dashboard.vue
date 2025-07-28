<template>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <Sidebar />

        <!--Main Content-->
        <div class="main-content">
            <!--  Header Statics -->
            <div class="row stats-cards">
                <StatisticCard
                    title = "Total Ideas"
                    :count= "totalIdeas"
                    icon="fa fa-lightbulb"
                    class= "bg-primary"
                    />
                    <StatisticCard
                    title = "New Ideas"
                    :count= "newIdeas"
                    icon="fa fa-plus-circle"
                    class= "bg-info"
                    />
                    <StatisticCard
                    title = "Approved Ideas"
                    :count= "approvedIdeas"
                    icon="fa fa-check-circle"
                    class= "bg-success"
                    />
                    <StatisticCard
                    title = "Rejected Ideas"
                    :count= "rejectedIdeas"
                    icon="fa fa-times-circle"
                    class= "bg-danger"
                    />
            </div>
            <!-- <div class="row stats-cards">
                <div class="stats-card bg-primary">
                    <h6>Participation Rate</h6>
                    <h4>{{ participtionRate.toFixed(2) }}%</h4>
                    <i class="fa fa-users icon"></i>
                </div>
                <div class="stats-card bg-success">
                    <h6>Implementation Rate</h6>
                    <h4>{{ implementationRate.toFixed(2) }}%</h4>
                    <i class="fa fa-tasks icon"></i>
                </div>
                <div class="stats-card bg-warning">
                    <h6>Average Processing Time Rate</h6>
                    <h4>{{ processingTime }} Days</h4>
                    <i class="fa fa-clock icon"></i>
                </div>
                <div class="stats-card bg-info">
                    <h6>Idea Rate</h6>
                    <h4>{{ ideaRate.toFixed(2) }}%</h4>
                    <i class="fa fa-lightbulb icon"></i>
                </div>

            </div> -->
            <div class="dashboard-cards">
                <!--Participation Rate-->
                <div class="card-box">
                    <circle-progress
                        :value="participationRate"
                        :max="100"

                        :size="120"
                        :stroke-width="10"
                        color="'#4CAF50'"
                        :background="'#ECECEC'"
                        />
                        <p>Participation Rate</p>

                       <span class="precentage-text"> {{ participtionRate }}%</span>
                </div>
                <div class="card-box">
                    <circle-progress
                        :value="averageProcessingTimeRate"
                        :max="100"
                        :text="'$averageProcessingTimeRat)%'"
                        :size="120"
                        :stroke-width="10"
                        color="'#FFC107'"
                        :background="'#ECECEC'"
                        />
                        <p>Average Processing Time Rate</p>
                        <span class="precentage-text"> {{ averageProcessingTimeRat }}Days</span>
                </div>
                <div class="card-box">
                    <circle-progress
                        :value="implementationRate"
                        :max="100"
                        :text="'$(implementationRate)%'"
                        :size="120"
                        :stroke-width="10"
                        color="'#FFC107'"
                        :background="'#ECECEC'"
                        />
                        <p>Implementation Rate</p>
                        <span class="precentage-text"> {{ implementationRate }}%</span>
                </div>
                <div class="card-box">
                    <circle-progress
                        :value="ideaRate"
                        :max="100"
                        :text="'$(ideaRate)%'"
                        :size="120"
                        :stroke-width="10"
                        color="'#2196F3'"
                        :background="'#ECECEC'"
                        />
                        <p>Idea Rate</p>
                        <span class="precentage-text"> {{ ideaRate  }}%</span>
                </div>

            </div>
        <!-- Chart -->
            <!-- <div class="row chart-section mt-4">
                <div class="col-lg-6">
                    <Chart :data= "chartData" />
                </div>
            </div> -->
            <div>
                <div class="row chart-section mt-4">
                    <div class="col-lg-6">
                        <IdeasTable />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StatisticCard from "./StatisticCard.vue";
import Chart from "./Chart.vue";
import axios from 'axios';
import Sidebar from "./Sidebar.vue";
import CircleProgress from "vue3-circle-progress";
import IdeasTable from "./IdeasTable.vue";

export default {
    components: {
        StatisticCard,
        Chart,
        Sidebar,
        CircleProgress,
        IdeasTable,

    },
    data() {
        return {
            participtionRate:80,
            implementationRate:80,
            averageProcessingTimeRat:0,
            ideaRate:10,
            totalIdeas:0,
            newIdeas:0,
            approvedIdeas:0,
            rejectedIdeas:0,
            chartData:[],
        };
    },
    methods:{
        
},
    mounted() {
        
     },

};
</script>

<style scoped>
@import '../../css/app.css';
@import 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css';
@import 'https://unpkg.com/filepond/dist/filepond.css';
@import 'http://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
</style>

