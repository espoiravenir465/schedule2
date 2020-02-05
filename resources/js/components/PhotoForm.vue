<template>
<div class="photo-form">
<div class="card" style="width: 20rem;">
    <div class="card-body">
        <h4 class="card-title">写真を選んでください。</h4>
        <input type="file" accept="image/*" @change="onFileChange($event)">
        <img :src="imageData" v-if="imageData">
        <button class="btn btn-danger" v-if="imageData" @click="resetFile">リセットする</button>
    </div>
</div>
</div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
data () {
  return {
    imageData: ''
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

    };
    reader.readAsDataURL(file);

   }

  },
        resetFile() {

                    const input = this.$refs.file;
                    input.type = 'text';
                    input.type = 'file';
                    this.imageData = '';

                }
        }
    }



</script>
