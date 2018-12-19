import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router);
import Login from './components/auth/Login.vue'
import Register from './components/auth/Register.vue'
import Champion from './components/pages/champions/Champion.vue'
import ChampionView from './components/pages/champions/ChampionView.vue'
const router  = new Router({
	mode: 'history',
	transitionOnLoad: true,
	routes: [
		{
			path: "/login",
			component: Login
		},
		{
			path: '/register',
			component: Register
		},
		{
			path: '/champions',
			component: Champion
		},
		{
			name: 'champion_view',
			path: '/champion/:name',
			component: ChampionView
		},
		// admins
		{
			path: '/admin/champion',
			name: 'admin.champion.index',
			component: require('./components/admin/champions/ChampionIndex.vue')
		},
		{
			path: '/admin/champion/:name',
			name: 'admin.champion.edit',
			component: require('./components/admin/champions/ChampionEdit.vue')
		},
		{
			path: '/admin/items',
			name: 'admin.item.view',
			component: require('./components/admin/Items.vue')
		}
	]
})
export default router