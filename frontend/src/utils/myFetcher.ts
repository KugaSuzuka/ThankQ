export interface ResponseType<T> {
  data: T
}

export const myFetcher = async (
  resource: RequestInfo,
  init?: RequestInit,
  // eslint-disable-next-line @typescript-eslint/no-explicit-any
): Promise<any> => {
  const res = await fetch(resource, init)

  if (!res.ok) {
    const errorRes = await res.json()
    const error = new Error(
      errorRes.message ?? 'APIリクエスト中にエラーが発生しました',
    )

    throw error
  }

  return res.json()
}

export const createAPIUrl = (path: string) => {
  if (import.meta.env.PROD) {
    return `https://thankq-wedding.com/${path}`
  }

  return `http://localhost:80/${path}`;
}
