<template>
  <v-container fluid>
    <base-material-card
        color="primary"
        class="px-2 py-3 px-sm-5"
    >
      <template v-slot:heading>
        <div class="display-2 font-weight-light text-uppercase">
          {{ $t('drawer.user') }}
        </div>
      </template>
      <v-card-text class="px-1 px-sm-4">
        <base-crud-view :headers="headers" :data="data">

          <template v-slot:item.image="{ item:{image} }">
            <v-img style="cursor: pointer;" :src="image.url" aspect-ratio="1"
                   min-width="50" min-height="50"/>
          </template>

          <template v-slot:item.status="{ item:{status} }">
            <v-chip dark :color="getColor(status)">{{ status }}</v-chip>
          </template>

        </base-crud-view>
      </v-card-text>
    </base-material-card>
  </v-container>
</template>

<script>
import Layout from '@admin/layout/Base'
export default {
  layout: [Layout],
  name: "Index",
  props: {
    data: Object,
  },
  data: () => ({
    headers:[
      { text: 'Index', value: 'id' },
      { text: 'Title', value: 'title' },
      { text: 'Image', value: 'image' },
      { text: 'Status', value: 'status' },
      { text: 'Update', value: 'updated_at' },
      { text: 'Created', value: 'created_at' },
      { text: 'Actions', value: 'actions', sortable: false },
    ],
  }),
  created() {
    console.log(this.data)
  },
  methods:{
    getColor (status) {
      if (status === 'active') return 'green'
      else if (status === 'enable') return 'orange'
      else return 'red'
    },
  }
}
</script>

<style scoped>

</style>