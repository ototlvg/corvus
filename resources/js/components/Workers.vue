<template>
    <div class="w-100">

        <div class="d-flex justify-content-between">

            <div class="d-flex flex-column me-5">
                <h6 class="card-subtitle mb-2 text-muted">Hombres</h6>
                <div class="d-flex">
                    <input type="number" name="" id="" class="form-control me-3" v-model="men">
                    <button type="button" class="btn btn-success" @click="updateMen()"><i class="bi bi-save"></i></button>
                </div>
            </div>

            <div class="d-flex flex-column">
                <h6 class="card-subtitle mb-2 text-muted">Mujeres</h6>
                <div class="d-flex">
                    <input type="number" name="" id="" class="form-control me-3" v-model="women">
                    <button type="button" class="btn btn-success" @click="updateWomen()" ><i class="bi bi-save"></i></button>
                </div>
            </div>


        </div>

        <div class="w-100 p-5">
            
            <canvas id="myChart" width="400" height="400"></canvas>

        </div>
        <!-- <p>kjsdaklj</p> -->
    </div>
</template>

<script>
    import Chart from 'chart.js';
    export default {

        data() {
            return {
                men: 110,
                women: 50,
                myChart: null
            }
        },
        

        mounted () {
            var ctx = document.getElementById('myChart');
            console.log(ctx)
            let men = this.men
            let women = this.women
            this.myChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Red', 'Blue'],
                    datasets: [{
                        label: '# of Votes',
                        data: [men, women],
                        backgroundColor: [
                            'rgba(13, 110, 253, 1)',
                            'rgba(236, 64, 122, 0.9)',
                        ],
                        borderColor: [
                            // 'rgba(255, 99, 132, 1)',
                            // 'rgba(54, 162, 235, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        },

        methods: {
            update() {
                this.men = this.men+1
                // this.women = this.women+1
                this.myChart.data.datasets[0].data[0]=this.men
                this.myChart.update()
                console.log('cocococo')
            },

            updateMen(){
                this.myChart.data.datasets[0].data[0]=this.men
                this.myChart.update()
            },

            updateWomen(){
                this.myChart.data.datasets[0].data[1]=this.women
                this.myChart.update()
            }
        },
        
    }
</script>

<style>

</style>