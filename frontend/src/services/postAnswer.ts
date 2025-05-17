import type { QuizChoiceType } from "@/models/quiz";
import { createAPIUrl, myFetcher } from "@/utils/myFetcher";

export interface PostAnswerParamsType {
  quiz_choice_ids: QuizChoiceType['id'][],
  guest_id: number
}

export const postAnswer = async (params: PostAnswerParamsType): Promise<{
  result: boolean,
  message: string
}> => {
  const url = createAPIUrl('api/quiz-answers')
  return await myFetcher(url, {
    method: 'POST',
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(params),
  })
}
