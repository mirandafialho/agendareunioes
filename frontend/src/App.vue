<template>
	<div id="app">
		<b-navbar toggleable="lg" type="dark" variant="dark">
			<b-navbar-brand href="#">Agenda de Reuniões</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>

				<!-- Right aligned nav items -->
				<b-navbar-nav class="ml-auto">
					<b-navbar-nav right>	
						<b-nav-item href="#">
							<router-link to="/">Home</router-link>
						</b-nav-item>
						<b-nav-item href="#">
							<router-link to="/about">About</router-link>
						</b-nav-item>
						<b-nav-item href="#">
							<router-link to="/schedule">Agenda</router-link>
						</b-nav-item>
					</b-navbar-nav>

					<b-nav-item-dropdown v-if="socio" text="Cadastros" right>
						<b-dropdown-item href="/client">Cliente</b-dropdown-item>
						<b-dropdown-item href="/collaborator">Colaborador</b-dropdown-item>
						<b-dropdown-item href="/partner">Sócio</b-dropdown-item>
					</b-nav-item-dropdown>

					<b-nav-item-dropdown right>
						<!-- Using 'button-content' slot -->
						<template #button-content>
							User
						</template>
						<b-dropdown-item href="#">Profile</b-dropdown-item>
						<b-dropdown-item href="#">Sign Out</b-dropdown-item>
					</b-nav-item-dropdown>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
		<router-view />
		<b-navbar fixed="bottom" class="footer-copy">
			<b-collapse id="nav-text-collapse" is-nav>
				<b-navbar-nav align="center">
					<b-nav-item>
						<span>&copy; Miranda Fialho</span>
					</b-nav-item>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>

<script>
export default {
	name: 'App',
	data() {
		return {
			socio: true,
			administrador: true,
			cliente: true
		}
	}
}	

</script>

<style>
#app {
	font-family: Avenir, Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	text-align: center;
	color: #2c3e50;
}

.footer-copy {
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color: #2c3e50;
	background: #e0e0e0;
}
</style>
