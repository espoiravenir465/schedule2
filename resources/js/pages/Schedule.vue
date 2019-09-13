<template>
  <div class="container" id="schedules">
    <div class="schedule-container">
  <ScheduleForm  />
 <table class="table table-bordered">
	<thead  class="thead-dark">
		<tr>
			<th>スケジュール名</th>
			<th>出発日</th>
			<th>帰着日</th>
			<th>スケジュール詳細</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>
		<tr v-for="(schedule,index) in schedules">
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.title_edit" v-text="schedule.title" v-on:click="$set(schedule, 'title_edit', true)"></div>
        <input v-if="schedule.title_edit" type="text" v-model="schedule.title" v-on:blur="$set(schedule, 'title_edit', false)"  >
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.go_date_edit" v-text="schedule.go_date" v-on:click="$set(schedule, 'go_date_edit', true)"></div>
        <input v-if="schedule.go_date_edit" type="date" v-model="schedule.go_date" v-on:blur="$set(schedule, 'go_date_edit', false)"  >
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.return_date_edit" v-text="schedule.return_date" v-on:click="$set(schedule, 'return_date_edit', true)"></div>
        <input v-if="schedule.return_date_edit" type="date" v-model="schedule.return_date" v-on:blur="$set(schedule, 'return_date_edit', false)"  >
			</td>
			<td align = "center" valign ="middle" ><router-link to="/${schedule_id}/events"><button class="btn btn-primary">詳細</button></router-link></td>
			<td align = "center" valign ="middle" ><button class="btn btn-danger"  v-on:click="deleteSchedule(schedule.id)" >削除</button></td>
		</tr>
	</tbody>
</table>
 <div class="save-button"><button class="btn btn-success" v-on:click="editSchedule(schedules)">保存</button></div>
</div>
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
      schedule_id: 0,
    }},
    
    
      
	methods:{
		async fetchSchedules (){
    	const response = await axios.get('/api/schedule')
    	this.schedules = response.data.data
		},
		
		reload() {
            this.$router.go({path: this.$router.currentRoute.path, force: true});
        },
      
     async deleteSchedule(schedule_id){
      console.log("test start")
      console.log(schedule_id)
      console.log("end")
      const response = await axios.delete('/api/schedule/'+ schedule_id)
      this.schedules.splice(this.index, 1)
      this.reload();
      
     },
   
     edit: function() {
        this.$set = false
        this.$nextTick(function () { this.$refs.r1.focus() })
      }, 
      
    async editSchedule (schedules) {
      const reponse =await axios.patch('/api/schedule', 
      this.schedules
      )
      this.reload();
      },                
  },

  
	watch: {
    $route: {
      async handler () {
        await this.fetchSchedules()
      },
      immediate: true
    }
  },
    
}
</script>
    
  

