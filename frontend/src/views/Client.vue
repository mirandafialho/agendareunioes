<template>
	<div class="client">
		<h1>Clientes</h1>
		<Clients />
	</div>
</template>

<script>
import Clients from '@/components/Client/Clients.vue'

export default {
	components: { 
		Clients,
	}
}
</script>

<style>
	.client {
        margin: 25px 50px;
    }
</style>