<script setup lang="ts">
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseCarousel from '@/components/Common/BaseCarousel/BaseCarousel.vue';
import BaseSection from '@/components/Common/BaseSection/BaseSection.vue';
import ThLetter from '@/components/messages/Letter/ThLetter.vue';
import { useGuest } from '@/composables/useGuest';
import { useGuestStore } from '@/stores/guestStore';

const instaxListRef = useTemplateRef('instax-list');
const store = useGuestStore();
const { isLoading } = useGuest();
const isShown = ref(false);
const isShownInstax = ref(false);
const intersecting = ref(false);
const currentIndex = ref(0);
const noTypingAnimation = ref(false);


const messageList = computed(() => {
  return store.guest?.messages.filter((item) => {
    return !!item.message
  })
})
const imgList = computed(() => {
  return store.guest?.guest_photos.map((item) => {
    return { url: item.photo_path }
  }) ?? []
})

function isShownMessage(index: number) {
  return currentIndex.value >= index;
}

function onDraw() {
  currentIndex.value = currentIndex.value + 1
}

async function onStart() {
  if (isShownInstax.value) {
    return;
  }

  isShownInstax.value = true;
  await nextTick();
  startIntersectionObserver();
}

function init() {
  setTimeout(() => {
    isShown.value = true;
  }, 100)
}

function onClickSkip() {
  noTypingAnimation.value = true;
}

function startIntersectionObserver() {
  const { stop } = useIntersectionObserver(
  instaxListRef,
  ([entry], ) => {
    if (entry?.isIntersecting) {
      intersecting.value = entry.isIntersecting;
      stop();
    }
  })
}

init()
</script>

<template>
  <Teleport to="#global-header">
    <div class="flex justify-end">
      <BaseBtn
        color="info"
        size="xs"
        variant="outline"
        @click="onClickSkip"
      >
        <span class="text-xs">スキップ</span>
      </BaseBtn>
    </div>
  </Teleport>

  <Transition name="fade-only">
    <BaseSection
      v-if="isShown"
      class="h-full p-6 flex flex-col gap-4 overflow-x-hidden"
    >
      <div
        v-for="item, index in messageList"
        :key="index"
      >
        <ThLetter
          v-if="isShownMessage(index)"
          :body="item.message"
          :from="item.name"
          :is-loading
          :no-animation="noTypingAnimation"
          :to="index === 0 ? store.guest?.name : ''"
          @draw="onDraw"
          @start="onStart"
        />
      </div>
      <div
        v-if="isShownInstax && imgList.length > 0"
        ref="instax-list"
        class="h-82"
      >
        <BaseCarousel
          v-show="intersecting"
          v-motion-fade-visible
          :duration="500"
          :img-list
          :is-loading
        />
      </div>
    </BaseSection>
  </Transition>
</template>
<style scoped>
.fade-only-enter-active {
  animation: fade-only 1.5s ease-out;
}

@keyframes fade-only {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  50% {
    opacity: 1;
    transform: scale(1);
  }
  100% {
    transform: scale(1);
  }
}
</style>
