<template>
  <div>
    <v-file-input @change="fileChange" show-size/>
    <v-text-field label="Name" v-model="title"/>
    <div v-if="type === 'image'">
      <v-img :src="url" max-width="300">
        <base-drag-element  class="border w-full" :style="{paddingBottom: (1 / (16/9)) * 100 + '%'}">
            <div >
            </div>
        </base-drag-element>
      </v-img>
    </div>
    <v-btn @click="sendFile">Add</v-btn>
  </div>
</template>

<script>
export default {
  name: "AddFile",
  data: () => ({
    file: '',
    url: '',
    title: '',
    type: '',
  }),
  methods: {

    fileChange(file) {
      this.file = file;
      this.url = URL.createObjectURL(file);
      console.log(file.type)
      if(file.type.includes('image')){
        this.type = 'image'
      }
      else {
        this.type = 'file'
      }
    },
    sendFile(){
      const data = new FormData();
      data.append('file', this.file);
      data.append('title', this.title);
      axios.post(route('admin.file.store'), data)
    }
  }
}
</script>

<style lang="sass" scoped>
.border
  border: #000000 dashed 3px

.w-full
  width: 100%
</style>