import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { TooltipDirective } from './helper/tooltip.js'
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';

import './assets/main.css'
import './assets/tooltip.css'

const app = createApp(App)
app.directive('tooltip', TooltipDirective )
app.use(createPinia())
app.use(router)
app.use(VueSweetalert2);

app.mount('#app')
