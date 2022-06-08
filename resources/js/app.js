import { createApp } from 'vue'
import HomePage from './Pages/HomePage'

const app = createApp({})

app.component('HomePage', HomePage)

app.mount('#app')
