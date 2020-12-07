<template>
    <div id="collaborators">
        <b-table stripped hover :items="items"></b-table>
    </div>
</template>

<script>
export default {
    name: 'ListCollaborator',
    data() {
        return {
            items: [
                { age: 32, first_name: 'Cyndi' },
                { age: 27, first_name: 'Havij' },
                { age: 42, first_name: 'Robert' }
            ]
        }
    }
}
</script>

<style>

</style>