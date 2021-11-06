<template>
  <v-container fluid>
    <v-row>
      <v-col :cols="12">
        <base-material-card
            color="primary"
            class="px-2 py-3 px-sm-5"
        >
          <template v-slot:heading>
            <div class="display-2 font-weight-light text-uppercase">
              Content
            </div>
          </template>
          <v-card-text>
            <v-img :aspect-ratio="25/9" v-if="file.type === 'image'" :src="file.url"/>
            <iframe v-else class="w-full h-full iframe" :src="file.url"/>
          </v-card-text>
        </base-material-card>
      </v-col>
      <v-col :md="7">
        <base-material-card
            color="primary"
            class="px-2 py-3 px-sm-5"
        >
          <template v-slot:heading>
            <div class="font-weight-light text-uppercase">
              {{ file.original_name }}
            </div>
          </template>
          <v-card-text class="px-1 px-sm-4">

            <v-simple-table>
              <template v-slot:default>
                <thead>
                <tr>
                  <th class="text-left">
                    Name
                  </th>
                  <th class="text-left">
                    Value
                  </th>
                </tr>
                </thead>
                <tbody>
                <tr
                    v-for="item in Object.keys(file).map((key) => [key, file[key]])"
                    :key="item[0]"
                >
                  <td>{{ item[0] }}</td>
                  <td v-if="item[0] === 'size'">{{ fileSize(item[1]) }}</td>
                  <td v-else-if="item[1] === null || item[1] === ''">NULL</td>
                  <td v-else-if="item[0] === 'created_at' || item[0] === 'updated_at'">{{ dateFormat(item[1]) }}</td>
                  <td v-else-if="item[0] === 'url'"><a :href="item[1]" target="_blank">{{ item[1] }}</a></td>
                  <td v-else>{{ item[1] }}</td>
                </tr>
                </tbody>
              </template>
            </v-simple-table>

          </v-card-text>
        </base-material-card>
      </v-col>
      <v-col :md="5">
        <base-material-card
            color="primary"
            class="px-2 py-3 px-sm-5"
        >
          <template v-slot:heading>
            <div class="font-weight-light text-uppercase">
              Edit
            </div>
          </template>
          <v-card-text class="px-1 px-sm-4">
            <v-file-input label="file" show-size/>
            <v-text-field label="title"/>
            <v-text-field label="source"/>
          </v-card-text>
        </base-material-card>
      </v-col>
    </v-row>

  </v-container>
</template>

<script>
import Layout from '@admin/layout/Base'
import {humanFileSize} from '@admin/helpers/file.js'
import {dateFormat as dateFormatHelper} from '@admin/helpers/data.js'

export default {
  layout: [Layout],
  name: "Edit",
  props: {
    file: Object,
  },
  created() {
    console.log(this.$props)
  },
  methods: {
    fileSize(size) {
      return humanFileSize(size)
    },
    dateFormat(value) {
      return dateFormatHelper(value);
    },
  }
}
</script>

<style lang="sass" scoped>
.iframe
  min-height: 500px

</style>