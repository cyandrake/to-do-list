<template>
    <div>
        <!-- Page Loader -->
        <div id="loader-wrapper">
            <div id="loader"></div>

            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>

        </div>

        <!-- Gallery -->
        <div class="container-fluid tm-container-content tm-mt-60">
            <h1 class="tm-text-primary" style="font-size: 4.5rem;">
                To Do List
            </h1><br><br>
            <div class="row mb-4">
                <div class="col-5 d-flex align-items-center">
                    <button type="button" class="btn btn-primary" style="padding:.375rem 0.75rem; margin-right: 15px;" v-on:click="addTaskModal">
                        Add Task
                    </button>
                </div>
            </div>
            <br><br>
            <h2 class="tm-text-primary">Task List</h2>
            <div v-for="item in data" :key="item.id" class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-5">
                <div class="d-flex justify-content-between">
                    <span>{{(item.title)}}</span>
                    <span>
                        <i style="cursor:pointer;" v-on:click="updateTaskModal(item.id, item.title)" class="fas fa-edit"></i>
                        <i style="cursor:pointer;" v-on:click="deleteTask(item.id)" class="fas fa-trash"></i>
                    </span>
                </div>
            </div>
        </div>

        <!-- Add/Update task modal -->
        <div class="modal fade" id="modal-task-add-update">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{modal_title}}</h4>
                        <button type="button" class="close" data-dismiss="modal" v-on:click="closeModal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Task:</label>
                                <input type="text" class="form-control" id="filename" placeholder="" v-model="task.title">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button href="#" class="btn btn-primary" data-dismiss="modal" v-on:click="submitPage">{{modal_submit}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    var moment = require('moment');

    export default {
        data() {
            return {
                data: [],
                task: {
                    id: 0,
                    title: ''
                },
                modal_title: 'Add Task',
                modal_submit: 'Submit',
                update_counter: 0
            }
        },
        beforeMount() {
            var self = this
            self.getData((data) => {})
        },
        methods: {
            getData(cb){
                var self = this

                axios.get('/api/task')
                .then(function (resp) {
                    self.data = resp.data
                    console.log(self.data)
                    cb(self.data)
                })
                .catch(function (err) {
                    console.log(err)
                })

            },
            submitPage : function(){
                var self = this

                var params = {
                    id: self.task.id,
                    title: self.task.title,
                }

                if(self.update_counter == 0){
                    axios.post('/api/task', params)
                    .then(function (resp) {
                        self.getData((data) => {})
                        $('#modal-task-add-update').modal('hide')
                    })
                    .catch(function (err) {
                        console.log(err)
                        console.log("Apologies as we have encountered an error.")
                    })
                } else {
                    axios.put('/api/task/' + self.task.id, params)
                    .then(function (resp) {
                        self.getData((data) => {})
                        $('#modal-task-add-update').modal('hide')
                    })
                    .catch(function (err) {
                        console.log(err)
                        console.log("Apologies as we have encountered an error.")
                    })
                }
            },
            closeModal(){
                //close all modals
                $('#modal-task-add-update').modal('hide')
            },
            addTaskModal(){
                var self = this

                self.modal_title = "Add Task"
                self.modal_submit = "Submit"
                self.update_counter = 0
                self.task.id = 0
                self.task.title = ""

                
                //show add modal
                $('#modal-task-add-update').modal({backdrop: 'static', keyboard: false}) 
                $('#modal-task-add-update').modal('show')
            },
            updateTaskModal(id, title){
                var self = this

                self.task.id = id
                self.task.title = title

                self.modal_title = "Update Task"
                self.modal_submit = "Update"
                self.update_counter = 1
                
                //show add modal
                $('#modal-task-add-update').modal({backdrop: 'static', keyboard: false}) 
                $('#modal-task-add-update').modal('show')
            },
            deleteTask(id){
                var self = this
                
                var result = confirm("Are you sure you want to delete this task?");
                if (result) {
                    axios.delete('/api/task/' + id)

                    .then(function (resp) {
                        self.getData((data) => {
                            console.log("Successfully Deleted.")
                        })
                    })
                    .catch(function (err) {
                        console.log(err)
                        console.log("Apologies as we have encountered an error.")
                    })
                }
            }
        }
    }
</script>
