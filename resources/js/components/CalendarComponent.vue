<template>
    <div>
        <FullCalendar :options="calendarOptions" @select="handleSelect" @eventRender="renderEvent" />
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
                // calledEvents: [],
                calendarOptions: {
                    plugins: [ dayGridPlugin, TimeGridPlugin, InteractionPlugin, ListPlugin ],
                    initialView: 'dayGridMonth',
                    dateClick: this.handleDateClick,
                    events: {}
                }
            }
        },
        created () {
            console.log(this.calledEvents);
        },
        methods: {
            handleDateClick: function(arg) {
                // alert('date click! ' + arg.dateStr)
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
                    // this.$modal.show(CommentsModal, {
                    //     text: "This is for the comments"
                    // })
                })
            },


        }
    }
</script>

<style scoped>

</style>


