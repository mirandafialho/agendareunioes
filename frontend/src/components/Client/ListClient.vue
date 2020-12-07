<template>
    <div id="clients">
        <b-table 
            stripped 
            hover 
            :items="clients">
        </b-table>
    </div>
</template>

<script>
import ClientDataService from '@/services/ClientDataService'

export default {
    name: 'ListClient',
    data() {
        return {
            clients: [],
            name: ''
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