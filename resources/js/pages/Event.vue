<template>
 <div class="container">
 <div class="event-container">
  <EventForm  />
  <div class="event-periode">
  	<div class="event-date">
  	イベント日付
  	</div>
  <v-date-picker :mode="mode"
               :formats="formats"
               v-model="selectedDate"></v-date-picker>
  </div>
  <table class="table bordered break-all">
	<thead  class="thead-dark">
		<tr>
			<th>開始時間</th>
			<th>終了時間</th>
			<th>イベント名</th>
			<th>詳細</th>
			<th>削除</th>
		</tr>
	</thead>
	<tbody>
		<tr v-for="(event,index) in events">
		    <td align = "center" valign ="middle">
			  <div v-if="!event.start_edit" v-text="event.start" v-on:click="$set(event, 'start_edit', true)"></div>
        <input v-if="event.start_edit" type="time" v-model="event.start" v-on:blur="$set(event, 'start_edit', false)"  >
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!event.end" v-text="event.end" v-on:click="$set(event, 'end_edit', true)"></div>
        <input v-if="event.end_edit" type="time" v-model="event.end" v-on:blur="$set(event, 'end_edit', false)"  >
			</td>
			<td align = "center" valign ="middle">
			  <div v-if="!event.title_edit" v-text="event.title" v-on:click="$set(event, 'title_edit', true)"></div>
        <input v-if="event.title_edit" type="text" v-model="event.title" v-on:blur="$set(event, 'title_edit', false)"  >
			</td>
			<td align = "center" valign ="middle" ><router-link to="/{schedule_id}/{event_id}"><button class="btn btn-primary">詳細</button></router-link></td> 
			<td align = "center" valign ="middle" ><button class="btn btn-danger"  v-on:click="deleteSchedule(schedule.id)" >削除</button></td>
		</tr>
	</tbody>
</table>
 <div class="save-button"><button class="btn btn-success" v-on:click="editEvent(events)">保存</button></div>
</div>
</div>
</div>
</template>

<script>
import EventForm from '../components/EventForm.vue'
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'


  export default {
    components: {
     EventForm
    },
    data () {
    return {
      events: [],
      mode: 'single',
    　formats: {
       input: ['YYYY-MM-DD'],
    },
    selectedDate: null,
    }},
  }
  
  </script>