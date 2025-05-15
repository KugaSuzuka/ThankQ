import type { Guest } from "@/models/guest";
import { myFetcher, type ResponseType } from "@/utils/myFetcher";

export const getGuest = async (token: string): Promise<ResponseType<Guest>> => {
  return await myFetcher(`http://localhost:80/api/guests/${token}`, {
    headers: {
      Accept: 'application/json',
      'Content-Type': 'application/json',
    }
  })
}
