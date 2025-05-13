export interface GuestPhotoType {
  id: number,
  photo_path: string
}

export interface MessageType {
  name: string,
  message: string
}

export class Guest {
  id: number
  name: string
  guest_photos: GuestPhotoType[]
  messages: MessageType[]

  constructor(props: {
    id: number,
    name: string,
    guestPhotos: GuestPhotoType[],
    messages: MessageType[]
  }) {
    this.id = props.id;
    this.name = props.name;
    this.guest_photos = props.guestPhotos
    this.messages = props.messages
  }
}
