import type { QuizResponseType } from "@/models/quiz";
import { createAPIUrl, myFetcher, type ResponseType } from "@/utils/myFetcher";

export const getQuizzes = async (): Promise<ResponseType<QuizResponseType[]>> => {
  const url = createAPIUrl('api/quizzes/1')
  return await myFetcher(url, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    }
  })
}
