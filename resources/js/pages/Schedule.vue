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
<<<<<<< HEAD
			<!-- <td align = "center" valign ="middle">{{schedule.title}}</td>-->
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.title_edit" v-text="schedule.title" v-on:click="$set(schedule, 'title_edit', true)"></div>
        <input v-if="schedule.title_edit" type="text" v-model="schedule.title" v-on:blur="$set(schedule, 'title_edit', false)"  v-auto-focus>
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.go_date_edit" v-text="schedule.go_date" v-on:click="$set(schedule, 'go_date_edit', true)"></div>
        <input v-if="schedule.go_date_edit" type="text" v-model="schedule.go_date" v-on:blur="$set(schedule, 'go_date_edit', false)"  v-auto-focus>
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!schedule.return_date_edit" v-text="schedule.return_date" v-on:click="$set(schedule, 'return_date_edit', true)"></div>
        <input v-if="schedule.return_date_edit" type="text" v-model="schedule.return_date" v-on:blur="$set(schedule, 'return_date_edit', false)"  v-auto-focus>
			</td>
			<td align = "center" valign ="middle" ><router-link to="/${schedule_id}/events"><button class="btn btn-primary">詳細</button></router-link></td>
			<td align = "center" valign ="middle" ><button class="btn btn-danger"  v-on:click="deleteSchedule(schedule.id)" >削除</button></td>
=======
			<td>{{schedule.title}}</td>
			<td>{{schedule.go_date}}</td>
			<td>{{schedule.return_date}}</td>
			<td align = "center" valign ="middle" ><button class="btn btn-primary">編集</button></td>
			<td align = "center" valign ="middle" ><button class="btn btn-danger" v-on:click="deleteSchedule(schedule.id)" >削除</button></td>
>>>>>>> 608b895d249cec115f1019fa9415be03593cb996
		</tr>
	</tbody>
</table>
 <!--<div class="save-button"><button class="btn btn-success" v-on:click="saveSchedule">保存</button></div>-->
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
<<<<<<< HEAD
      schedule_id: 0,
    }},
    
    
      
=======
      schedule_id: 0
    }
      },
>>>>>>> 608b895d249cec115f1019fa9415be03593cb996
	methods:{
		async fetchSchedules (){
    	const response = await axios.get('/api/schedule')
    	this.schedules = response.data.data
		},
		
<<<<<<< HEAD
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
   
   edit: function(index) {
    this.editIndex = index;                         
    this.schedule = this.list[index].schedule;         
    this.created_at = this.list[index].created_at;  
    this.$refs.editor.focus();                      
  },
=======
		//reload() {
    //        this.$router.go({path: this.$router.currentRoute.path, force: true});
    //    },
		
   async deleteSchedule(schedule_id){
     console.log("test start")
     console.log(schedule_id)
     console.log("end")
      const response = await axios.delete('/api/schedule/'+ schedule_id)
      this.schedules.splice(index, 1)
    //  this.reload();
   }
>>>>>>> 608b895d249cec115f1019fa9415be03593cb996
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
    
  

