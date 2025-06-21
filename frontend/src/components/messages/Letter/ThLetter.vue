<script setup lang="ts">
import { getImagePath } from '@/utils/assetsPath';
import MessageRow from '../MessageRow/MessageRow.vue';
import MessageRowBody from '../MessageRow/MessageRowBody.vue';
import MessageRowFrom from '../MessageRow/MessageRowFrom.vue';
import MessageRowTitle from '../MessageRow/MessageRowTitle.vue';
import TypeWriter from '../TypeWriter/TypeWriter.vue';
import type { ThLetterProps } from './Type';
import BaseText from '@/components/Common/BaseText/BaseText.vue';

const props = defineProps<ThLetterProps>();
const emits = defineEmits<{
  draw:  [];
  start: [];
}>()
const DEFAULT_MAX_PER_LINE = 15;
const typingIndex = ref(-1);
const lines = ref<string[]>([])
const letterRef = useTemplateRef('letter');

const perLine = computed(() => {
  const CHAR_WIDTH = 20;
  const ROW_PADDING_X = 64
  const _width = letterRef.value?.offsetWidth
  if (_width) {
    return (_width - ROW_PADDING_X) / CHAR_WIDTH
  }
  return DEFAULT_MAX_PER_LINE;
})

const skeleton = computed(() => {
  if (props.isLoading) {
    return 'skeleton'
  }
  return ''
})

const isShowFrom = computed(() => {
  return typingIndex.value === lines.value.length
})

const dear = computed(() => {
  if (!props.to) {
    return '親愛なるあなた 様';
  }
  return `${props.to} 様`;
});

function onFinish() {
  _addIndex();
}

function isShowRow(index: number) {
  return typingIndex.value >= index
}

function _addIndex() {
  typingIndex.value = typingIndex.value + 1;
}

function init() {
  if (!props.to) {
    _addIndex();
  }

  emits('start')
}


const stop = watch(() => {
  return props.noAnimation
}, async (newNoAnimation) => {
  if (newNoAnimation) {
    await nextTick();
    emits('draw')
    stop()
  }
});

init();

onMounted(async () => {
  await until(perLine).toBeTruthy();

  props.body.split('\n').forEach(paragraph => {
    for (let i = 0; i < paragraph.length; i += perLine.value) {
      lines.value.push(paragraph.slice(i, i + perLine.value))
    }

    // 空行や末尾の改行も反映したい場合
    if (paragraph === '') {
      lines.value.push('')
    }
  })
})
</script>

<template>
  <div
    ref="letter"
    class="th-letter min-h-100"
    :class="[skeleton]"
  >
    <template v-if="!isLoading">
      <div class="relative">
        <img
          alt="切手"
          class="absolute right-0 top-1 opacity-20"
          :src="getImagePath('kitte_15536')"
          style="top: -16px;"
          width="90"
        >
      </div>
      <MessageRowTitle
        v-if="to"
        class="text-xl"
      >
        <span v-if="noAnimation">
          {{ dear }}
        </span>
        <TypeWriter
          v-else
          :text="dear"
          :type-speed="10"
          @finish="onFinish"
        />
      </MessageRowTitle>
      <MessageRowBody
        v-for="line, index in lines"
        :key="index"
      >
        <span
          v-if="noAnimation"
        >
          {{ line }}
        </span>
        <template v-else>
          <TypeWriter
            v-if="isShowRow(index)"
            :text="line"
            :type-speed="1"
            @finish="onFinish"
          />
        </template>
      </MessageRowBody>
      <MessageRowFrom>
        <BaseText v-if="noAnimation">
          {{ from }}
        </BaseText>
        <template v-else>
          <TypeWriter
            v-if="isShowFrom"
            :text="from"
            @finish="emits('draw')"
          />
        </template>
      </MessageRowFrom>
      <MessageRow />
    </template>
  </div>
</template>
