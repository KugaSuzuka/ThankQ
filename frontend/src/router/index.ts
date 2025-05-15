import { createRouter, createWebHashHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import MessageView from '@/views/MessageView.vue'
import { createQuestionPage } from './getQuestionPage'
import NotFoundView from '@/views/NotFoundView.vue'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/:token',
      name: 'home',
      component: HomeView,
    },
    {
      path: '/:token/messages',
      name: 'messagePage',
      component: MessageView,
    },
    ...createQuestionPage(),
    // {
    //   path: "/:token/:notFound(.*)",
    //   name: 'error.404',
    //   component: NotFoundView,
    // },
    {
      path: "/:notFound(.*)",
      name: 'error.404',
      component: NotFoundView,
    },
  ],
})

export default router
