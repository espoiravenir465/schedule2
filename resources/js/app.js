import './bootstrap'
import Vue from 'vue'
// ルーティングの定義をインポートする
import router from './router'
import store from './store' 
// ルートコンポーネントをインポートする
import App from './App.vue'
import BodyClass from 'vue-body-class'

const createApp = async () => {
  await store.dispatch('auth/currentUser')

Vue.use(BodyClass, router)

new Vue({
  el: '#app',
  router,
  store,
  components: { App }, 
  template:'<App />'
})
}

createApp()