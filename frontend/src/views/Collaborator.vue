<template>
	<div class="collaborator">
		<h1>Colaboradores</h1>
		<hr>
		<Collaborators />
	</div>
</template>

<script>
import Collaborators from '@/components/Collaborator/Collaborators.vue'

export default {
	components: { 
		Collaborators
	}
}
</script>

<style>
	.collaborator {
        margin: 50px 50px;
    }
</style>