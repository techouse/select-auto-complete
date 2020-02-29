<template>
    <default-field :ref="refName" :field="field" :errors="errors">
        <template slot="field">
            <vue-single-select :id="field.attribute"
                               v-model="item"
                               :options="field.options"
                               :class="errorClasses"
                               :placeholder="placeholder"
                               :required="field.required"
                               :max-results="field.maxResults"
                               :max-height="field.maxHeight"
                               :get-option-description="getOptionDescription"
                               :option-key="optionKey"
                               :option-label="optionLabel"
                               class="select-auto-complete w-full form-control form-select"
            />
        </template>
    </default-field>
</template>

<script>
    import VueSingleSelect                        from "vue-single-select"
    import { FormField, HandlesValidationErrors } from "laravel-nova"

    export default {
        components: {
            VueSingleSelect,
        },

        mixins: [
            HandlesValidationErrors,
            FormField,
        ],

        data() {
            return {
                refName: "select_auto_complete",
                item: null,
                optionKey: "value",
                optionLabel: "label",
            }
        },

        computed: {
            placeholder() {
                return this.field.placeholder || this.__("Choose an option")
            },
        },

        watch: {
            item(current, previous) {
                if (current !== previous) {
                    this.$set(this, "value", current !== null && "value" in current ? current.value : "")
                }
            },
        },

        created() {
            if (this.field.value) {
                this.$set(this, "item", this.field.options.find((el) => String(el.value) === String(this.field.value)))
                this.$set(this, "value", this.field.value)
            } else if (this.field.default) {
                this.$set(this, "item", this.field.options.find((el) => String(el.value) === String(this.field.default)))
                this.$set(this, "value", this.field.defaultValue)
            }
        },

        mounted() {
            this.removeOverflowHiddenFromContainer()
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
                /**
                 * The sequence is important!
                 */
                ["form", ".modal", ".card"].forEach((className) => {
                    const container = this.$refs[this.refName].$el.closest(className)
                    if (container) {
                        if (container.classList.contains("overflow-hidden")) {
                            container.classList.remove("overflow-hidden")
                        }
                        if (container.classList.contains("overflow-x-hidden")) {
                            container.classList.remove("overflow-x-hidden")
                        }
                        if (container.classList.contains("overflow-y-hidden")) {
                            container.classList.remove("overflow-y-hidden")
                        }
                    }
                })
            },

            getOptionDescription(option) {
                if (this.field.displayUsingLabels) {
                    if (this.optionLabel) {
                        return option[this.optionLabel]
                    }
                }
                if (this.optionKey && this.optionLabel) {
                    return `${option[this.optionKey]} ${option[this.optionLabel]}`
                }
                if (this.optionLabel) {
                    return option[this.optionLabel]
                }
                if (this.optionKey) {
                    return option[this.optionKey]
                }
                return option
            },
        },
    }
</script>
