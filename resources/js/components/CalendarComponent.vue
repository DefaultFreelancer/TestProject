<template>
    <div>
        <div v-if="eventStatus.length" class="form-group">
            <div class="alert alert-success" role="alert">
                {{ eventStatus }}
            </div>
        </div>
        <FullCalendar :options="calendarOptions"/>
        <Modal v-if="showModal" :active-date="activeEvent" :event-categories="eventsCategory" @addedEvent="addedEventHandler"  @close="showModal = false"></Modal>
    </div>
</template>

<!-- For the calendar, I've used the FullCalendar Library. -->
<!-- I've designed the pages according to the following design with bootstrap and default styling. -->
<!-- The calendar design is simple and easy to use. -->

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
        data() { // loading props and attributes for vue component
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
                    eventClick: this.handleEventUpdate,
                    editable: true,
                    dayMaxEvents: true
                },
                showModal: false,
                activeEvent: {},
                eventStatus: '',
                currentEvent: {}
            }
        },
        created () { // on component creating receiving and setting events to calendar
            JSON.parse(this.calledEvents).map((event) => {
                this.calendarOptions.events.push({
                    id: event.id,
                    title: event.name,
                    startRecur: moment(new Date(event.starts_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                    endRecur: moment(new Date(event.ends_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                    extendedProps: {
                        description: event.description,
                        id: event.id
                    },
                })
            });
        },
        methods: { // handling on selecting the date and opening the modal
            handleSelectClick: function (arg) {
                this.activeEvent = arg
                this.showModal = true

            },
            addedEventHandler: function(arg) { // After the event is added, we are handling the message and adding data to calendar
                this.eventStatus = arg.message
                if(arg.data){
                    this.updateEventsHandle();
                    this.currentEvent = JSON.parse(arg.data)
                    this.calendarOptions.events.push({
                        id: this.currentEvent.id,
                        title: this.currentEvent.name,
                        startRecur: this.currentEvent.starts_at,
                        endRecur: this.currentEvent.ends_at
                    });
                }
            },
            handleEventUpdate: function(id) { // Passing the necessary arguments to the modal and opening the modal for update
                this.activeEvent = {id: id.event._def.publicId, event: id.event}
                this.showModal = true
            },
            updateEventsHandle: function () { // After the change was made, we are pulling again data from DB to update the calendar array
                this.calendarOptions.events = []
                axios.get('/dash/event/getEvents').then(response => {
                    JSON.parse(response.data.events).map((event) => {
                        this.calendarOptions.events.push({
                            id: event.id,
                            title: event.name,
                            startRecur: moment(new Date(event.starts_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                            endRecur: moment(new Date(event.ends_at).toISOString()).format('YYYY-MM-DDTHH:mm:ss'),
                            extendedProps: {
                                description: event.description,
                                id: event.id
                            }
                        })
                    });
                })
            }
        },
    }
</script>

<!-- The styling was unnecessary on this component since we used the default one from bootstrap and FullCalendar library -->

<style scoped>

</style>


