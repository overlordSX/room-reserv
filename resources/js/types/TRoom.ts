import {TRoomLoad} from "@/types/TRoomLoad";

export type TRoom = {
    id: number,
    hotelId: number,
    name: string,
    photoUrl: string | null,
    price: number,
    square: number,
    countOfRooms: number,
    countOfBeds: number,
    floor: number,
    load?: TRoomLoad[],
}
