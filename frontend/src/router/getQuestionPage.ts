import QuestionsView from '@/views/Questions/QuestionsView.vue'
import QuestionsWelcomeView from '@/views/Questions/QuestionsWelcomeView.vue'
import QuestionsAnswerView from '@/views/Questions/QuestionsAnswerView.vue'
import QuestionsEndView from '@/views/Questions/QuestionsEndView.vue'
import QuestionsConfirmView from '@/views/Questions/QuestionsConfirmView.vue';
import type { RouteRecordRaw } from 'vue-router';

export function createQuestionPage(): RouteRecordRaw[] {
  return [
    {
      path: '/:token/questions',
      name: 'questionPage',
      component: QuestionsView,
      redirect: (to) => {
        return {
          name: 'questionWelcomePage', params: { token: to.params.token }
        }
      },
      children: [
        {
          path: 'welcome',
          name: 'questionWelcomePage',
          component: QuestionsWelcomeView
        },
        {
          path: ':id',
          name: 'questionAnswerPage',
          component: QuestionsAnswerView
        },
        {
          path: 'confirm',
          name: 'questionConfirmPage',
          component: QuestionsConfirmView
        },
        {
          path: 'thankq',
          name: 'questionEndPage',
          component: QuestionsEndView
        }
      ]
    },
  ];
}
