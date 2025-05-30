<script setup lang="ts">
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseCenter from '@/components/Common/BaseCenter/BaseCenter.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseRadioGroup from '@/components/Common/BaseRadioGroup/BaseRadioGroup.vue';
import BaseSection from '@/components/Common/BaseSection.vue';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import BaseStepper from '@/components/Common/BaseStepper/BaseStepper.vue';
import { useQuiz } from '@/composables/useQuiz';
import { useQuizStore } from '@/stores/quizStore';

const { saveToStorage, status } = useQuiz();
const store = useQuizStore();
const route = useRoute();
const router = useRouter();
const sectionRef = useTemplateRef('baseSection');
const transitionName = ref<'slide-left'|'slide-right'>('slide-left')

const id = computed(() => {
  const _id = Number(route.params.id)

  if (Number.isNaN(_id)) {
    return -1
  }
  return _id;
})

const currentQuiz = computed(() => {
  return store.findById(id.value)
})

const currentIndex = computed(() => {
  return store.findIndexById(id.value);
})

const prevQuiz = computed(() => {
  return store.findPrevQuiz(id.value);
})

const nextQuiz = computed(() => {
  return store.findNextQuiz(id.value);
})

const radioItems = computed(() => {
  return currentQuiz.value?.quiz_choices.map((item, index) => {
    const prefix = index + 1
    return {
      label: `${String(prefix)}. ${item.choice}`,
      value: item.id
    }
  }) ?? [];
})

async function onNext() {
  const nextId = nextQuiz.value?.id;
  if (nextId) {
    transitionName.value = 'slide-left'
    await router.push({
      name: 'questionAnswerPage',
      params: {
        id: nextId
      }
    })
    return;
  }

  await router.push({name: 'questionConfirmPage'})
}

async function onPrev() {
  const prevId = prevQuiz.value?.id;

  if (prevId) {
    transitionName.value = 'slide-right'
    await router.push({
      name: 'questionAnswerPage',
      params: {
        id: prevId
      }
    })
    return;
  }

  await router.push({
    name: 'questionWelcomePage'
  })
}

watch(currentQuiz, () => {
  if (status.value === 'answering') {
    saveToStorage();
  }
  sectionRef.value?.scrollToTop();
});
</script>

<template>
  <BaseSection
    ref="baseSection"
    v-motion-slide-visible-once-top
    class="flex flex-col"
    :duration="500"
  >
    <BaseStack
      component="div"
      grow
    >
      <BaseHeading
        tag="h1"
      >
        クイズに答える
      </BaseHeading>
      <BaseStepper
        class="min-h-10 mt-1"
        :current-step="currentIndex"
        :step-length="store.quizzes.length"
      />

      <BaseStack
        v-if="currentQuiz"
        class="flex-grow-1 justify-end"
        component="div"
        gap="xl"
      >
        <Transition
          mode="out-in"
          :name="transitionName"
        >
          <BaseCenter
            :key="currentQuiz.id"
            :col="false"
            component="div"
            grow
          >
            <BaseHeading
              class="py-8"
              tag="h3"
            >
              Q. {{ currentQuiz.question }}
            </BaseHeading>
          </BaseCenter>
        </Transition>
        <Transition
          mode="out-in"
          :name="transitionName"
        >
          <BaseRadioGroup
            v-model="currentQuiz.answer_id"
            :key="currentQuiz.id"
            :disabled="status === 'done'"
            :radio-items
          />
        </Transition>

        <BaseCenter
          :col="false"
          component="div"
          gap="md"
        >
          <BaseBtn
            class="w-30"
            color="secondary"
            size="lg"
            @click="onPrev"
          >
            戻る
          </BaseBtn>

          <BaseBtn
            class="flex-grow-1"
            color="primary"
            :disabled="!currentQuiz.answer_id"
            size="xl"
            @click="onNext"
          >
            次へ
          </BaseBtn>
        </BaseCenter>
      </BaseStack>
    </BaseStack>
  </BaseSection>
</template>
<style>
/* --- Slide Left (Next) --- */
.slide-left-enter-active, .slide-left-leave-active {
  transition: all 0.3s ease;
}
.slide-left-enter-from {
  transform: translateX(100%);
  opacity: 0;
}
.slide-left-leave-to {
  transform: translateX(-100%);
  opacity: 0;
}

/* --- Slide Right (Prev) --- */
.slide-right-enter-active, .slide-right-leave-active {
  transition: all 0.3s ease;
}
.slide-right-enter-from {
  transform: translateX(-100%);
  opacity: 0;
}
.slide-right-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
</style>
