import { createPinia } from 'pinia'
import { defineSetupVue3 } from '@histoire/plugin-vue'
import { MotionPlugin } from '@vueuse/motion'

import './assets/main.css'
import 'material-icons/iconfont/material-icons.css'

export const setupVue3 = defineSetupVue3(({ app }) => {
  // Pinia store setup
  app.use(createPinia())
  
  // Motion plugin setup
  app.use(MotionPlugin)
})