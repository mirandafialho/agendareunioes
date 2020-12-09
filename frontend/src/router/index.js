import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import Login from '../views/Login.vue'

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
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/About.vue'),
		meta: {
			isAuthenticated: false
		}
	},
	{
		path: '/schedule',
		name: 'Schedule',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/Schedule.vue'),
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/client',
		name: 'Client',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/Client.vue'),
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/collaborator',
		name: 'Collaborator',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/Collaborator.vue'),
		meta: {
			isAuthenticated: true
		}
	},
	{
		path: '/partner',
		name: 'Partner',
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ '../views/Partner.vue'),
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
	// if(to.matched.some(record => record.meta.requiresAuth)) {
    //     if (localStorage.getItem('jwt') == null) {
    //         next({
    //             path: '/login',
    //             params: { nextUrl: to.fullPath }
    //         })
    //     } else {
    //         let user = JSON.parse(localStorage.getItem('user'))
    //         if(to.matched.some(record => record.meta.is_admin)) {
    //             if(user.is_admin == 1){
    //                 next()
    //             }
    //             else{
    //                 next({ name: 'userboard'})
    //             }
    //         }else {
    //             next()
    //         }
	// 	}
		
    // } else if(to.matched.some(record => record.meta.guest)) {
    //     if(localStorage.getItem('jwt') == null){
    //         next()
    //     }
    //     else{
    //         next({ name: 'userboard'})
    //     }
    // } else {
    //     next()
    // }
	if (to.name !== 'Login' && to.matched.some(record => record.meta.isAuthenticated)) next({ name: 'Login' })
	else next()
})

export default router
