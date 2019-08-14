Nova.booting((Vue, router) => {
    Vue.component("form-select-auto-complete", require("./components/Form/SelectField").default)
    Vue.component("detail-select-auto-complete", require("./components/Detail/TextField").default)
    Vue.component("index-select-auto-complete", require("./components/Index/TextField").default)
})
