<template>
<div class="comment-form">
    <div class="card mb-3">
      <div class="card">
        <h5 class="card-header">コメント入力</h5>
        <div class="card-body">
          <form class="form" @submit.prevent="createComment">
            <input class="form-control form-control-lg col-sm-10" type="text" placeholder="コメント入力"　v-model="comment">
            <div class="btn-submit">
              <button class="btn btn-success" type="submit">保存</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
       data () {
        return {
           comment: ''
        }
        },
        methods:{
              reload() {
              this.$router.go({path: this.$router.currentRoute.path, force: true});
          },
              async createComment () {
              console.log('createComment')
              const formData = new FormData()
              formData.append('event_id', this.$route.params.event_id)
              formData.append('comment', this.comment)
              const response = await axios.post('/api/'+this.$route.params.event_id+'/comments', formData)
              this.reload();
           },
  }
  }


</script>
