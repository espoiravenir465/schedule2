<template>
  <div class="container" id="events">
  <ScheduleForm  />
  
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
			<td>{{schedule.title}}</td>
			<td>{{schedule.go_date}}</td>
			<td>{{schedule.return_date}}</td>
		</tr>
	</tbody>
</table>
</div>
</template>

<script>
import ScheduleForm from '../components/ScheduleForm.vue'
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'


  export default {
    components: {
     ScheduleForm
    },

    data(){
      return {
        schedule:{title:"",go_date:"",return_date:""},
      }
      },

    
}

  

</script>
    
  

