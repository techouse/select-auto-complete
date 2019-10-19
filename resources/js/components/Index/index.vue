<template>
    <div v-if="field.asHtml" v-html="selectedValue" />
    <span v-else class="whitespace-no-wrap">{{ selectedValue }}</span>
</template>

<script>
    export default {
        // eslint-disable-next-line vue/require-prop-types
        props: ["resourceName", "field"],

        computed: {
            selectedValue() {
                if (typeof this.field.displayUsingLabels !== "undefined" && this.field.displayUsingLabels === true) {
                    const option = this.field.options.find((el) => Number(el.value) === Number(this.field.value))
                    if (option) {
                        return String(option.label)
                    }
                    return ""
                }

                return String(this.field.value)
            },
        },
    }
</script>
