import type { Guest } from "@/models/guest";
import { createAPIUrl, myFetcher, type ResponseType } from "@/utils/myFetcher";

export const getGuest = async (token: string): Promise<ResponseType<Guest>> => {
  const url = createAPIUrl(`api/guests/${token}`)
  return await myFetcher(url, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    }
  })
}
