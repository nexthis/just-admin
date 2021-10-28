<template>
  <v-app>
    <dashboard-core-app-bar />

    <dashboard-core-drawer />

    <dashboard-core-view >
      <slot/>
    </dashboard-core-view>


  </v-app>
</template>

<script>
import DashboardCoreAppBar from './core/AppBar'
import DashboardCoreDrawer from './core/Drawer'
import DashboardCoreView from './core/View'

export default {
  name: 'DashboardLayout',
  components: {
    DashboardCoreAppBar,
    DashboardCoreDrawer,
    DashboardCoreView,
  },
  data: () => ({
    expandOnHover: false,
  }),
}
</script>