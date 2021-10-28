<template>
  <v-main>
    <slot/>
  </v-main>
</template>

<script>
export default {
  name: 'DashboardCoreView',
  components: {
    DashboardCoreFooter: () => import('./Footer'),
  },
}
</script>