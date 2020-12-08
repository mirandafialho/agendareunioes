<template>
	<div class="partner">
		<h1>Sócios</h1>
		<hr>
		<Partners />
	</div>
</template>

<script>
import Partners from '@/components/Partner/Partners.vue'

export default {
	components: { 
		Partners
	}
}
</script>

<style>
	.partner {
        margin: 50px 50px;
    }
</style>