<template>
    <selected-panel-item :field="field" />
</template>

<script>
import SelectedPanelItem from "../SelectedPanelItem"

export default {

    components: {
        SelectedPanelItem
    },
    props: ["resource", "resourceName", "resourceId", "field"]
}
</script>
