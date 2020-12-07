<template>
	<div class="client">
		<h1>Clientes</h1>
		<hr>
		<ListClient />
		<!--<AddClient />-->
	</div>
</template>

<script>
import ListClient from '@/components/Client/ListClient.vue'
//import AddClient from '@/components/Client/AddClient.vue'

export default {
	components: { 
		ListClient,
		//AddClient
	}
}
</script>

<style>

</style>