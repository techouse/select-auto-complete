<template>
    <selected-panel-item :field="field" />
</template>

<script>
import SelectedPanelItem from '../SelectedPanelItem'

export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    components: {
        SelectedPanelItem
    }
}
</script>
