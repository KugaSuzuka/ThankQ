<script setup lang="ts">
import BaseCarousel from '@/components/Common/BaseCarousel/BaseCarousel.vue';
import BaseSection from '@/components/Common/BaseSection.vue';
import ThLetter from '@/components/messages/Letter/ThLetter.vue';
import { useGuest } from '@/composables/useGuest';
import { useGuestStore } from '@/stores/guestStore';

const store = useGuestStore();
const { isLoading } = useGuest();
const isShown = ref(false)
const currentIndex = ref(0);

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

setTimeout(() => {
  isShown.value = true;
}, 100)
</script>

<template>
  <Transition name="fade-only">
    <BaseSection
      v-if="isShown"
      class="h-full p-6 flex flex-col gap-4"
    >
      <div
        v-for="item, index in store.guest?.messages"
        :key="index"
      >
        <ThLetter
          v-if="isShownMessage(index)"
          :body="item.message"
          :from="item.name"
          :is-loading
          :to="index === 0 ? store.guest?.name : ''"
          @draw="onDraw"
        />
      </div>
      <div>
        <BaseCarousel
          v-if="imgList"
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
