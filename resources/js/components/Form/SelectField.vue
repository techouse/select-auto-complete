<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <vue-single-select v-model="item"
                               :id="field.attribute"
                               :options="field.options"
                               :class="errorClasses"
                               :placeholder="__('Choose an option')"
                               class="select-auto-complete w-full form-control"
                               option-key="value"
                               option-label="label"/>
        </template>
    </default-field>
</template>

<script>
    import VueSingleSelect                      from 'vue-single-select'
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        components: {VueSingleSelect},

        mixins: [HandlesValidationErrors, FormField],

        data() {
            return {
                item: null
            }
        },

        watch: {
            item(current, previous) {
                if (current !== previous) {
                    this.$set(this, 'value', current !== null && 'value' in current ? current.value : '')
                }
            }
        },

        methods: {
            /**
             * Provide a function that fills a passed FormData object with the
             * field's internal value attribute. Here we are forcing there to be a
             * value sent to the server instead of the default behavior of
             * `this.value || ''` to avoid loose-comparison issues if the keys
             * are truthy or falsey
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value)
            }
        },
    }
</script>
