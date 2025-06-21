<script setup lang="ts">
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseSection from '@/components/Common/BaseSection/BaseSection.vue';
import BaseStack from '@/components/Common/BaseStack/BaseStack.vue';
import BaseText from '@/components/Common/BaseText/BaseText.vue';
import InvaderGame from '@/components/InvaderGame/InvaderGame.vue';
import { useTokenStore } from '@/stores/tokenStore';

const router = useRouter()
const store = useTokenStore()

const hasToken = computed(() => {
  return !!store.token
})

async function onClick() {
  await router.push({
    name: 'messagePage',
    params: {
      token: store.token,
    }
  })
}
</script>

<template>
  <BaseSection>
    <BaseStack
      class="items-center h-full"
      component="div"
      gap="xl"
    >
      <BaseStack
        class="items-center"
        component="div"
        gap="md"
      >
        <BaseHeading
          tag="h1"
        >
          ごめんなさい！
        </BaseHeading>

        <BaseText>
          お探しのページは見つからなかったようです。
          <span v-if="!hasToken"><br>再度QRコードを読み込んでみてください！</span>
        </BaseText>
        <BaseBtn
          v-if="hasToken"
          behavior="block"
          color="primary"
          size="sm"
          variant="outline"
          @click="onClick"
        >
          新郎・新婦からのメッセージページに戻る
        </BaseBtn>
      </BaseStack>

      <InvaderGame />
    </BaseStack>
  </BaseSection>
</template>
