<template>
    <div>
        <FullCalendar :options="calendarOptions" @eventRender="renderEvent" />
        <Modal v-if="showModal" :active-date="activeEvent"  @close="showModal = false"></Modal>
    </div>
</template>

<script>
    import FullCalendar from '@fullcalendar/vue'
    import dayGridPlugin from '@fullcalendar/daygrid'
    import TimeGridPlugin from '@fullcalendar/timegrid'
    import InteractionPlugin from '@fullcalendar/interaction'
    import ListPlugin from '@fullcalendar/list'


    export default {
        components: { FullCalendar },
        props: ['calledEvents'],
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
                    events: []
                },
                showModal: false,
                activeEvent: {}
            }
        },
        created () {
            JSON.parse(this.calledEvents).map((event) => {
                const starts = new Date(event.starts_at);
                const ends = new Date(event.ends_at);
                this.calendarOptions.events.push({
                    id: event.id,
                    title: event.name,
                    startRecur: starts.toISOString(),
                    endRecur: ends.toISOString()
                })
            });
        },
        methods: {
            handleSelectClick: function (arg, err) {
                this.activeEvent = arg
                this.showModal = true
                // console.log(this.activeEvent)
            },
            renderEvent: function (arg) {
                let span = document.createElement('span')
                span.setAttribute('class', 'fa fa-comments')
                arg.el.appendChild(span)
                span.addEventListener('click', event => {
                    event.stopPropagation();

                })
            }


        }
    }
</script>

<style scoped>

</style>


