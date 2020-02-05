<template>
<div class="container">
<div class="event-detail">
<div class="card mb-3">
<div class="card">
<h5 class="card-header">イベント日付</h5>
  <div class="card-body">
    <h5 class="card-title">イベントタイトル</h5>
    <p class="card-text">イベント開始時間〜イベント終了時間</p>
  </div>
</div>
</div>
<PhotoForm  />
<Photolist />
<CommentForm />
<table class="table bordered break-all">
  <thead  class="thead-dark">
    <tr>
      <th>Comments</th>
      <th>削除</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="(comment,id) in comments" :key="comment_id">
      <td align = "center" valign ="middle">
        <div v-if="!commnet_edit" v-text="comment.comment" v-on:click="$set(comment, 'comment_edit', true)"></div>
        <input v-if="comment_edit" type="text" v-model="comment.comment" v-on:blur="$set(comment, 'comment', false)" >
      </td>
      <td align = "center" valign ="middle" ><button class="btn btn-danger"  v-on:click="deleteComment(comment.id)">削除</button></td>
      </tr>
    </tbody>
  </table>
  <div class="save-button">
    <button class="btn btn-success" v-on:click="editComment(comments)">保存</button>
  </div>
</div>
</div>
</template>
<script>
import PhotoForm from '../components/PhotoForm.vue'
import Photolist from '../components/Photolist.vue'
import CommentForm from '../components/CommentForm.vue'
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
components: {
 PhotoForm,
 Photolist,
 CommentForm
 },
 data () {
  return {
      events: [],
      comments:[],
      comment_id:0,
      }
},

methods:{
    async fetchEventdetail (){
      console.log('testfetch')
      const response = await axios.get('/api/'+ this.$route.params.id +'/events?id=' + this.$route.params.id)
      this.event= response.data.data
      console.log(response)
    },
    async fetchComments (){
      console.log('testfetchcomments')
      const response = await axios.get('/api/'+ this.$route.params.id +'/events?id=' + this.$route.params.id)
      this.comments = response.data.data
      console.log(response)
    },
}
}


</script>
