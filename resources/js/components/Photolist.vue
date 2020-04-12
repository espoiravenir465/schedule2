<template>
  <div class="photo-list">
  <h1>PhotoList</h1>
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="(photo,index) in photos"
        v-bind:key="index"
        :item="photo"
    />
    </div>
  </div>
</template>

<script>
import { OK } from '../util'
import Photo from '../components/Photo.vue'

export default {
components: {
    Photo
  },
  props: {
    page: {
      type: Number,
      required: false,
      default: 1
    }
  },
  data () {
    return {
      photos: []
    }
  },
  methods: {
    async fetchPhotos () {
      const response = await axios.get('/api/photos?event_id=' + this.$route.params.event_id)
      this.photos = response.data
    }
  },
  watch: {
    $route: {
      async handler () {
        await this.fetchPhotos()
      },
      immediate: true
    }
  }
}
</script>
