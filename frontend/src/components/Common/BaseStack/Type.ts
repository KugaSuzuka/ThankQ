import type { ThankQSizeType } from "@/themes/size"

export interface BaseStackProps {
  component: 'div' | 'ul' | 'section'
  gap?: ThankQSizeType
  col?: boolean
  grow?: boolean
};
