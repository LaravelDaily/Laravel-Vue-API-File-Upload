import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import axios from 'axios'

Vue.config.productionTip = false

axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
axios.defaults.baseURL = '' //Backend url like - http://my-test-app.local/

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
