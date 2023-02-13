import { createRouter, createWebHistory } from 'vue-router'
import SignUp from '../components/SignUp.vue';
import SignIn from '../components/SignIn.vue';

const routes = [
  
  {
    path: '/Register',
    name: 'SignUp',
    component: SignUp,
  },
  {
    path: '/',
    name: 'SignIn',
    component: SignIn,
  },

];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
