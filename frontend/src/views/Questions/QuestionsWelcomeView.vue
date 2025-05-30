<script setup lang="ts">
import BaseBtn from '@/components/Common/BaseBtn/BaseBtn.vue';
import BaseCenter from '@/components/Common/BaseCenter/BaseCenter.vue';
import BaseHeading from '@/components/Common/BaseHeading/BaseHeading.vue';
import BaseSection from '@/components/Common/BaseSection.vue';
import BaseText from '@/components/Common/BaseText/BaseText.vue';
import { useQuiz } from '@/composables/useQuiz';
import { getImagePath } from '@/utils/assetsPath';

const { status } = useQuiz();
</script>

<template>
  <BaseSection
    v-motion-pop-visible
    class="h-full p-6 flex flex-col gap-4"
    :duration="500"
  >
    <div class="flex flex-col align-center flex-grow-1 justify-center gap-2">
      <BaseCenter
        class="items-center h-61"
        component="div"
      >
        <img
          alt="クイズを連想させる画像"
          :src="getImagePath('welcomeImage')"
        >
      </BaseCenter>

      <div>
        <BaseHeading
          class="text-center py-5"
          tag="h1"
        >
          クイズターイム！
        </BaseHeading>
        <BaseCenter component="div" class="items-center">
          <BaseText
            class="w-fit"
            v-motion
            :delay="100"
            :duration="1000"
            :enter="{ opacity: 1, y: 0, scale: 1 }"
            :initial="{ opacity: 0, y: 100 }"
            :variants="{ custom: { scale: 2 } }"
          >
            新郎新婦に関するクイズを出題します！<br>
            上位の方にはプレゼントを用意しています☺️<br>
            結果は披露宴の後半に発表！！<br>
            お早めのご回答をお願いします😊
          </BaseText>
        </BaseCenter>
      </div>
    </div>

    <BaseBtn
      v-if="status !== 'done'"
      v-motion
      color="primary"
      size="xl"
      @click="$router.push({name: 'questionAnswerPage', params: {
        id: 1
      }})"
    >
      クイズに答える！
    </BaseBtn>
    <BaseBtn
      v-else
      color="primary"
      size="xl"
      @click="$router.push({name: 'questionConfirmPage'})"
    >
     自分の回答を見る
    </BaseBtn>
  </BaseSection>
</template>

