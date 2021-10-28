<template>
  <v-data-table :headers="headers"
                :items="data.data"
                :items-per-page="data.per_page"
                :server-items-length="data.total"
                :loading="loading"
                :footer-props="{'items-per-page-options': data.config.items_per_page_options}"
                multi-sort
                :options.sync="options">

    <template v-slot:top>
      <v-toolbar
          class="toolbar-crud"
          flat>
        <div class="toolbar-search">
          <v-select
              label="Model"
              class="select"
              :items="headers.filter(item => item.sortable !== false)"
              v-model="search.model"
          ></v-select>
          <v-select
              label="Operator"
              class="ml-2 select"
              :items="operators"
              v-model="search.operator"
          ></v-select>
          <v-text-field
              class="ml-2"
              v-model="search.text"
              append-icon="mdi-magnify"
              label="Query"
              single-line
              hide-details
              @keydown.enter="searchEvent"
              @click:append="searchEvent"
          ></v-text-field>
        </div>
        <v-spacer></v-spacer>

        <v-btn
            color="primary"
            dark
            class="mb-2 d-md-flex d-none"
            @click="createItem"
            v-if="actions.add"
        >
          New Item
        </v-btn>

        <portal to="app">
          <v-btn
              elevation="2"
              class="mb-2 d-md-none d-inline-flex"
              color="primary"
              @click="createItem"
              v-if="actions.add"
              fab
              fixed
              bottom
              dark
              right>
            <v-icon >mdi-plus</v-icon>
          </v-btn>
        </portal>


        <v-dialog v-model="dialogDelete" max-width="500px">
          <v-card>
            <v-card-title class="h3">Are you sure you want to delete this item?</v-card-title>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="closeDelete">Cancel</v-btn>
              <v-btn color="blue darken-1" text @click="deleteItemConfirm">OK</v-btn>
              <v-spacer></v-spacer>
            </v-card-actions>
          </v-card>
        </v-dialog>

      </v-toolbar>
    </template>

    <template v-for="(slot, name) in $scopedSlots" v-slot:[name]="item">
      <slot :name="name" v-bind="item"></slot>
    </template>

    <template v-slot:item.created_at="{ item:{created_at} }">
      {{ dateFormat(created_at) }}
    </template>
    <template v-slot:item.updated_at="{ item:{updated_at} }">
      {{ dateFormat(updated_at) }}
    </template>


    <template v-slot:item.actions="{ item }" v-if="actions.actions">
      <v-icon
          small
          class="mr-2"
          @click="showItem(item)"
          v-if="actions.view"
      >
        mdi-eye
      </v-icon>
      <v-icon
          small
          class="mr-2"
          @click="editItem(item)"
          v-if="actions.edit"
      >
        mdi-pencil
      </v-icon>
      <v-icon
          small
          @click="deleteItem(item)"
          v-if="actions.delete"
      >
        mdi-delete
      </v-icon>
    </template>

    <slot/>

  </v-data-table>
</template>

<script>
import {dateFormat} from '@admin/helpers/data'
import _ from 'lodash'

export default {
  name: "CrudView",

  props: {
    data: {
      type: Object,
      default: () => ({
        data: [],
        current_page: null,
        from: 1,
        last_page: 0,
        last_page_url: '',
        links: [],
        next_page_url: null,
        path: '',
        per_page: 15,
        prev_page_url: null,
        to: 0,
        total: 0,
        config: {
          items_per_page_options: [10, 20],
          items_max: 100,
          items_default: 20,
        }
      })
    },
    headers: {
      type: Array,
      default: () => [],
    },
    actions: {
      type: Object,
      default: () => ({
        edit: true,
        view: true,
        delete: true,
        add: true,
        actions: true,
      })
    },
    provaider: {
      type: String,
    },
    config: {
      type: Array,
    },
  },
  data: () => ({
    search: {
      model: '',
      operator: '=',
      text: '',
    },
    loading: false,
    options: {},
    baseName: '',
    dialogDelete: false,
    deleteItam: null,
    operators: ['=', '>', '>=', '<','<=','!=', 'like', 'regexp']
  }),
  created() {
    this.baseName = route().current().replace(/\.(?=[^.]*$)(.*)/, "")
    this.search.model = this.headers[0].value;
  },
  watch: {
    options: {
      handler(newVal, oldVal) {
        if (_.isEmpty(oldVal)) {
          return
        }
        this.getDataFromApi()
      },
      deep: true,
    },
  },
  methods: {
    dateFormat: (value) => dateFormat(value),
    searchEvent() {
      this.options = {...this.options, model: this.search.model, text: this.search.text, operator: this.search.operator}
    },
    createItem() {
      this.$inertia.visit(route(this.baseName + '.create'));
    },
    showItem(item) {
      this.$inertia.visit(route(this.baseName + '.show', item));
    },
    editItem(item) {
      this.$inertia.visit(route(this.baseName + '.edit', item));
    },
    deleteItem(item) {
      this.dialogDelete = true;
      this.deleteItam = item;
    },
    deleteItemConfirm() {
      this.$inertia.delete(route(this.baseName + '.destroy', this.deleteItam), null, {preserveState: true});
      this.closeDelete();
    },
    closeDelete() {
      this.dialogDelete = false;
      this.deleteItam = null;
    },
    getDataFromApi() {
      this.loading = true
      const params = {...this.options};
      params.text = encodeURI(params.text)
      this.$inertia.get( route(route().current()) ,  params, {
        onSuccess: () => {
          this.loading = false;
        },
        preserveState: true
      })


    },

  }
}
</script>

<style lang="sass">
.toolbar-crud
  .v-toolbar__content, &.v-toolbar__extension
    padding: 0px 15px 0 15px

  .toolbar-search
    display: flex

    .select
      max-width: 100px
</style>