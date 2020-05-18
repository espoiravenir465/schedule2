<template>
<div class="container">
    <div class="event-container">
        <EventForm id="${schedule_id}" />
        <div class="event-periode">
            <div class="event-date">
                <v-date-picker :mode="mode" v-model="selectedDate" :is-inline=true :columns="$screens({ default: 1, lg: 2 })" @input="fetchDateEvent">
                </v-date-picker>
            </div>
        </div>
        <table class="table bordered break-all">
            <thead class="thead-dark">
                <tr>
                    <th>開始時間</th>
                    <th>終了時間</th>
                    <th>イベント名</th>
                    <th>詳細</th>
                    <th>削除</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(event,id) in events" :key="id">
                    <td align="center" valign="middle">
                        <div v-if="!event.start_edit" v-on:click="$set(event, 'start_edit', true)">{{event.event_start.slice(0,5)}}</div>
                        <input v-if="event.start_edit" type="time" v-model="event.event_start" v-on:blur="$set(event, 'start_edit', false)">
                    </td>
                    <td align="center" valign="middle">
                        <div v-if="!event.end_edit" v-on:click="$set(event, 'end_edit', true)">{{event.event_end.slice(0,5)}}</div>
                        <input v-if="event.end_edit" type="time" v-model="event.event_end" v-on:blur="$set(event, 'end_edit', false)">
                    </td>
                    <td align="center" valign="middle">
                        <div v-if="!event.title_edit" v-on:click="$set(event, 'title_edit', true)">{{event.event_title}}</div>
                        <input v-if="event.title_edit" type="text" v-model="event.event_title" v-on:blur="$set(event, 'title_edit', false)">
                    </td>
                    <td align="center" valign="middle">
                        <router-link :to="`/${event.schedule_id}/${event.id}`">
                            <button class="btn btn-primary">詳細</button>
                        </router-link>
                    </td>
                    <td align="center" valign="middle">
                        <button class="btn btn-danger" v-on:click="deleteEvent(event.id)">削除
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="save-button">
            <button class="btn btn-success" v-on:click="editEvent(events)">保存</button>
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
        id: 0,
        schedule_id: 1,
        mode: 'single',
    　  formats: {
          input: ['YYYY-MM-DD'],
        },
        selectedDate: null,
        attrs: [
        {
          key: 'today',
          highlight: true,
          dates: new Date(),
        },
      ],
      }
	},
	methods:{
      async fetchEvents (){
        console.log('testfetch')
        const response = await axios.get('/api/'+ this.$route.params.id +'/events?id=' + this.$route.params.id)
        this.events = response.data.data
        console.log(response)
		  },
      async createEvent(events) {
        const reponse =await axios.post('/event/'+ schedule_id, this.events)
        this.reload();
        },
     async fetchDateEvent(selectedDate) {
       var testdate = selectedDate.getFullYear() + toDoubleDigits(selectedDate.getMonth() + 1) + toDoubleDigits(selectedDate.getDate())
       console.log(testdate)
       const response = await axios.get('/api/'+ this.$route.params.id +'/events/'+ testdate +'?id=' + this.$route.params.id + '&date=' + testdate)
       this.events = response.data.data
       console.log(response)
       console.log("test")
      },
	  reload() {
        console.log("reload")
        this.$router.go({path: this.$router.currentRoute.path, force: true});
      },
     async deleteEvent(id){
      console.log("test start")
      console.log(id)
      console.log("end")
      console.log(this.$route.params.id)
      console.log(event_id)
      const response = await axios.delete('/api/'+this.$route.params.id + '/events/' + id+ '/',id)
      this.events.splice(this.index, 1)
      this.reload();
      },
    edit: function() {
        this.$set = false
        this.$nextTick(function () { this.$refs.r1.focus() })
       },
    async editEvent (events) {
       console.log("editEvent")
       const reponse =await axios.patch('/api/'+ this.$route.params.id + '/events', this.events)
       this.reload();
       },
    },
    watch: {
    $route: {
      async handler () {
        await this.fetchEvents()
      },
      immediate: true
    }
  }
  }
  var toDoubleDigits = function(num) {
    num += "";
    if (num.length === 1) {
      num = "0" + num;
    }
    return num;
  }
  </script>
