<script setup lang="ts">

import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseCard from '@/components/Common/BaseCard/BaseCard.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseSection from '@/components/Common/BaseSection.vue';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import BaseText from '@/components/Common/BaseText/BaseText.vue';
import ConfirmListItem from '@/components/Questions/ConfirmListItem/ConfirmListItem.vue';
import { useQuizAnswer } from '@/composables/useAnswer';
import { useDialog } from '@/composables/useDialog';
import { useQuiz } from '@/composables/useQuiz';
import { useQuizStore } from '@/stores/quizStore';
import { RouterLink } from 'vue-router';

const store = useQuizStore();
const { isLoading, sendAnswer, errorMessage, } = useQuizAnswer()
const { saveStatusToStorage, status } = useQuiz();
const { open } = useDialog()
const router = useRouter();

const results = computed(() => {
  return store.quizzes.map((quiz) => {
    const quizChoice = quiz.quiz_choices.find((quizChoice) => {
      return quizChoice.id === quiz.answer_id;
    });

    return {
      id: quiz.id,
      question: quiz.question,
      answer: quizChoice?.choice,
    }
  })
})

const btnText = computed(() => {
  if (isLoading.value) {
    return '送信中...'
  }

  return '回答する！'
})


async function onSend() {
  await sendAnswer();
  if (!errorMessage.value) {
    saveStatusToStorage('done');
    await router.push({name: 'questionEndPage'})
  }
}

watch(errorMessage, (newErrorMessage) => {
  if (newErrorMessage) {
    open('AlertDialog', {
      title: 'うまくいきませんでした！',
      body: newErrorMessage.split('\n'),
    })
  }
});
</script>

<template>
  <BaseSection
    class="h-full"
    v-motion-slide-visible-once-right
    :duration="300"
  >
    <BaseStack
      component="div"
      gap="xl"
    >
      <BaseHeading tag="h1">
        回答の確認
      </BaseHeading>
      <BaseCard shadow="xs">
        <BaseStack component="ul">
          <ConfirmListItem
            v-for="result, index in results"
            :key="result.id"
            :answer-of-user="result.answer ?? ''"
            :no-border="results.length - 1 === index"
            :question="result.question"
          />
        </BaseStack>
      </BaseCard>

      <BaseText>
        回答は<strong>1回のみ</strong>となります！<br>
        <RouterLink
          v-if="status === 'done'"
          class="text-sm link"
          :to="{name: 'questionEndPage'}"
        >
          回答完了ページを見る
        </RouterLink>
      </BaseText>

      <BaseStack
        v-if="status === 'answering'"
        class="items-center sticky rounded-xl bottom-0"
        :col="false"
        component="div"
        gap="md"
      >
        <BaseBtn
          class="w-30 shadow-xl"
          color="secondary"
          :disabled="isLoading"
          size="lg"
          @click="$router.push({name: 'questionAnswerPage', params: {
            id: 1
          }})"
        >
          やり直す
        </BaseBtn>

        <BaseBtn
          class="flex-grow-1 shadow-xl"
          color="primary"
          :loading="isLoading"
          size="xl"
          @click="onSend"
        >
          {{ btnText }}
        </BaseBtn>
      </BaseStack>
    </BaseStack>
  </BaseSection>
</template>
