import type { ThankQSizeType } from "@/themes/size"

export interface BaseStackProps {
  component: 'div' | 'ul'
  gap?: ThankQSizeType
  col?: boolean
  grow?: boolean
};
