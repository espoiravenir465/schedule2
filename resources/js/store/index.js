import Vue from 'vue'
import Vuex from 'vuex'

import auth from './auth'
import error from './error'
import schedule from './schedule'

Vue.use(Vuex)

const store = new Vuex.Store({
  modules: {
    auth,
    error,
    schedule,
  }
})

export default store