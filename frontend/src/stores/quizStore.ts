import { defineStore } from 'pinia'
import type { Quiz } from '@/models/quiz';

export const useQuizStore = defineStore('quiz', () => {
  const quizzes = ref<Quiz[]>([]);
  function setQuizzes(_quizzes: Quiz[]) {
    quizzes.value = _quizzes
  }

  function findIndexById(id: number) {
    return quizzes.value.findIndex((quiz) => {
      return quiz.id === id
    });
  }

  function findById(id: number) {
    return quizzes.value.find((quiz) => {
      return quiz.id === id
    }) ?? null;
  }

  function findNextQuiz(id: number) {
    const index = findIndexById(id);
    const nextIndex = index + 1;

    if (index >= 0) {
      return quizzes.value[nextIndex] ?? null;
    }

    return null
  }

  function findPrevQuiz(id: number) {
    const index = findIndexById(id);
    const prevIndex = index - 1;

    if (index > 0) {
      return quizzes.value[prevIndex] ?? null;
    }

    return null
  }

  return {
    setQuizzes,
    quizzes,
    findById,
    findNextQuiz,
    findPrevQuiz,
    findIndexById,
  };
})
