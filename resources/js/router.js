import Vue from 'vue'
import Router from 'vue-router'
Vue.use(Router)
import findings from './admin/components/pages/finding'
import home from './admin/components/pages/home'
import area from './admin/components/pages/area'
import program from './admin/components/pages/program'
import users from './admin/components/pages/user'
import login from './admin/components/pages/login'
import multiUpload from './admin/components/pages/multiUpload'
import Deliverable from './admin/components/pages/deliverable'
	
const routes =[
	{
		path:'/accred_finding',
		component: findings
	},
	{
		path:'/',
		component: home
	},

	{
		path:'/area',
		component: area
	},
	// {
	// 	path:'/program',
	// 	component: program
	// },

	{
		path:'/users',
		component: users
	},
	{
		path:'/login',
		component: login
	},
	{
		path:'/multiupload',
		component: multiUpload
	},
	{
		path:'/Deliverable',
		component: Deliverable
	}

	





]

export default new Router({
	mode: 'history',
	routes
})