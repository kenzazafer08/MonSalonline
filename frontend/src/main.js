import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import { ProCalendar } from "@lbgm/pro-calendar-vue";


createApp(App).use(VueSweetalert2).use(router).use(ProCalendar).mount('#app')
