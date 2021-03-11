<template>
    <div class="activities">
        <div class="w-100 d-flex mb-3">
            <input type="text" name="" id="" class="form-control me-3">
            <button class="btn btn-primary">Agregar</button>
        </div>
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Actividad</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>

            <tbody>

                <tr v-for="(activity,index) in activities" :key="index">
                    <th scope="row">{{index+1}}</th>
                    <td>{{activity.activity}}</td>
                    <td><button class="btn btn-danger">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = window.codigo;


export default {
    created () {
        // fetch("/api/empresa/getactivities", {
        //     method: "GET",
        //     headers: {
        //       "Content-Type": "application/json",
        //       "Accept": "application/json",
        //       "X-Requested-With": "XMLHttpRequest",
        //       "X-CSRF-Token": window.codigo
        //     },
        //   })
        //     .then(function (response) {
        //         console.log('MACHINIMA')
        //         console.log(response)
        //     })
        //     .catch(function (error) {
        //       console.error("Error:", error);
        //     });

        axios.get('/api/empresa/getactivities')
        .then((response) => {
            this.activities = response.data
            console.log(response.data);
        })
        .catch(function (error) {
            // handle error
            console.log(error);
        })
        .then(function () {
            // always executed
        });
    },
    data() {
        return {
            activities: []
        }
    },
    methods: {
        saludo(){
            console.log('Conejo')
        }
    }
}
</script>

<style>

</style>