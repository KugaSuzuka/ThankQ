
// eslint-disable-next-line @typescript-eslint/consistent-type-definitions
export type QuizResponseType = {
  id: number,
  question: string
  quiz_choices: QuizChoiceType[]
  photo_path: string
  answer_id: QuizChoiceType['id'] | null
}

// eslint-disable-next-line @typescript-eslint/consistent-type-definitions
export type QuizChoiceType = {
  id: number,
  choice: string,
  created_at: string,
  updated_at: string
}

export class Quiz {
  id: number
  question: string
  quiz_choices: QuizChoiceType[]
  photo_path: string

  // 内部管理用
  answer_id: QuizChoiceType['id'] | null = null

  constructor(props: QuizResponseType) {
    this.id = props.id;
    this.question = props.question
    this.quiz_choices = props.quiz_choices
    this.photo_path = props.photo_path
    this.answer_id = props.answer_id
  }
}
