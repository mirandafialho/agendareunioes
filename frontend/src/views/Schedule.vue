<template>
    <!-- <div class="schedule">
        <h1>Agenda</h1>
        <hr>
        <FullCalendar />
    </div> -->
    <div class='schedule-app'>
        <b-alert variant="success" :show="showSuccessAlert" dismissible>
            <span>{{ message }}</span>
        </b-alert>
        <b-alert variant="warning" :show="showWarningAlert" dismissible>
            <span>{{ message }}</span>
            Houve um problema com os dados da sua reunião. Por favor, contate o suporte.
        </b-alert>
        <div class='schedule-app-main'>
            <FullCalendar
                class='schedule-app-calendar'
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
            <b-button-group>
                <b-button variant="success" size="sm" @click="editEvent(event.id)">
                    <b-icon-pencil-square></b-icon-pencil-square> Editar
                </b-button>
                <b-button variant="danger" size="sm" @click="removeEvent(event.id)">
                    <b-icon-trash></b-icon-trash> Excluir
                </b-button>
            </b-button-group>
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
import brLocale from '@fullcalendar/core/locales/pt-br';
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
                editable: false,
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
            this.event.startDate = formatDate(selectInfo.start)
            this.event.endDate = formatDate(selectInfo.end)
            this.event.startTime = formatTime(selectInfo.start)
            this.event.endTime = formatTime(selectInfo.end)
            this.$bvModal.show('modal-new-schedule')
        },
        handleEventClick(clickInfo) {
            ScheduleDataService.get(clickInfo.event.id)
                .then(response => {
                    this.event.id = response.data.id
                    this.event.title = response.data.title
                    this.event.description = response.data.description
                    this.event.start = response.data.start
                    this.event.end = response.data.end
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

            ScheduleDataService.create(data)
                .then(response => {
                    this.event.id = response.data.id
                    console.log(response.data)

                    // Limpar o formulário.
                    this.event.id = null,
                    this.event.title = '',
                    this.event.description = '',
                    this.event.startDate = null,
                    this.event.endDate = null,
                    this.event.startTime = null,
                    this.event.endTime = null,
                    this.event.duration = null,
                    this.event.requester = null,
                    this.event.guest = null,
                    this.event.accept = null
                    
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
        editEvent(id) {
            ScheduleDataService.get(id)
                .then(response => {
                    this.event.id = response.data.id
                    this.event.title = response.data.title
                    this.event.description = response.data.description

                    var start_date = response.data.start.split(' ')[0].split('/')
                    this.event.startDate = formatDate(
                        new Date(start_date[2], start_date[1] - 1, start_date[0])
                    )

                    var end_date = response.data.end.split(' ')[0].split('/')
                    this.event.endDate = formatDate(
                        new Date(end_date[2], end_date[1] - 1, end_date[0])
                    )

                    this.event.startTime = formatTime(
                        new Date('1970-01-01 ' + response.data.start.split(' ')[1])
                    )

                    this.event.endTime = formatTime(
                        new Date('1970-01-01 ' + response.data.end.split(' ')[1])
                    )

                    this.event.duration = response.data.duration
                    this.event.requester = response.data.requester
                    this.event.guest = response.data.guest
                    this.event.accept = response.data.accept
                    console.log(response)
                })
                .catch(e => {
                    console.log(e)
                })
            
            this.$bvModal.show('modal-new-schedule');
        },
        removeEvent(id) {
            this.$bvModal.msgBoxConfirm('Você tem certeza?', {
                title: 'Por favor, confirme.',
                size: 'sm',
                buttonSize: 'sm',
                okVariant: 'danger',
                okTitle: 'Sim',
                cancelTitle: 'Não',
                footerClass: 'p-2',
                hideHeaderClose: false,
                centered: true
            })
                .then(value => {
                    if (value) {
                        ScheduleDataService.delete(id)
                            .then(response => {
                                console.log(response)
                                this.getEvents()
                                this.$bvModal.hide('modal-schedule');
                                // Retornar a mensagem.
                                this.message = "Evento removido com sucesso."
                                this.showSuccessAlert = true
                            })
                            .catch(e => {
                                console.log(e)
                            })
                    }
                })
                .catch(e => {
                    console.log(e)
                })
        },
        onReset(event) {
            event.preventDefault()

            // Reset form values
            this.event.id = null,
            this.event.title = '',
            this.event.description = '',
            // this.event.duration = null,
            // this.event.requester = null,
            // this.event.guest = null,
            // this.event.accept = null

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

/**
 * Função para formatação de data.
 */
function formatDate(date) {
    return date.getFullYear() 
        + '-' + 
        (date.getMonth() + 1)
        + '-' + 
        (date.getDate() < 10 ? '0' : '') + date.getDate();
}

/**
 * Função para formatação de tempo.
 */
function formatTime(time) {
    console.log(time);
    return time.getHours() + 
        ':' + 
        (time.getMinutes() < 10 ? '0' : '') + time.getMinutes() +
        ':' +
        (time.getSeconds() < 10 ? '0' : '') + time.getSeconds();
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

    .schedule-app {
        display: flex;
        min-height: 100%;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }
    
    .schedule-app-main {
        flex-grow: 1;
        padding: 3em;
    }

    .fc { /* the calendar root */
        max-width: 1100px;
        margin: 0 auto;
    }
</style>