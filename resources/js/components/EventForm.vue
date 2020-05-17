<template>
<div class="event-form">
    <div class="col-sm-6　center-block">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>イベント追加</h3>
            </div>
            　 <div class="panel-body">
                　 <form class="form" @submit.prevent="createEvent">
                    <div class="form-group">
                        <span>日付</span> <input type="date" class="form-control" placeholder="Date" v-model="event.date">
                    </div>
                    <div class="form-group">
                        <span>開始時間</span> <input type="time" name="example" step="300" value="00:00" class="form-control" placeholder="Time" v-model="event.start">
                    </div>
                    <div class="form-group">
                        <span>終了時間</span> <input type="time" name="example" step="300" value="00:00" class="form-control" placeholder="Time" v-model="event.end">
                    </div>
                    <div class="form-group">
                        <span>イベント名</span> <input type="string" class="form-control" placeholder="Event Name" v-model="event.title">
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
import {
    CREATED,
    UNPROCESSABLE_ENTITY
} from '../util'

export default {
    props: {
        id: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            event: {
                title: "",
                date: "",
                start: "",
                end: ""
            },
            comment: ""
        }
    },
    methods: {
        reload() {
            this.$router.go({
                path: this.$router.currentRoute.path,
                force: true
            });
        },
        async createEvent() {
            console.log('test1')
            const formData = new FormData()
            formData.append('event_title', this.event.title)
            formData.append('event_date', this.event.date)
            formData.append('event_start', this.event.start)
            formData.append('event_end', this.event.end)
            formData.append('schedule_id', this.$route.params.id)
            //console.log(this.$route.params.id)
            const response = await axios.post('/api/event/' + this.$route.params.id, formData)
            //this.$router.push('/event/' + this.$route.params.id)
            this.reload();
        }

    }
}
</script>
