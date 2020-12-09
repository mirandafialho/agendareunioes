<template>
	<div id="app">
		<b-navbar toggleable="lg" type="dark" variant="dark">
			<b-navbar-brand href="#">Agenda de Reuniões</b-navbar-brand>

			<b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

			<b-collapse id="nav-collapse" is-nav>

				<!-- Right aligned nav items -->
				<b-navbar-nav class="ml-auto">
					<b-navbar-nav right v-if="logged">	
						<b-nav-item href="#">
							<router-link to="/">Início</router-link>
						</b-nav-item>
						<b-nav-item href="#">
							<router-link to="/about">Sobre</router-link>
						</b-nav-item>
						<b-nav-item href="#" >
							<router-link to="/schedule">Agenda</router-link>
						</b-nav-item>
					</b-navbar-nav>

					<b-nav-item-dropdown text="Cadastros" right v-if="logged">
						<b-dropdown-item href="/client">Cliente</b-dropdown-item>
						<!--<b-dropdown-item href="/collaborator">Colaborador</b-dropdown-item>-->
						<!--<b-dropdown-item href="/partner">Sócio</b-dropdown-item>-->
					</b-nav-item-dropdown>

					<b-nav-item-dropdown right v-if="logged">
						<!-- Using 'button-content' slot -->
						<template #button-content>
							Usuário
						</template>
						<!--<b-dropdown-item href="#">Perfil</b-dropdown-item>-->
						<b-dropdown-item href="#" @click="logout">Sair</b-dropdown-item>
					</b-nav-item-dropdown>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
		<router-view />
		<b-navbar fixed="bottom" class="footer-copy">
			<b-collapse id="nav-text-collapse" is-nav>
				<b-navbar-nav>
					<b-nav-item>
						<span>&copy; Miranda Fialho</span>
					</b-nav-item>
				</b-navbar-nav>
			</b-collapse>
		</b-navbar>
	</div>
</template>

<script>
//import Login from '@/views/Login'
import LoginService from '@/services/LoginService'

export default {
	name: 'App',
	data() {
		return {
			partner: true,
			administrator: true,
			client: true
		}
	},
	methods: {
		logout() {
			if (this.$store.getters.loggedIn) {
				LoginService.logout()
					.then(response => {
						console.log(response)
						localStorage.removeItem('access_token')
						this.$router.push({ name: 'Login' })
					})
					.catch(e => {
						console.log(e);
					})
			}
		}
	},
	computed: {
		logged() {
			return this.$store.getters.loggedIn
		}
	}
}	

</script>

<style>
#app {
	font-family: Avenir, Helvetica, Arial, sans-serif;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color: #2c3e50;
}

.footer-copy {
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	color: #2c3e50;
	background: #e0e0e0;
}
</style>
