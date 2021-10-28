// =========================================================
// * Vuetify Material Dashboard - v2.1.0
// =========================================================
//
// * Product Page: https://www.creative-tim.com/product/vuetify-material-dashboard
// * Copyright 2019 Creative Tim (https://www.creative-tim.com)
//
// * Coded by Creative Tim
//
// =========================================================
//
// * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

import Vue from 'vue'
import store from './store'
import './plugins/base'
import vuetify from './plugins/vuetify'
import i18n from './i18n'
import { createInertiaApp } from '@inertiajs/inertia-vue'

Vue.config.productionTip = false

const el = document.getElementById('app')
createInertiaApp({
  resolve: name => import(`@admin/views/${name}`).then(module => module.default),
  setup({ el, App, props }) {
    new Vue({
      store,
      vuetify,
      i18n,
      render: h => h(App, props),
    }).$mount(el)
  },
})