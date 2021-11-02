<template>
  <v-container fluid>
    <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
    >
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="primary" v-bind="attrs" v-on="on">Add File</v-btn>
      </template>

      <v-card>
        <v-toolbar
            dark
            color="primary"
        >
          <v-btn
              icon
              dark
              @click="dialog = false"
          >
            <v-icon>mdi-close</v-icon>
          </v-btn>
          <v-toolbar-title>Add File</v-toolbar-title>
        </v-toolbar>

        <FileAdd/>
      </v-card>

    </v-dialog>

    <div>
      <v-row>
        <v-col v-for="item in data" :cols="12" :lg="2" :md="4" :sm="6">
          <v-card>
            <v-img :aspect-ratio="16/9" v-if="item.type === 'image'" :src="item.url"/>
            <div>
              <div>{{ item.original_name }}</div>
              <div>{{ item.size }}</div>
            </div>
          </v-card>
        </v-col>
      </v-row>
    </div>

  </v-container>
</template>

<script>
import Layout from '@admin/layout/Base'
import FileAdd from '@admin/components/file/FileAdd'

export default {
  layout: [Layout],
  name: "Index",
  props: {
    data: Array,
  },
  data: () => ({
    dialog: false
  }),
  components: {
    FileAdd
  },
  created() {
    console.log(this.data)
  }
}
</script>

<style scoped>

</style>