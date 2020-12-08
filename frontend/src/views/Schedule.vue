<template>
    <!-- <div class="schedule">
        <h1>Agenda</h1>
        <hr>
        <FullCalendar />
    </div> -->
    <div class='demo-app'>
        <div class='demo-app-sidebar'>
            <div class='demo-app-sidebar-section'>
                <h2>Instructions</h2>
                <ul class="demo-app-instructions">
                    <li>Select dates and you will be prompted to create a new event</li>
                    <li>Drag, drop, and resize events</li>
                    <li>Click an event to delete it</li>
                </ul>
            </div>
        </div>
        <div class='demo-app-main'>
            <FullCalendar
                class='demo-app-calendar'
                :options='calendarOptions'
            >
                <template v-slot:eventContent='arg'>
                    <b>{{ arg.timeText }}</b>
                    <i>{{ arg.event.title }}</i>
                </template>
            </FullCalendar>
        </div>
        <b-modal id="modal-schedule" ref="schedule-modal" title="Agenda" hide-footer>
            <b>Título</b>
            <p>
                <span>{{ event.title }}</span>
            </p>
            <b>Descrição</b>
            <p>
                <span>{{ event.description }}</span>
            </p>
            <p>
                <b>Início</b>
                <span>{{ event.beginning_date }}</span>
                <b>Fim</b>
                <span>{{ event.conclusion_date }}</span>
                <b>Duração</b>
                <span>{{ event.duration }}</span>
            </p>
            <p>
                <b>Solicitante</b>
                <span>{{ event.beginning_date }}</span>
                <b>Convidado</b>
                <span>{{ event.conclusion_date }}</span>
            </p>
            <p>
                <b>Aceito</b>
                <span>{{ event.accept ? 'Sim' : 'Não' }}</span>
            </p>
        </b-modal>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import { createEventId } from './event-utils'
import ScheduleDataService from '@/services/ClientDataService'

export default {
    name: 'Schedule',
    components: {
        FullCalendar
    },
    data () {
        return {
            calendarOptions: {
                plugins: [
                    dayGridPlugin,
                    timeGridPlugin,
                    interactionPlugin // needed for dateClick
                ],
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                initialView: 'dayGridMonth',
                //initialEvents: INITIAL_EVENTS, // alternatively, use the `events` setting to fetch from a feed
                events: [],
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: false,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents
                /* you can update a remote database when these fire:
                eventAdd:
                eventChange:
                eventRemove:
                */
            },
            event: [],
            currentEvents: []
        }
    },
    methods: {
        getEvents() {
            ScheduleDataService.getAll()
                .then(response => {
                    this.events = response.data
                    console.log(response.data)
                })
                .catch(e => {
                    console.log(e);
                })
        },
        handleDateSelect(selectInfo) {
            let title = prompt('Please enter a new title for your event')
            let calendarApi = selectInfo.view.calendar
            calendarApi.unselect() // clear date selection
            if (title) {
                calendarApi.addEvent({
                    id: createEventId(),
                    title,
                    start: selectInfo.startStr,
                    end: selectInfo.endStr,
                    allDay: selectInfo.allDay
                })
            }
        },
        handleEventClick(clickInfo) {
            console.log(clickInfo)

            // ScheduleDataService.get(clickInfo)
            //     .then(response => {
            //         this.event.id = response.data.id,
            //         this.event.title = response.data.title,
            //         this.event.description = response.data.description,
            //         this.event.start = response.data.beginning_date,
            //         this.event.end = response.data.conclusion_date,
            //         this.event.duration = response.data.duration,
            //         this.event.requester = response.data.requester,
            //         this.event.guest = response.data.guest,
            //         this.event.accept = response.data.accept,
            //         console.log(response)
            //     })
            //     .catch(e => {
            //         console.log(e)
            //     })
            
            // this.$bvModal.show('modal-schedule');
        },
        handleEvents(events) {
            this.currentEvents = events
        }
    },
    mounted() {
        this.getEvents()
    }
}
</script>

<style>
    .schedule {
        margin: 50px 50px;
    }

    h2 {
        margin: 0;
        font-size: 16px;
    }

    demo-app-instructions {
        margin: 0;
        padding: 0 0 0 1.5em;
    }

    demo-app-instructions > li {
        margin: 1.5em 0;
        padding: 0;
    }

    b { /* used for event dates/times */
        margin-right: 3px;
    }

    .demo-app {
        display: flex;
        min-height: 100%;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    .demo-app-sidebar {
        width: 300px;
        line-height: 1.5;
        background: #eaf9ff;
        border-right: 1px solid #d3e2e8;
    }

    .demo-app-sidebar-section {
        padding: 2em;
    }
    
    .demo-app-main {
        flex-grow: 1;
        padding: 3em;
    }

    .fc { /* the calendar root */
        max-width: 1100px;
        margin: 0 auto;
    }
</style>