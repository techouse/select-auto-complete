<template>
    <default-field :ref="refName" :field="field" :errors="errors">
        <template slot="field">
            <vue-single-select v-model="item"
                               :id="field.attribute"
                               :options="field.options"
                               :class="errorClasses"
                               :placeholder="__('Choose an option')"
                               class="select-auto-complete w-full form-control form-select"
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
                refName: 'select_auto_complete',
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
            },

            /**
             * Laravel Nova adds a nasty overflow-hidden class to multiple containers
             * which renders this extension pretty much useless therefore the class
             * must be removed from the container of this select field.
             */
            removeOverflowHiddenFromContainer() {
                const classes = [
                    /**
                     * The sequence is important!
                     */
                    'form',
                    '.modal',
                    '.card'
                ]

                for (let class_ of classes) {
                    const container = this.$refs[this.refName].$el.closest(class_)
                    if (container) {
                        if (container.classList.contains('overflow-hidden')) {
                            container.classList.remove('overflow-hidden')
                        }
                        if (container.classList.contains('overflow-x-hidden')) {
                            container.classList.remove('overflow-x-hidden')
                        }
                        if (container.classList.contains('overflow-y-hidden')) {
                            container.classList.remove('overflow-y-hidden')
                        }
                    }
                }
            }
        },

        mounted() {
            this.removeOverflowHiddenFromContainer()
        }
    }
</script>