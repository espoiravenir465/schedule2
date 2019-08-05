<template>
    <div class="schedule-form">

    <div class="col-sm-6　center-block">
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
     <span>出発日</span> <input type="date"  class="form-control" placeholder="Date" v-model="schedule.go_date">
    </div>
    <div class="form-group">
     <span>帰着日</span> <input type="date" class="form-control" placeholder="Date" v-model="schedule.return_date">
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
        schedule:{title:"",go_date:"",return_date:""},
      }
      },
      methods:{
            reload() {
            this.$router.go({path: this.$router.currentRoute.path, force: true});
        },
            async createSchedule () {
             const formData = new FormData()
             formData.append('title', this.schedule.title)
             formData.append('go_date',this.schedule.go_date)
             formData.append('return_date',this.schedule.return_date)
             const response = await axios.post('/api/schedule', formData)
             this.$router.push('/schedule')
             this.reload();
         },
         
            
         
            async editSchedule () {
             const reponse =await axios.patch('/api/schedule/' + schedule_id, {
                title: this.schedule.title,
                go_date: this.schedule.go_date,
                return_date:this.schedule.return_date
            })
            .then( (res) => {
                console.log('update')
            });                  
         },

            

        },
      
        
        
    }
</script>