import Vue from 'vue'
import VueRouter from 'vue-router'

// ページコンポーネントをインポートする
import Top from './pages/Top.vue'
import Login from './pages/Login.vue'
import SystemError from './pages/errors/System.vue'
import Schedule from './pages/Schedule.vue'
import Event from './pages/Event.vue'
import EventDetail from './pages/EventDetail.vue'

import store from './store'

// VueRouterプラグインを使用する
// これによって<RouterView />コンポーネントなどを使うことができる
Vue.use(VueRouter)

// パスとコンポーネントのマッピング
const routes = [
  {
    path: '/',
    meta: { bodyClass: 'page-top' },
    component: Top
  },
  {
    path: '/login',
    meta: { bodyClass: 'page-login' },
    component: Login,
    beforeEnter (to, from, next) {
      if (store.getters['auth/check']) {
        next('/')
      } else {
        next()
      }
    }
  },
  {
    path: '/schedule',
    meta: { bodyClass: 'page-schedule' },
    component: Schedule
  },
  {
    path: '/:id/events',
    meta: { bodyClass: 'page-event'},
    component:Event,
    props: true
  },
  {
    path: '/schedule_id/event/{event_id}',
    meta: { bodyClass: 'page-eventdetail'},
    component:EventDetail,
  },
  {
    path: '/500',
    component: SystemError
  }

]

// VueRouterインスタンスを作成する
const router = new VueRouter({
  mode:'history',
  routes
})

// VueRouterインスタンスをエクスポートする
// app.jsでインポートするため
export default router