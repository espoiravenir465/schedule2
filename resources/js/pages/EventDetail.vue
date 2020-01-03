<template>
<div class="container">
<div class="event-detail">
<p>イベント詳細</p>
<p>{{event_date}}</p>
<p>{{event_title}}</p>
</div>
</div>
</template>
<script>
import { mapState } from 'vuex'
import { mapGetters } from 'vuex'
import { CREATED, UNPROCESSABLE_ENTITY } from '../util'

export default {
 data () {
  return {
      events: [],
      }
},

methods:{
    async fetchEventdetail (){
      console.log('testfetch')
      const response = await axios.get('/api/'+ this.$route.params.id +'/events?id=' + this.$route.params.id)
      this.events = response.data.data
      console.log(response)
    }
}
}


</script>
