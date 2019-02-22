<template>
    <div>
        <b-form-group
            :id="id"
            :label="label"
            :label-for="label_for"
            :description="description"
            >
            <b-form-input
                :id="id"
                :type="form_type"
                v-model="inputValue"
                required
                ></b-form-input>
        </b-form-group>

    </div>
</template>
<script>
    export default {
        props: {
            id: String,
            label: String,
            label_for: String,
            description: String,
            form_type: String,
            value: String,
        },
        data() {
            return {
                // this is done to mimic the v-model effect
                // just a set value, theen an input watch.
                inputValue: this.value,
            }
        },
        watch: {
          inputValue(value) {
            this.$emit('input', value);
          }
        }
    }
</script>
