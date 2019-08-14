<template>
    <div v-if="field.asHtml" v-html="selectedValue" />
    <span v-else class="whitespace-no-wrap">{{ selectedValue }}</span>
</template>

<script>
export default {
    props: ["resourceName", "field"],

    computed: {
        selectedValue() {
            if (typeof this.field["displayUsingLabels"] !== "undefined" && this.field["displayUsingLabels"] === true) {
                return String(this.field.options.find(el => el.value === this.field.value).label)
            }

            return String(this.field.value)
        }
    }
}
</script>
