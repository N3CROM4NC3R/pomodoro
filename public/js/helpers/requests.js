import {
    POMODORO_URL,
    DAILY_STATS_URL,
    STATS_URL
} from "./config.js";
import POST, { DELETE, PUT, GET } from "./https.js";



export async function getSettings() {
    return GET(`${POMODORO_URL}`);
}

export async function editSettings(data) {
    return PUT(`${POMODORO_URL}`,data);
}

export async function getDailyStats() {
    return GET(`${DAILY_STATS_URL}`);
}

export async function createStats(data){
    return POST(`${STATS_URL}`,data);
}

