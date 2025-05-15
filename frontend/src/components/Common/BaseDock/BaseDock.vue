<script setup lang="ts">
import { links } from '@/consts/links';
import BaseIcon from '../BaseIcon/BaseIcon.vue';
import BaseDockButton from './BaseDockButton.vue';
import type { GlobalDockProps } from './Type';

const props = defineProps<GlobalDockProps>()
const route = useRoute()
const router = useRouter();

const currentPath = computed(() => {
  return route.path
})

async function to(name: string) {
  await router.push({ name, params: {
    token: route.params.token ?? props.token,
  }})
}

function onClickShare() {
  window.open(links.lineRoom.url, '_blank')
}

</script>

<template>
  <div class="dock w-full border-t-1 border-[#D1D5DB]">
    <BaseDockButton
      :current-path
      label="写真を共有する"
      to-path="/share"
      @click="onClickShare"
    >
      <BaseIcon icon="launch" />
    </BaseDockButton>

    <BaseDockButton
      :current-path
      label="メッセージを見る"
      to-path="/messages"
      @click="to('messagePage')"
    >
      <BaseIcon icon="mail_outline" />
    </BaseDockButton>

    <BaseDockButton
      :current-path
      label="クイズに答える"
      to-path="/questions"
      @click="to('questionPage')"
    >
      <BaseIcon icon="quiz" />
    </BaseDockButton>
  </div>
</template>
