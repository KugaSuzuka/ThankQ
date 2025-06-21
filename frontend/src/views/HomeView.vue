<script setup lang="ts">
import BaseCard from '@/components/Common/BaseCard/BaseCard.vue';
import BaseCenter from '@/components/Common/BaseCenter/BaseCenter.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseLink from '@/components/Common/BaseLink/BaseLink.vue';
import BaseSection from '@/components/Common/BaseSection/BaseSection.vue';
import WaveText from '@/components/Common/WaveText/WaveText.vue';
import ThHearts from '@/components/Splash/ThHearts.vue';
import { useGuest } from '@/composables/useGuest';
import { useGuestStore } from '@/stores/guestStore';
import { getImagePath } from '@/utils/assetsPath';
import { ref } from "vue";


const showMail = ref(false)
const showTitle = ref(false)
const showHearts = ref(false)
const { isLoading } = useGuest();
const store = useGuestStore();
const router = useRouter()
const route = useRoute();

function onClick() {
  showMail.value = false
  setTimeout(async () => {
    await router.push({
      name: 'messagePage',
      params: {
      token: route.params.token,
      },
    })
  }, 500);
}

onMounted(() => {
  showHearts.value = true

  setTimeout(() => {
    showTitle.value = true
  }, 2000)

  setTimeout(() => {
    showTitle.value = false
    // showMail.value = true;
  }, 4000);

  setTimeout(() => {
    showMail.value = true
  }, 4500);
})
</script>

<template>
  <ThHearts />
  <Transition name="fade-only">
    <BaseSection
      v-if="showMail && !isLoading"
      class="bg-base-200 shadow-md flex flex-col"
    >
      <!-- <ThSlider /> -->
      <BaseCenter
        component="div"
        grow
      >
        <div class="relative">
          <img
            alt="切手"
            class="opacity-80 absolute z-1 right-0"
            :src="getImagePath('kitte_15536')"
            width="90"
          >
        </div>
        <BaseCard class="bg-base-200">
          <BaseHeading
            class="text-center my-16 message-row tracking-wider"
            tag="h1"
          >
            {{ store.guest?.name ?? '私たちの大事なあなた' }} 様
          </BaseHeading>
          <BaseLink
            v-if="store.guest?.name"
            class="text-center"
            size="md"
            @click="onClick"
          >
            <WaveText text="メッセージを見る" />
          </BaseLink>
        </BaseCard>
      </BaseCenter>
    </BaseSection>
  </Transition>
  <Transition name="fade-scale">
    <BaseCenter
      v-if="showTitle"
      component="div"
      grow
    >
      <BaseHeading
        class="text-center text-4xl"
        tag="h1"
      >
        ThankQ
      </BaseHeading>
    </BaseCenter>
  </Transition>
</template>


<style scoped>
.message-row {
  font-family: 'Zen Kurenaido', sans-serif;
}

.fade-scale-enter-active {
  animation: fade-scale 1.5s ease-out;
}
.fade-scale-leave-active {
  animation: fade-out 0.5s ease-in forwards;
}

@keyframes fade-scale {
  0% {
    opacity: 0;
    transform: scale(0.8);
  }
  50% {
    opacity: 1;
    transform: scale(1.2);
  }
  100% {
    transform: scale(1);
  }
}

@keyframes fade-out {
  0% {
    opacity: 1;
    transform: scale(1);
  }
  100% {
    opacity: 0;
    transform: scale(0.8);
  }
}

.fade-only-enter-active {
  animation: fade-only 1.5s ease-out;
}
.fade-only-leave-active {
  animation: soft-drop-out 3s cubic-bezier(0.22, 1, 0.36, 1) forwards;
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

@keyframes soft-drop-out {
  0% {
    transform: translate(0%, 0) scale(1);
    opacity: 1;
  }
  100% {
    transform: translate(0%, -100%) scale(0.8);
    opacity: 0;
  }
}
</style>
