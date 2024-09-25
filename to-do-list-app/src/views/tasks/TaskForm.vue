<script>
import InputComponent from '@/components/InputComponent.vue';

export default {
    name: 'TaskForm',
    props: ['task'],
    data() {
        return {
            error: null
        }
    },
    components: {
        InputComponent
    },
    methods: {
        submitForm(task) {
            this.error = null

            if(!task.title) {
                this.error = 'Title is required'
            }

            if(!this.error && task.id) {
                this.$emit('update', task)
            }

            if(!this.error && !task.id) {
                this.$emit('save', task)
            }
        }
    },
    emits: {
        update: (task) => {
            return true
        },
        cancel: () => {
            return true
        },
        remove: (task) => {
            return true
        },
        save: (task) => {
            return true
        },
    }
}
</script>

<template>
    <div class="row mt-5">
        <div class="col-12 text-center mb-2">
            <h1><span v-if="task.id">Edit</span><span v-else>Create</span> task</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-6 mb-2 offset-md-3">
            <form @submit.prevent>
                <p class="text-danger" v-if="error">{{ error }}</p>
                <InputComponent
                    class="form-control"
                    label="Title"
                    id="title"
                    inputData="title"
                    type="text"
                    v-model="task.title"
                />

                <div class="form-check">
                    <InputComponent
                        class="form-check-input"
                        label="Completed"
                        id="completed"
                        inputData="completed"
                        type="radio"
                        modelValue=1
                        v-model="task.completed"
                        :checked="task.completed"
                    />
                </div>

                <div class="form-check">
                    <InputComponent
                        class="form-check-input"
                        label="Pending"
                        id="pending"
                        inputData="completed"
                        type="radio"
                        modelValue=0
                        v-model="task.completed"
                        :checked="!task.completed"
                    />
                </div>

                <button class="btn btn-primary" type="button" v-on:click="submitForm(task)"><span v-if="task.id">Update</span><span v-else>Create</span></button>
                <button class="btn btn-danger ms-2" type="button" v-on:click="$emit('remove', task)" v-if="task.id">Delete</button>
                <button class="btn btn-secondary ms-2" type="button" v-on:click="$emit('cancel')">Cancel</button>
            </form>
        </div>
    </div>
</template>