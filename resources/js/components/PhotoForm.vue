<template>
<div class="photo-form">
<div class="card" style="width: 20rem;">
    <div class="card-body">
    <form class="form" method="post" enctype="multipart/form-data" @submit.prevent="submit">
        <h4 class="card-title">写真を選んでください。</h4>
        <input type="file" accept="image/*" @change="onFileChange($event)">
        <img :src="imageData" v-if="imageData">
        <button class="btn btn-danger" v-if="imageData" @click="reset">リセットする</button>
        <div class="btn-submit">
        <button class="btn btn-success" type="submit">保存</button>
        </div>
        </form>
    </div>
</div>
</div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
data () {
  return {
     imageData: '',
     filename: ''
  }
},
methods: {
  onFileChange(e) {
    const files = e.target.files;
    if(files.length > 0) {
      const file = files[0];
      const reader = new FileReader();
      reader.onload = (e) => {
      this.imageData = e.target.result;
      this.filename = files[0].name;
       };
       reader.readAsDataURL(file);
     }
  },
  reset() {
    //const input = this.$refs.file;
    //input.type = 'text';
    //input.type = 'file';
    this.imageData = '';
    this.filename = '';
  },
  async submit () {
    console.log(this.filename)
    const formData = new FormData()
    formData.append('imageData', this.imageData)
    formData.append('extension', getExt(this.filename))
    formData.append('eventId', this.$route.params.event_id)
    const response = await axios.post('/api/photos/' + this.$route.params.event_id, formData)
    //this.reset()
    //this.$emit('input', false)
  },
  async fetchPhotos () {
    const response = await axios.get('/api/photos?event_id=' + this.$route.params.event_id)
    //this.imageData = response.data
    const file = response.data;

    this.imageData = file;
    this.filename = 'test.jpeg';
  },

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
  function getExt(filename)
    {
    var pos = filename.lastIndexOf('.');
    if (pos === -1) return '';
    return filename.slice(pos + 1);
}
</script>
