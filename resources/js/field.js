import Index from "./components/Index"
import Detail from "./components/Detail"
import Form from "./components/Form"

Nova.booting((Vue) => {
    Vue.component("index-select-auto-complete", Index)
    Vue.component("detail-select-auto-complete", Detail)
    Vue.component("form-select-auto-complete", Form)
})
