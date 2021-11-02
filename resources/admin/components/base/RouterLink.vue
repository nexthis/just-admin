<template>
  <Link :only="only" :headers="headers" :preserveState="preserveState" :href="to" :data="data" :method="method"
                :replace="replace" :preserveScroll="preserveScroll"  :class="currentUrl ? activeClass : null">
    <slot/>
  </Link>
</template>


<script>
import  urlHelper from '@admin/helpers/url'
import { Inertia } from '@inertiajs/inertia'
import { Link } from '@inertiajs/inertia-vue'
export default {
  name: "RouterLink",
  props: {
    data: {
      type: Object,
      default: () => ({}),
    },
    to: {
      type: String,
      required: true,
    },
    method: {
      type: String,
      default: 'get',
    },
    replace: {
      type: Boolean,
      default: false,
    },
    preserveScroll: {
      type: Boolean,
      default: false,
    },
    preserveState: {
      type: Boolean,
      default: false,
    },
    only: {
      type: Array,
      default: () => [],
    },
    headers: {
      type: Object,
      default: () => ({}),
    },
    activeClass:{
      type: String,
      default: '',
    },
  },
  data: () =>({
    currentUrl:  false,
  }),
  components:{
    Link
  },
  mounted() {
    this.currentUrl = urlHelper.isCurrentUrl(this.to);
    Inertia.on('finish', () => {
      this.currentUrl = urlHelper.isCurrentUrl(this.to);
    })
  }
}
</script>