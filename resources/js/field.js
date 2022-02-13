Nova.booting((Vue) => {
    Vue.component("IndexSelectAutoComplete", () => import(/* webpackChunkName: "index-select-auto-complete" */ "./components/Index"))
    Vue.component("DetailSelectAutoComplete", () => import(/* webpackChunkName: "detail-select-auto-complete" */ "./components/Detail"))
    Vue.component("FormSelectAutoComplete", () => import(/* webpackChunkName: "form-select-auto-complete" */ "./components/Form"))
})
