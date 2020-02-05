<template>
<div class="comment-form">
<div class="card mb-3">
<div class="card">
<h5 class="card-header">コメント入力</h5>
  <div class="card-body">
<input class="form-control form-control-lg col-sm-10" type="text" placeholder="コメント入力"　v-model="comment">
<div class="btn-submit">
  <button class="btn btn-primary" type="submit">保存</button>
</div>
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
               const formData = new FormData()
               formData.append('comment', this.comment)
               const response = await axios.post('/api/{schedule_id}/{event_id}/comments', formData)
               this.$router.push('/{schedule_id}/{event_id}/comments')
               this.reload();
           },
  }
  }


</script>
