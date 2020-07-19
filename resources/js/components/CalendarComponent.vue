<template>
    <div>
        <FullCalendar :options="calendarOptions" />
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import interactionPlugin from '@fullcalendar/interaction';

    export default {
        name: "CalendarComponent",
        components: {
            FullCalendar // make the <FullCalendar> tag available
        },
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin ],
                    initialView: 'dayGridMonth',

                    events: [
                        { title: 'event 1', date: '2020-07-01' },
                        { title: 'event 2', date: '2020-07-02' }
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


