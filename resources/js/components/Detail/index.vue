<template>
    <selected-panel-item :field="field" />
</template>

<script>
    import SelectedPanelItem from "../SelectedPanelItem"

    export default {

        components: {
            SelectedPanelItem,
        },
        // eslint-disable-next-line vue/require-prop-types
        props: ["resource", "resourceName", "resourceId", "field"],
    }
</script>
