<template>
    <div>
        <div v-if="eventStatus.length" class="form-group">
            <div class="alert alert-success" role="alert">
                {{ eventStatus }}
            </div>
        </div>
        <FullCalendar :options="calendarOptions" />
        <Modal v-if="showModal" :active-date="activeEvent" :event-categories="eventsCategory" @addedEvent="addedEventHandler"  @close="showModal = false"></Modal>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import TimeGridPlugin from '@fullcalendar/timegrid'
    import InteractionPlugin from '@fullcalendar/interaction'
    import ListPlugin from '@fullcalendar/list'
    const moment = require('moment');

    export default {
        components: { FullCalendar },
        props: ['calledEvents','eventsCategory'],
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin ],
                    selectable: true,
                    droppable: true,
                    initialView: 'timeGridWeek',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    select: this.handleSelectClick,
                    events: [],
                    buttonIcons: false, // show the prev/next text
                    weekNumbers: true,
                    navLinks: true, // can click day/week names to navigate views
                    editable: true,
                    dayMaxEvents: true
                },
                showModal: false,
                activeEvent: {},
                eventStatus: '',
                currentEvent: {}
            }
        },
        created () {
            JSON.parse(this.calledEvents).map((event) => {
                this.calendarOptions.events.push({
                    id: event.id,
                    title: event.name,
                    startRecur: moment(new Date(event.starts_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                    endRecur: moment(new Date(event.ends_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                })
            });
        },
        methods: {
            handleSelectClick: function (arg, err) {
                this.activeEvent = arg
                this.showModal = true

            },
            addedEventHandler: function(arg) {
                this.eventStatus = arg.message
                this.currentEvent = JSON.parse(arg.data)
                this.calendarOptions.events.push({
                    id: this.currentEvent.id,
                    title: this.currentEvent.name,
                    startRecur: this.currentEvent.starts_at,
                    endRecur: this.currentEvent.ends_at
                });
                console.log(JSON.parse(arg.data));
            }


        }
    }
</script>

<style scoped>

</style>


