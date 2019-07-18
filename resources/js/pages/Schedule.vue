<template>
  <div class="container" id="schedules">
  <ScheduleForm  />
 <table class="table table-bordered">
	<thead  class="thead-dark">
		<tr>
			<th>スケジュール名</th>
			<th>出発日</th>
			<th>帰着日</th>
			<th>変更</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>
		<tr v-for="(schedule,index) in schedules">
			<td>{{schedule.title}}</td>
			<td>{{schedule.go_date}}</td>
			<td>{{schedule.return_date}}</td>
			<td align = "center" valign ="middle" ><button class="btn btn-primary">編集</button></td>
			<td align = "center" valign ="middle" ><button class="btn btn-danger" v-on:click="deleteSchedule(schedule.id)" >削除</button></td>
		</tr>
	</tbody>
</table>
</div>
</template>

<script>
import ScheduleForm from '../components/ScheduleForm.vue'
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'


  export default {
    components: {
     ScheduleForm
    },

    data () {
    return {
      schedules: [],
      schedule_id: 0
    }},
    
    
      
	methods:{
		async fetchSchedules (){
    	const response = await axios.get('/api/schedule')
    	this.schedules = response.data.data
		},
		
		reload() {
            this.$router.go({path: this.$router.currentRoute.path, force: true});
        },
		
     async deleteSchedule({index}){
      console.log("test start")
      console.log(index)
      console.log("end")},
      
     async deleteSchedule(schedule_id){
       console.log("test start")
       console.log(schedule_id)
       console.log("end")  
       const response = await axios.delete('/api/schedule'+schedule_id)
       this.schedules.splice(index, 1)
       this.reload();
      
   }
  },

	
	watch: {
    $route: {
      async handler () {
        await this.fetchSchedules()
      },
      immediate: true
    }
  }
    
}

  

</script>
    
  

