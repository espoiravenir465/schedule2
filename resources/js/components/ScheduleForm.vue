<template>
    <div class="schedule-form">

    <div class="col-sm-6">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h3>スケジュール追加</h3>
            </div>
　 <div class="panel-body">
　   <form class="form" @submit.prevent="createSchedule">
  　 <div class="form-group">
      <span>スケジュール名</span> <input type="string" class="form-control" placeholder="Schedule Name" v-model="schedule.title">
     </div>
    <div class="form-group">
     <span>出発日</span> <input type="date" class="form-control" placeholder="Date" v-model="schedule.go_date">
    </div>
    <div class="form-group">
     <span>帰着日</span> <input type="date" class="form-control" placeholder="Date" v-model="schedule.return_date">
    </div>
    <button class="btn btn-primary" v-on:click="createSchedule">追加</button>
    </form>
  </div>
 </div>
</div>
</div>
    
</template>

<script>
    export default {
        data(){
      return {
        schedule:{title:"",go_date:"",return_date:""},
      }
      },
      methods:{
            async createSchedule () {
            const formData = new FormData()
            formData.append('title', this.title),('go_date',this.go_date),('return_date',this.return_date)
            const response = await axios.post('/api/schedule', formData)

           
           
           this.$router.push('/schedule')
         }
        }
    }
    
</script>