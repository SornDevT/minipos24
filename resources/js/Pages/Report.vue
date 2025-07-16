<template lang="">
    <div class="row">
            <div class="col-md-8">
               <div class="card">
    <h5 class="card-header">ລາຍງານ</h5>
    <div class="card-body">

        <div class="row"> 
          <!-- {{Sort}} -->
            <div class="col-md-6 mb-2 d-flex align-items-center">
                


            </div>
            <div class="col-md-6 mb-2 d-flex justify-content-end">
                <div class="btn-group me-2" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-secondary" @click="month_type = 'm'"> <i class='bx bx-chevron-right' v-if="month_type =='m'"></i> ເດືອນ</button>
                  <button type="button" class="btn btn-secondary" @click="month_type = 'y'"> <i class='bx bx-chevron-right' v-if="month_type == 'y'"></i> ປີ</button>
                </div>
                <input type="date" v-model="dmy" class=" form-control w-auto">
            </div>
        </div>

        <div>
            <LineChart  :chartData="chData" :options="choption" />
            <!-- <DoughnutChart :chartData="testData" /> -->
        </div>

      
          </div>
    </div>
  
            </div>
            <div class="col-md-4">
                123
            </div>
    </div>
</template>
<script>
import { useStore } from '../Store/auth';
import { DoughnutChart, LineChart } from 'vue-chart-3';
import { Chart, registerables } from "chart.js";

Chart.register(...registerables);


export default {
    setup() {
        const store = useStore();
        return { store };
    },
    data() {
        return {
            sum_income:0,
            sum_expense:0,
            dmy:new Date().toISOString().split('T')[0],
            month_type:'m',
            // testData: {
            //             labels: ['Paris', 'Nîmes', 'Toulon', 'Perpignan', 'Autre'],
            //             datasets: [
            //                 {
            //                 data: [30, 40, 60, 70, 5],
            //                 backgroundColor: ['#77CEFF', '#0079AF', '#123E6B', '#97B0C4', '#A5C8ED'],
            //                 },
            //             ],
            //         }
            choption:{
                plugins:{
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem, data) {
                            return (
                                Number(tooltipItem.raw) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                            },
                        },
                        mode: "index",
                        intersect: false,
                        },
              },
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y:{
                            ticks: {
                                display: true,
                                beginAtZero: false,
                                callback: function (value, index, values) {
                                return ( Number(value) .toFixed(0) .replace(/./g, function (c, i, a) { return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c; }) + " ກີບ" );
                                },
                            },
                            gridLines: {
                                show: true,
                            },
                            },
                    },
                    
            },
            chData:{},
        }
    },
    components:{
        // DoughnutChart
        LineChart
    },
    methods:{
        CreatedReport(){

             axios.get(`/api/report?dmy=${this.dmy}&month_type=${this.month_type}`,{
                headers: {
                    Authorization: `Bearer ${this.store.getToken}`,
                },
            }).then(response => {
                    
                    this.chData = {
                        labels: response.data.labels,
                        datasets:[
                            {
                                label: "ລາຍຮັບ",
                                fill: false,
                                borderColor: "#3fc3ee",
                                data: response.data.income,
                                backgroundColor: "#9BD0F5"
                            },
                            {
                                label: "ລາຍຈ່າຍ",
                                fill: false,
                                borderColor: "#f1556c",
                                data: response.data.expense,
                                backgroundColor: "#FFB1C1"
                            }
                        ]

                    }

                    this.sum_income = response.data.sum_income;
                    this.sum_expense = response.data.sum_expense;


                }).catch(error => {
                console.log(error.response.status);
                                    if(error){
                                        if(error.response.status === 401){
                                            localStorage.removeItem('web_token');
                                            localStorage.removeItem('web_user');
                                            this.store.logOut();
                                            this.$router.push('/login');
                                        }
                                    }
            });

        }
    },
    created(){
        this.CreatedReport()
    },
    watch:{
        month_type(){
            this.CreatedReport()
        },
        dmy(){
            this.CreatedReport()
        }
    }
}
</script>
<style lang="">
    
</style>