<script>
export default {
    name: 'InputComponent',

    props: {
        id: {
            type: String
        },

        label: {
            type: String,
        },

        modelValue: {
            type: [String, Number],
        },

        type: {
            type: String
        },

        placeholder: {
            type: String
        },

        inputData: {
            type: String
        },

        class: {
            type: String
        },

        checked: {
            type: [Boolean, Number, String]
        }
    }
}
</script>

<template>
    <div class="mb-3">
        <label class="form-label" :for="id">{{ label }}</label>
        <input
            :class="class"
            :id="id"
            :name="inputData"
            :type="type"
            :placeholder="placeholder"
            :value="modelValue"
            :checked="checked"
            @input="$emit('update:modelValue', $event.target.value)"
        >
    </div>
</template>