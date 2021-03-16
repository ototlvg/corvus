<template>
    <div class="activities">
        <div class="w-100 d-flex mb-3">
            <input type="text" v-model="activity" class="form-control me-3">
            <button class="btn btn-primary" @click="add">Agregar</button>
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
                    <td><button class="btn btn-danger" @click="destroy(activity.id)">Eliminar</button></td>
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

        this.get()
    },
    data() {
        return {
            activities: [],
            activity: ''
        }
    },
    methods: {
        saludo(){
            console.log('Conejo')
        },

        get(){
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

        add(){
            console.log('accionado')

            if(this.activity == ''){
                console.log('falso')
                return false;
            }

            axios.post('/api/empresa/addactivity', {
                activity: this.activity
            })
            .then((response) => {
                console.log(response.data);
                this.activity = ''
                this.get()
            })
            .catch(function (error) {
                console.log(error);
            });

        },

        destroy($id){
            console.log('id: ' + $id)
            axios.delete('/api/empresa/destroyactivity/'+$id, {
                activityid: $id
            })
            .then((response) => {
                console.log(response.data);
                // this.activity = ''
                this.get()
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    }
}
</script>

<style>

</style>