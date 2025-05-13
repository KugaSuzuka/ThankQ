<script setup lang="ts">
import type { GlobalHeaderProps } from './Type';

const props = defineProps<GlobalHeaderProps>();
const router = useRouter();
const route = useRoute();

const token = computed(() => {
  return route.params.token ?? props.storeToken;
})

async function onHome() {
  if (!token.value) return

  await router.push({
    name: 'home',
    params: {
      token: token.value
    }
  })
}
</script>

<template>
  <header class="navbar bg-base-100 shadow-sm z-1">
    <a
      class="btn btn-ghost text-xl"
      @click="onHome"
    >
      ThankQ
    </a>
  </header>
</template>
