import Vue from 'vue'
import RouteLink from "@admin/components/base/RouterLink";
import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

const requireComponent = require.context(
  '@admin/components/base', true, /\.vue$/,
)

requireComponent.keys().forEach(fileName => {
  const componentConfig = requireComponent(fileName)

  const componentName = upperFirst(
    camelCase(fileName.replace(/^\.\//, '').replace(/\.\w+$/, '')),
  )

  Vue.component(`Base${componentName}`, componentConfig.default || componentConfig)
})


Vue.component( 'router-link', RouteLink)