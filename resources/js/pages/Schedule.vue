<template>
  <div class="container" id="events">
    <div class="col-sm-6">
      <div class="panel panel-default">
          <div class="panel-heading">
            <h3>スケジュール追加</h3>
            </div>
　 <div class="panel-body">
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
  </div>
 </div>
</div>
<table class="table table-bordered">
	<thead  class="thead-dark">
		<tr>
			<th>スケジュール名</th>
			<th>出発日</th>
			<th>帰着日</th>
			<th>変更</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>{{ schedule.title }}</td>
			<td>{{ schedule.go_date }}</td>
			<td>{{ schedule.return_date }}</td>
		</tr>
	</tbody>
</table>
</div>
</template>

<script>
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'


  export default {
    
    data() {
      return {
        schedules:[title="",go_date="",return_date=""]
      }
      },
      
  
    methods: {
     async createSchedule () {
     const response = await axios.post(`/api/schedule`, {
      title: this.schedule.title,go_date:this.schedule.go_date,return_date:this.schedule.return_date,
    })
    
    this.$set(this.schedule, 'schedules', [
        response.data,
        ...this.schedule.schedules

      ])
  }
}
}

  

</script>
  

