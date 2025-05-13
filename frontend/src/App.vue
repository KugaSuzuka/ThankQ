<script setup lang="ts">
import { RouterView } from 'vue-router'
import BaseDock from './components/Common/BaseDock/BaseDock.vue';
import { useGuest } from './composables/useGuest';
import { useUserToken } from './composables/useUserToken';
import GlobalHeader from './components/Global/GlobalHeader/GlobalHeader.vue';
import GlobalDialogOpener from './components/Global/GlobalDialogOpener/GlobalDialogOpener.vue';
import { useDialog } from './composables/useDialog';
import { useTokenStore } from './stores/tokenStore';
const { reloadGuest, errorMessage } = useGuest();
const { open } = useDialog();

const getToken = useUserToken();
const route = useRoute();
const tokenStore = useTokenStore();

const token = computed(() => {
  return getToken();
})

onMounted(async () => {
  await until(token).toBeTruthy();
  await reloadGuest(token.value);
  tokenStore.setToken(token.value);
})

watch(errorMessage, (newErrorMessage) => {
  if (newErrorMessage) {
    open('AlertDialog', {
      title: 'エラーが発生しました',
      body: newErrorMessage,
    })
  }
});
</script>

<template>
  <main
    class="h-dvh bg-base-100 flex flex-col"
    :class="{
      'pb-16': token && route.name !== 'home'
    }"
  >
    <GlobalHeader
      v-if="route.name !== 'home'"
      :store-token="tokenStore.token"
    />
    <GlobalDialogOpener />
    <RouterView />
    <BaseDock
      v-if="token && route.name !== 'home'"
      :token
    />
  </main>
</template>
