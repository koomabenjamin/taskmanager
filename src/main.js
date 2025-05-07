import { createApp } from 'vue'
import { createPinia } from 'pinia'
import App from './App.vue'
import router from './router'
import './assets/main.css'

const app = createApp(App)
app.use(createPinia())
app.use(router)
app.mount('#app')


// // src/main.js
// import { createApp } from 'vue'
// import App from './App.vue'
// import { createPinia } from 'pinia'

// const app = createApp(App)
// const pinia = createPinia()

// app.use(pinia)
// app.mount('#app')
