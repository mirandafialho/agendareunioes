<template>
    <div id="clients">
        <b-alert variant="success" :show="showSuccessAlert" dismissible>
            <span>{{ message }}</span>
        </b-alert>
        <b-alert variant="warning" :show="showWarningAlert" dismissible>
            <span>{{ message }}</span>
            Houve um problema com os dados do seu cliente. Por favor, contate o suporte.
        </b-alert>
        <b-button-toolbar>
            <b-button-group class="mx-1">
                <b-button v-b-modal.modal-new-client variant="primary">+ Cliente</b-button>    
            </b-button-group>
        </b-button-toolbar>
        <b-table 
            stripped 
            hover 
            :items="clients"
            :fields="fields">
            <template #cell(name)="data">
                {{ data.value }}
            </template>
            <template #cell(email)="data">
                {{ data.value }}
            </template>
            <template #cell(phone)="data">
                {{ data.value }}
            </template>
            <template #cell(cellphone)="data">
                {{ data.value }}
            </template>
            <template #cell(active)="data">
                {{ data.value == 1 ? 'Sim' : 'Não' }}
            </template>
            <template #cell(actions)="data">
                <b-button-group>
                    <b-button variant="success" size="sm" @click="editClient(data.item.id)">
                        <b-icon-pencil-square></b-icon-pencil-square>
                    </b-button>
                    <b-button variant="danger" size="sm" @click="removeClient(data.item.id)">
                        <b-icon-trash></b-icon-trash>
                    </b-button>
                </b-button-group>
                {{ data.value }}
            </template>
        </b-table>
        <b-modal id="modal-new-client" ref="client-modal" :data="client" title="Novo Cliente" hide-footer>
            <b-form @submit="onSubmit" @reset="onReset" v-if="show">
                <b-form-input id="client-id" v-model="client.id" hidden="hidden"></b-form-input>
                <b-form-group id="input-group-2" label="Nome:" label-for="nome">
                    <b-form-input
                        id="client-name"
                        v-model="client.name"
                        required
                        placeholder="Nome do cliente"
                    ></b-form-input>
                </b-form-group>

                <b-form-group
                    id="input-group-1"
                    label="E-mail:"
                    label-for="email"
                    description="Nós nunca vamos compartilhar seu e-mail com ninguém."
                >
                    <b-form-input
                        id="client-email"
                        v-model="client.email"
                        type="email"
                        required
                        placeholder="E-mail do cliente"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-3" label="Telefone:" label-for="telefone">
                    <b-form-input
                        id="client-phone"
                        v-model="client.phone"
                        required
                        placeholder="Telefone do cliente"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-4" label="Celular:" label-for="celular">
                    <b-form-input
                        id="client-cellphone"
                        v-model="client.cellphone"
                        required
                        placeholder="Celular do cliente"
                    ></b-form-input>
                </b-form-group>

                <b-form-group id="input-group-4" label="Ativo:" label-for="ativo">
                    <b-form-select 
                        id="client-active"
                        v-model="client.active" 
                        :options="actives"
                    ></b-form-select>
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
import ClientDataService from '@/services/ClientDataService'

export default {
    name: 'Clients',
    data() {
        return {
            fields: [
                {
                    key: 'name',
                    label: 'Nome',
                    sortable: true
                },
                {
                    key: 'email',
                    label: 'E-mail',
                    sortable: false
                },
                {
                    key: 'phone',
                    label: 'Telefone',
                    sortable: false
                },
                {
                    key: 'cellphone',
                    label: 'Celular',
                    sortable: false
                },
                {
                    key: 'active',
                    label: 'Ativo',
                    sortable: false
                },
                {
                    key: 'actions',
                    label: '#',
                    sortable: false
                }
            ],
            clients: [],
            client: {
                id: null,
                email: '',
                name: '',
                phone: '',
                cellphone: '',
                active: 0
            },
            form: {
                id: null,
                email: '',
                name: '',
                phone: '',
                cellphone: '',
                active: 0
            },
            actives: [
                { text: 'Não', value: 0 },
                { text: 'Sim', value: 1 },
            ],
            show: true,
            showSuccessAlert: false,
            showWarningAlert: false,
            message: ''
        }
    },
    methods: {
        retrieveClients() {
            ClientDataService.getAll()
                .then(response => {
                    this.clients = response.data,
                    console.log(response.data)
                })
                .catch(e => {
                    console.log(e);
                })
        },
        onSubmit(event) {
            event.preventDefault()

            var data = {
                id: this.client.id,
                email: this.client.email,
                name: this.client.name,
                phone: this.client.phone,
                cellphone: this.client.cellphone,
                active: this.client.active
            }

            if (this.client.id !== null) {
                this.message = "Cliente editado(a) com sucesso."
            } else {
                this.message = "Cliente cadastrado(a) com sucesso."
            }

            ClientDataService.create(data)
                .then(response => {
                    this.client.id = response.data.id
                    console.log(response.data)

                    // Limpar o formulário.
                    this.form.id = null
                    this.form.name = ''
                    this.form.email = ''
                    this.form.phone = ''
                    this.form.cellphone = ''
                    this.form.active = 0
                    
                    // Esconder o modal
                    this.$bvModal.hide('modal-new-client');

                    this.retrieveClients()

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
        editClient(id) {
            ClientDataService.get(id)
                .then(response => {
                    this.client.id = response.data.id,
                    this.client.name = response.data.name,
                    this.client.email = response.data.email,
                    this.client.phone = response.data.phone,
                    this.client.cellphone = response.data.cellphone,
                    this.client.active = response.data.active,
                    console.log(response)
                })
                .catch(e => {
                    console.log(e)
                })
            
            this.$bvModal.show('modal-new-client');
        },
        removeClient(id) {
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
                        ClientDataService.delete(id)
                            .then(response => {
                                console.log(response.data)
                                this.retrieveClients()

                                // Retornar a mensagem.
                                this.message = "Cliente removido(a) com sucesso."
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
        }
        // setActiveClient(client, index) {
        //     this.currentClient = client;
        //     this.currentIndex = index;
        // },

        // refreshList() {
        //     this.retrieveClients()
        //     this.currentClient = null
        //     this.currentIndex = -1
        // },
    },
    mounted() {
        this.retrieveClients();
    }
}
</script>

<style>

</style>