import type { ThankQColorType } from "@/themes/color";
import type { ThankQSizeType } from "@/themes/size";

export interface BaseBtnProps {
  size: ThankQSizeType,
  color?: ThankQColorType,
  variant?: BaseBtnVariantType
  behavior?: BaseBtnBehaviorType
  loading?: boolean;
};

export type BaseBtnVariantType = 'outline'
| 'dash'
| 'soft'
| 'link'
| 'active'

export type BaseBtnBehaviorType = 'wide'
| 'block'
| 'square'
| 'circle'
