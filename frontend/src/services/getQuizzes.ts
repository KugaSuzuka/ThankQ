import type { QuizResponseType } from "@/models/quiz";
import { myFetcher, type ResponseType } from "@/utils/myFetcher";

export const getQuizzes = async (): Promise<ResponseType<QuizResponseType[]>> => {
  return await myFetcher(`http://localhost:80/api/quizzes/1`, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    }
  })
}
