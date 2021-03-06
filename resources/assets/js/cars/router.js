import Vue from 'vue'
import VueRouter from 'vue-router';
import Main from './components/main.vue';
import Person from './components/person.vue';
import Login from './components/login.vue';
import Register from './components/register.vue';
import Publish from './components/publish.vue';
Vue.use(VueRouter);
const routes = [
  { path: '/', component: Main },
  { path: '/publish',  component: Publish },
  { path: '/person',   component: Person },
  { path: '/login',    component: Login },
  { path: '/register/:phoneNumber', component: Register }
];
const router = new VueRouter({
	routes : routes
});
export default router;