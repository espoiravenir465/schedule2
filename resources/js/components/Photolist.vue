<template>
  <div class="photo-list">
  <h1>PhotoList</h1>
    <div class="grid">
      <Photo
        class="grid__item"
        v-for="photo in photos"
        :key="photo.id"
        :item="photo"
      />
    </div>
  </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'


export default {
  data () {
    return {
      photos: []
    }
  }
}
</script>
