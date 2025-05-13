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
    class="h-full p-6 flex flex-col gap-4"
  >
    <div class="flex flex-col align-center flex-grow-1 justify-center gap-2">
      <BaseCenter
        class="items-center"
        component="div"
      >
        <div>
          <img
            alt="クイズを連想させる画像"
            :src="getImagePath('welcomeImage')"
          >
        </div>
      </BaseCenter>

      <BaseHeading
        class="text-center py-5"
        tag="h1"
      >
        クイズを出題します！
      </BaseHeading>
      <BaseText>
        新郎新婦に関するクイズを出題します！<br>
        上位の方にはプレゼントを用意しています☺️<br>
        結果は披露宴の後半に発表します！！<br>
        お早めのご回答をお願いします😊
      </BaseText>
    </div>

    <BaseBtn
      v-if="status !== 'done'"
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
      回答を確認する
    </BaseBtn>
  </BaseSection>
</template>


