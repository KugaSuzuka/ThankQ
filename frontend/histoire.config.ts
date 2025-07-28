import { defineConfig } from 'histoire'
import { HstVue } from '@histoire/plugin-vue'

export default defineConfig({
  plugins: [
    HstVue(),
  ],
  setupFile: '/src/histoire.setup.ts',
  vite: {
    resolve: {
      alias: {
        '@': '/src'
      }
    }
  },
  theme: {
    title: 'ThankQ Component Library',
  },
  tree: {
    groups: [
      {
        id: 'top',
        title: ''
      },
      {
        id: 'common',
        title: 'Common Components'
      },
      {
        id: 'dialogs',
        title: 'Dialogs'
      },
      {
        id: 'messages', 
        title: 'Messages'
      },
      {
        id: 'other',
        title: 'Other Components'
      }
    ]
  }
})