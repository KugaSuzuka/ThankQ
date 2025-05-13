import { Quiz } from "@/models/quiz";
import { getQuizzes } from "@/services/getQuizzes";
import { useQuizStore } from "@/stores/quizStore";

type StatusType = 'done' | 'answering'

export function useQuiz() {
  const store = useQuizStore()
  const _isLoading = ref(false)
  const _errorMessage = ref('');
  const storage = useStorage<{
    status: StatusType
    quiz: Quiz[]
  }>('thankQ/quiz-answer', {
    status: 'answering',
    quiz: [],
  })

  return {
    isLoading: computed(() => {
      return _isLoading.value
    }),
    reloadQuiz: async () => {
      if (store.quizzes.length > 0) return;
      if (storage.value.quiz.length > 0) {
        store.setQuizzes(storage.value.quiz);
        return
      }

      try {
        const response = await getQuizzes();
        store.setQuizzes(response.data.map((item) => {
          return new Quiz(item);
        }));
      } catch (error) {
        const _error = error as Error
        _errorMessage.value = _error.message;
      }
    },
    errorMessage: computed(() => {
      return _errorMessage.value
    }),
    saveToStorage: () => {
      storage.value.quiz = store.quizzes;
    },
    saveStatusToStorage: (status: StatusType) => {
      storage.value.status = status
    },
    status: computed(() => {
      return storage.value.status;
    })
  }
}
