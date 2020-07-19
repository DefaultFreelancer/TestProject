<template>
    <div>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import TimeGridPlugin from '@fullcalendar/timegrid'
    import InteractionPlugin from '@fullcalendar/interaction'
    import ListPlugin from '@fullcalendar/list'

    export default {
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin ],
                    initialView: 'dayGridMonth',
                    dateClick: this.handleDateClick,
                    events: [
                        { title: 'event 1', date: '2019-04-01' },
                        { title: 'event 2', date: '2019-04-02' }
                    ]
                }
            }
        },
        methods: {
            handleDateClick: function(arg) {
                alert('date click! ' + arg.dateStr)
            }
        }
    }
</script>

<style scoped>

</style>


