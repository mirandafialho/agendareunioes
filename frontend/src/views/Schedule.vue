<template>
    <!-- <div class="schedule">
        <h1>Agenda</h1>
        <hr>
        <FullCalendar />
    </div> -->
    <div class='demo-app'>
        <b-alert variant="success" :show="showSuccessAlert" dismissible>
            <span>{{ message }}</span>
        </b-alert>
        <b-alert variant="warning" :show="showWarningAlert" dismissible>
            <span>{{ message }}</span>
            Houve um problema com os dados da sua reunião. Por favor, contate o suporte.
        </b-alert>
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
        <b-modal id="modal-schedule" ref="modal-schedule" title="Agenda" hide-footer>
            <p>
                <b>Título: </b>
                <span>{{ event.title }}</span>
            </p>
            <p>
                <b>Descrição: </b>
                <span>{{ event.description }}</span>
            </p>
            <p>
                <b>Início: </b>
                <span>{{ event.start }}</span>
            </p>
            <p>
                <b>Fim: </b>
                <span>{{ event.end }}</span>
            </p>
            <p>
                <b>Duração: </b>
                <span>{{ event.duration }}</span>
            </p>
            <p>
                <b>Solicitante: </b>
                <span>{{ event.requester }}</span>
            </p>
            <p>
                <b>Convidado: </b>
                <span>{{ event.guest }}</span>
            </p>
            <p>
                <b>Aceito: </b>
                <span>{{ event.accept ? 'Sim' : 'Não' }}</span>
            </p>
        </b-modal>
        <b-modal id="modal-new-schedule" ref="modal-new-schedule" title="Novo Evento" hide-footer>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <b-form-input id="schedule-id" v-model="event.id" hidden="hidden"></b-form-input>
                <b-form-group id="input-group-2" label="Título:" label-for="titulo">
                    <b-form-input
                        id="schedule-title"
                        v-model="event.title"
                        required
                        placeholder="Título do evento"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-3" label="Descrição:" label-for="descricao">
                    <b-form-input
                        id="schedule-description"
                        v-model="event.description"
                        required
                        placeholder="Descrição do evento"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-4" label="Início:" label-for="inicio">
                    <b-form-datepicker
                        id="schedule-start"
                        v-model="event.startDate"
                        required
                        placeholder="Início do evento"
                    ></b-form-datepicker>
                </b-form-group>

                <b-form-group id="input-group-5" label="" label-for="">
                    <b-form-timepicker
                        id="schedule-start-time"
                        v-model="event.startTime"
                        required
                        placeholder="Horário de fim."
                    ></b-form-timepicker>
                </b-form-group>

                <b-form-group id="input-group-6" label="Fim:" label-for="fim">
                    <b-form-datepicker
                        id="schedule-end"
                        v-model="event.endDate"
                        required
                        placeholder="Fim do evento"
                    ></b-form-datepicker>
                </b-form-group>

                <b-form-group id="input-group-7" label="" label-for="">
                    <b-form-timepicker
                        id="schedule-end-time"
                        v-model="event.endTime"
                        required
                        placeholder="Horário de fim."
                    ></b-form-timepicker>
                </b-form-group>

                <hr>

                <div class="buttons-new-client">
                    <b-button type="submit" variant="success">Cadastrar</b-button>
                    <b-button type="reset" variant="danger">Limpar</b-button>
                </div>
            </b-form>
        </b-modal>
    </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import brLocale from "@fullcalendar/core/locales/pt-br";
import ScheduleDataService from '@/services/ScheduleDataService'

export default {
    name: 'Schedule',
    components: {
        FullCalendar
    },
    data () {
        return {
            calendarOptions: {
                locale: brLocale,
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
                events: [],
                eventColor: '#2c3e50',
                navLinks: true,
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: false,
                timeFormat: 'H(:mm)',
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
                eventsSet: this.handleEvents
                /* you can update a remote database when these fire:
                eventAdd:
                eventChange:
                eventRemove:
                */
            },
            event: {
                id: null,
                title: '',
                description: '',
                startDate: null,
                endDate: null,
                startTime: null,
                endTime: null,
                duration: null,
                requester: null,
                guest: null,
                accept: null
            },
            form: {
                id: null,
                email: '',
                name: '',
                phone: '',
                cellphone: '',
                active: 0
            },
            show: true,
            showSuccessAlert: false,
            showWarningAlert: false,
            message: ''
        }
    },
    created() {
        this.getEvents()
    },
    methods: {
        getEvents() {
            ScheduleDataService.getAll()
                .then(response => {
                    this.calendarOptions.events = response.data
                    console.log(response.data)
                })
                .catch(e => {
                    console.log(e);
                })
        },
        handleDateSelect(selectInfo) {
            this.event.startDate = (selectInfo.start.getFullYear() 
                + '-' + (selectInfo.start.getMonth() + 1)
                + '-' + 
                (selectInfo.start.getDate() < 10 ? '0' : '') + selectInfo.start.getDate()
            )
            this.event.endDate = (selectInfo.end.getFullYear() 
                + '-' + (selectInfo.end.getMonth() + 1)
                + '-' + 
                (selectInfo.end.getDate() < 10 ? '0' : '') + selectInfo.end.getDate()
            )
            this.event.startTime = (
                selectInfo.start.getHours() + 
                ':' + 
                (selectInfo.start.getMinutes() < 10 ? '0' : '') + selectInfo.start.getMinutes()
            )
            this.event.endTime = (
                selectInfo.end.getHours() + 
                ':' + 
                (selectInfo.end.getMinutes() < 10 ? '0' : '') + selectInfo.end.getMinutes()
            )
            this.$bvModal.show('modal-new-schedule')
        },
        handleEventClick(clickInfo) {
            ScheduleDataService.get(clickInfo.event.id)
                .then(response => {
                    this.event = ''
                    this.event.id = response.data.id
                    this.event.title = response.data.title
                    this.event.description = response.data.description
                    this.event.startDate = response.data.start_date
                    this.event.endDate = response.data.end_date
                    this.event.startTime = response.data.start_time
                    this.event.endTime = response.data.end_time
                    this.event.duration = response.data.duration
                    this.event.requester = response.data.requester
                    this.event.guest = response.data.guest
                    this.event.accept = response.data.accept
                    console.log(this.event)
                })
                .catch(e => {
                    console.log(e)
                })
            
            this.$bvModal.show('modal-schedule');
        },
        onSubmit(event) {
            event.preventDefault()

            var data = {
                id: this.event.id,
                title: this.event.title,
                description: this.event.description,
                start: this.event.startDate + ' ' + this.event.startTime,
                end: this.event.endDate + ' ' + this.event.endTime,
                requester: this.event.requester,
                guest: this.event.guest,
                accept: null
            }

            if (this.event.id !== null) {
                this.message = "Reunião editada com sucesso."
            } else {
                this.message = "Reunião cadastrada com sucesso."
            }

            //console.log(data);

            ScheduleDataService.create(data)
                .then(response => {
                    this.event.id = response.data.id
                    console.log(response.data)

                    // Limpar o formulário.
                    this.form.id = null
                    this.form.title = ''
                    this.form.description = ''
                    this.form.startDate = ''
                    this.form.endDate = ''
                    this.form.startTime = ''
                    this.form.endTime = ''
                    
                    // Esconder o modal
                    this.$bvModal.hide('modal-new-schedule');

                    this.getEvents()

                    // Retornar a mensagem.
                    this.showSuccessAlert = true
                })
                .catch(e => {
                    this.showWarningAlert = true

                    console.log(e);
                })

        },
        onReset(event) {
            event.preventDefault()

            // Reset form values
            this.form.id = null
            this.form.name = ''
            this.form.email = ''
            this.form.phone = ''
            this.form.cellphone = ''
            this.form.active = 0

            // Trick to reset/clear native browser form validation state
            this.show = false

            this.$nextTick(() => {
                this.show = true
            })
        },
        handleEvents(events) {
            this.currentEvents = events
        }
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