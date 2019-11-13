<template>
    <div class="event-form">

    <div class="col-sm-6　center-block">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h3>イベント追加</h3>
            </div>
　 <div class="panel-body">
　   <form class="form" @submit.prevent="createEvent">
  　 <div class="form-group">
      <span>イベント名</span> <input type="string" class="form-control" placeholder="Event Name" v-model="event.title">
     </div>
    <div class="form-group">
     <span>日付</span> <input type="date"  class="form-control" placeholder="Date" v-model="event.date">
    </div>
    <div class="form-group">
     <span>開始時間</span> <input type="time" class="form-control" placeholder="Time" v-model="event.start">
    </div>
    <div class="form-group">
     <span>終了時間</span> <input type="time" class="form-control" placeholder="Time" v-model="event.end">
    </div>
    <div class="form-group">
     <span>イベント内容</span> <input type="text" class="form-control" placeholder="comment" v-model="comment">
    </div>
    <div class="btn-submit">
    <button class="btn btn-primary" type="submit">追加</button>
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
     
      data(){
      return {
        event:{title:"",date:"",start:"",end:""},
        comment:""
      }
      }
  }
  
</script> 