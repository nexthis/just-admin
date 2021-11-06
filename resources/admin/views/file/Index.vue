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
          <v-card :to="editLink(item.id)">
            <v-img :aspect-ratio="16/9" v-if="item.type === 'image'" :src="item.url"/>
            <v-responsive :aspect-ratio="16/9" v-if="item.type !== 'image'">
              <div class="d-flex justify-center h-full">
                <v-icon class="text-h2" x-large>
                  mdi-file
                </v-icon>
              </div>
            </v-responsive>
            <v-card-text>
              <div>{{ item.name }}</div>
              <div class="d-flex justify-space-between mt-2">
                <div class="text-uppercase">{{ item.extension }}</div>
                <div>{{ fileSize(item.size) }}</div>
              </div>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </div>

  </v-container>
</template>

<script>
import Layout from '@admin/layout/Base'
import FileAdd from '@admin/components/file/FileAdd'
import {humanFileSize} from '@admin/helpers/file.js'

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
  },
  methods: {
    fileSize(size) {
      return humanFileSize(size)
    },
    editLink(id){
      return route('admin.file.edit', id)
    }
  }
}
</script>

<style scoped>

</style>