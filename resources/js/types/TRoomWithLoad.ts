import {TRoomLoad} from "@/types/TRoomLoad";
import {TRoom} from "@/types/TRoom";

export type TRoomWithLoad = TRoom & {
    load: TRoomLoad[],
}
