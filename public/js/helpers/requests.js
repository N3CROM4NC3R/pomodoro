import {
    POMODORO_URL,
} from "./config.js";
import POST, { DELETE, PUT, GET } from "./https.js";



export async function getSettings() {
    console.log("Hello");
    return GET(`${POMODORO_URL}`);
}

export async function editSettings(data) {
    return PUT(`${POMODORO_URL}`,data);
}

