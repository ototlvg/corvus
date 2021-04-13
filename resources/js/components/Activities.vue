<style scoped>
    .activities{
        position: relative;
    }

    .loading{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0,0,0, 0.3);
    }

    .act-cont{
        max-height: 280px;
        overflow: auto;
    }
</style>

<template>
    <div class="activities mb-3 bg-white p-4 border">
        <div class="w-100 d-flex mb-3">
            <input @keyup.enter="add" type="text" v-model="activity" class="form-control me-3" placeholder="Agregue una actividad">
            <button class="btn btn-primary" @click="add">Agregar</button>
        </div>

        <div v-if="activities.length != 0" class="act-cont">
            <table class="table table-borderless table-hover m-0">

                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Actividad</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <tr v-for="(activity,index) in activities" :key="index">
                        <!-- <th class="align-middle" scope="row">{{index+1}}</th> -->
                        <th class="align-middle" scope="row">{{activities.length - (index)}}</th>
                        <td class="align-middle">{{activity.activity}}</td>
                        <td class="align-middle"><button class="btn btn-danger" @click="destroy(activity.id)">Eliminar</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="w-100 text-center text-secondary" v-else>
            <p class="m-0 p-3">Aun no se registran actividades</p>
        </div>

        <div class="loading d-flex justify-content-center align-items-center" v-if="loading">
            
            <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>

        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Swal from 'sweetalert2'

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
            activity: '',
            loading: false
        }
    },
    methods: {
        saludo(){
            console.log('Conejo')
        },

        get(){
            this.loading = true
            axios.get('/api/empresa/getactivities')
                .then((response) => {
                    this.activities = response.data
                    console.log(response.data);
                })
                .catch(function (error) {
                    // handle error
                    alert('Error al tratar de agregar la actividad')
                    console.log(error);
                })
                .then(() => {
                    // always executed
                    this.loading = false
                });
        },

        add(){
            console.log('accionado')

            if(this.activity == ''){
                console.log('falso')
                return false;
            }

            this.loading = true
            axios.post('/api/empresa/addactivity', {
                activity: this.activity
            })
            .then((response) => {
                console.log(response.data);
                this.activity = ''
                this.get()
            })
            .catch(function (error) {
                alert('Error al tratar de agregar la actividad')
                console.log(error);
            })
            .then( () => {
                // always executed
                this.loading = false
            });

        },

        destroy($id){
            console.log('id: ' + $id)
            axios.delete('/api/empresa/destroyactivity/'+$id, {
                activityid: $id
            })
            .then((response) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Actividad eliminada',
                    showConfirmButton: false,
                    timer: 1000
                })
                console.log('Eliminado')
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