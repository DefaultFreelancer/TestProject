<template>
    <div>
        <FullCalendar :options="calendarOptions" @select="handleSelect" @eventRender="renderEvent" />
        <Modal v-if="showModal" @close="showModal = false"></Modal>
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
        props: ['calledEvents'],
        data() {
            return {
                calendarOptions: {
                    plugins: [ dayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin ],
                    initialView: 'dayGridMonth',
                    dateClick: this.handleDateClick,
                    events: {}
                },
                showModal: false
            }
        },
        created () {
            console.log(this.calledEvents);
        },
        methods: {
            handleDateClick: function(arg) {
                this.showModal = true;

            },
            handleSelect: function (arg) {
                console.log(arg)
            },
            renderEvent: function (arg) {
                let span = document.createElement('span')
                span.setAttribute('class', 'fa fa-comments')
                arg.el.appendChild(span)
                span.addEventListener('click', event => {
                    event.stopPropagation();

                })
            },


        }
    }
</script>

<style scoped>

</style>


