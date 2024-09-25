<script>
import axios from 'axios'
import TaskForm from './TaskForm.vue';

export default {
    name: 'TaskList',
    data() {
        return {
            tasks: [],
            task: null,
            editOrCreate: false,
            title: '',
            completed: ''
        }
    },
    mounted() {
        this.getAllTasks()
    },
    methods: {
        formatDate(date) {
            const dateObj = new Date(date)
            return dateObj.toLocaleDateString()
        },
        getAllTasks() {
            axios
            .get('http://localhost:8000/api/tasks')
            .then(response => {
                this.tasks = response.data.tasks
            })
            .catch(error => {
                console.log(error)
            })
        },
        openTaskForm() {
            this.task = {
                id: null,
                title: null,
                completed: 0
            },
            this.editOrCreate = true
        },
        storeTask(task) {
            axios
            .post('http://localhost:8000/api/tasks', task)
            .then(response => {
                this.getAllTasks()
                this.task = null
                this.editOrCreate = false
            })
            .catch(error => {
                console.log(error)
            })
        },
        editTask(task) {
            this.task = task
            this.editOrCreate = true
        },
        updateTask(task) {
            axios
            .put('http://localhost:8000/api/tasks/' + task.id, task)
            .then(response => {
                this.getAllTasks()
                this.task = null
                this.editOrCreate = false
            })
            .catch(error => {
                console.log(error)
            })
            return true
        },
        removeTask(task) {
            axios
            .delete('http://localhost:8000/api/tasks/' + task.id)
            .then(response => {
                this.getAllTasks()
                this.task = null
                this.editOrCreate = false
            })
            .catch(error => {
                console.log(error)
            })
            return true
        },
        cancel() {
            this.task = null
            this.editOrCreate = false
            this.getAllTasks()
            return true
        }
    },
    components: {
        TaskForm
    }
}
</script>

<template>
    <div class="container">
    <div class="row mt-5" v-if="!editOrCreate">
        <div class="col-12 text-center mb-2">
            <h1>Task listing</h1>
            <button class="btn btn-primary btn-sm" v-on:click="openTaskForm()">Create task</button>
        </div>
        <div class="col-12 text-center mt-5" v-if="tasks.length === 0"><h3>There is no tasks here yet...</h3></div>
        <div class="col-6 mb-2 offset-md-3" v-for="task in tasks">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <h5 class="card-title">Title: {{ task.title }}</h5>
                        <div class="col-4">
                            <p class="card-text">ID: {{ task.id }}</p>
                        </div>
                        <div class="col-4 text-end">
                            <p class="card-text">Created: {{ formatDate(task.created_at) }}</p>
                        </div>
                        <div class="col-4 text-end">
                        <span class="badge text-bg-success" v-if="task.completed">completed</span>
                        <span class="badge text-bg-danger" v-else>pending</span>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-sm" v-on:click="editTask(task)">Edit task</button>
                </div>
            </div>
        </div>
    </div>
    <TaskForm :task="task" v-if="editOrCreate" @cancel="cancel()" @update="updateTask(task)" @remove="removeTask(task)" @save="storeTask(task)"/>
    </div>
</template>
