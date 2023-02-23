import { createRouter, createWebHistory } from 'vue-router'
import SignUp from '../components/SignUp.vue';
import SignIn from '../components/SignIn.vue';
import BookComponent from '../components/BookApp.vue';
import HomeComponent from '../components/HomeComponent.vue';

const routes = [
  
  {
    path: '/',
    name: 'SignUp',
    component: SignUp,
  },
  {
    path: '/Booking',
    name: 'BookComponent',
    component: BookComponent,
  },
  {
    path: '/Login',
    name: 'SignIn',
    component: SignIn,
  },
  {
    path: '/Home',
    name: 'Home',
    component: HomeComponent,
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
