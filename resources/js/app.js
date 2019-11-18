import './bootstrap'
import Vue from 'vue'
import BootstrapVue from 'bootstrap-vue'
// ルーティングの定義をインポートする
import router from './router'
import store from './store' 
// ルートコンポーネントをインポートする
import App from './App.vue'
import BodyClass from 'vue-body-class'

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import VCalendar from 'v-calendar';
Vue.use(VCalendar);
 


const createApp = async () => {
  await store.dispatch('auth/currentUser')

Vue.use(BodyClass, router)
Vue.use(BootstrapVue)

new Vue({
  el: '#app',
  router,
  store,
  components: { App }, 
  template:'<App />'
})
}

createApp()
