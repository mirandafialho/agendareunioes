import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'
import About from '../views/About.vue'
import Schedule from '../views/Schedule.vue'
import Client from '../views/Client.vue'
import Collaborator from '../views/Collaborator.vue'
import Partner from '../views/Partner.vue'

Vue.use(VueRouter)

const routes = [
	{
		path: '/login',
		name: 'Login',
		component: Login,
		meta: {
			isAuthenticated: false
		}
	},
	{
		path: '/',
		name: 'Home',
		component: Home,
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/about',
		name: 'About',
		component: About,
		meta: {
			isAuthenticated: false,
			guest: true
		}
	},
	{
		path: '/schedule',
		name: 'Schedule',
		component: Schedule,
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/client',
		name: 'Client',
		component: Client,
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/collaborator',
		name: 'Collaborator',
		component: Collaborator,
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/partner',
		name: 'Partner',
		component: Partner,
		meta: {
			isAuthenticated: true
		}
	}
]

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})

// GOOD
router.beforeEach((to, from, next) => {
	if (to.matched.some(record => record.meta.isAuthenticated)) {
        if (localStorage.getItem('access_token') == null) {
            next({
                path: '/login'
            })
        } else {
			next()
		}
    } else {
        next()
    }
})

export default router
