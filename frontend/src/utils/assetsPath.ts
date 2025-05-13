export function getImagePath(fileName: string, extension = 'png') {
    return new URL(`../assets/images/${fileName}.${extension}`, import.meta.url).href
}
