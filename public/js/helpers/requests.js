import {
    POMODORO_URL,
} from "./config.js";
import POST, { DELETE, PUT, GET } from "./http.js";



export async function getSettings() {
    return GET(`${POMODORO_URL}`);
}

export async function editSettings() {
    return PUT(`${POMODORO_URL}`);
}

