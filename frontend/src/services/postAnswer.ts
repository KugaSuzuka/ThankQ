import type { QuizChoiceType } from "@/models/quiz";
import { myFetcher } from "@/utils/myFetcher";

export interface PostAnswerParamsType {
  quiz_choice_ids: QuizChoiceType['id'][],
  guest_id: number
}

export const postAnswer = async (params: PostAnswerParamsType): Promise<{
  result: boolean,
  message: string
}> => {
  return await myFetcher(`http://localhost:80/api/quiz-answers`, {
    method: 'POST',
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(params),
  })
}
