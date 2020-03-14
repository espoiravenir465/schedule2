<template>
<div class="container">
<div class="event-detail">
<div class="card mb-3">
<div class="card">
<h5 class="card-header">{{event.event_date}}</h5>
  <div class="card-body">
  <h5 class="card-title">{{event.event_title}}</h5>
  <p class="card-text" v-if="event.event_start && event.event_start">{{event.event_start.slice(0,5)}}〜{{event.event_end.slice(0,5)}}</p>
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
    <tr v-for="(comment,comment_id) in comments" :key="comment_id">
        <td align = "center" valign ="middle">
          <div v-if="!comment.comment_edit" v-text="comment.comment" v-on:click="$set(comment, 'comment_edit', true)"></div>
          <input v-if="comment.comment_edit" type="text" v-model="comment.comment" v-on:blur="$set(comment, 'comment_edit', false)" >
        </td>
        <td align = "center" valign ="middle" ><button class="btn btn-danger"  v-on:click="deleteComment(comment.comment_id)">削除</button></td>
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
      event_id: 0,
      event: [],
      comments:[],
      comment_id:0,
      }
},

methods:{
    async fetchEvent (){
      console.log('fetchevent')
      console.log(this.$route.params)
      const response = await axios.get('/api/event/'+ this.$route.params.id + '/'+ this.$route.params.event_id+'?id=' + this.$route.params.event_id )
      this.event= response.data[0]
      console.log(this.event)
    },
    async fetchComments (){
      console.log('testfetchcomments')
      const response = await axios.get('/api/'+ this.$route.params.id +'/comments?id=' + this.$route.params.id)
      this.comments = response.data.data
      console.log('start')
      console.log(this.comments)
      console.log('end')
      console.log(response)
    },
    async deleteComment (comment_id){
      console.log('deleteComment')
      console.log(comment_id)
      const response = await axios.delete('/api/comment/'+ this.$route.params.id + '/'+ comment_id+'?event_id=' + this.$route.params.id + '/'+ comment_id )
      this.comments = response.data.data
    },
    async editComment (comments) {
      console.log("editComment")
      const reponse =await axios.patch('/api/comment/'+ this.$route.params.id , this.comments)
      this.reload();
    },
    reload() {
      console.log("reload")
      this.$router.go({path: this.$router.currentRoute.path, force: true});
    },
    edit: function() {
      this.$set = false
      this.$nextTick(function () { this.$refs.r1.focus() })
    },
  },
  watch: {
      $route: {
       async handler () {
       await this.fetchEvent(),
       await this.fetchComments()
        },
       immediate: true
        }
      }
}


</script>
