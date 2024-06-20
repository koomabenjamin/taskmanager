import { createApp } from 'vue'
import { createPinia } from 'pinia'

import App from './App.vue'
import router from './router'
import { TooltipDirective } from './helper/tooltip.js'

import './assets/main.css'
import './assets/tooltip.css'

const app = createApp(App)
app.directive('tooltip', TooltipDirective )
app.use(createPinia())
app.use(router)

app.mount('#app')
