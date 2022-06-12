import { createApp } from 'vue'
import { createPinia } from 'pinia'
import HomePage from './Pages/HomePage'

const app = createApp({})

app.use(createPinia())

app.component('HomePage', HomePage)

app.mount('#app')
