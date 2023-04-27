
import { getFocusTime } from "../helpers/utils.js";

import {getSettings,editSettings} from "/js/helpers/requests.js";

let isLogged = document.getElementById("is-logged");

if(isLogged){
    let settingsContainer = document.getElementById("settings");

    let button = document.getElementById("save-configuration");

    button.addEventListener("click",saveConfiguration);
    let data = await getSettings();

    function saveData(data){
        let focusInput = document.getElementById("focus-minutes");

        let breakInput = document.getElementById("break-minutes");

        let longBreakMinutes = document.getElementById("long-break-minutes");

        let pomodoro_count = document.getElementById("before-long-break");

        focusInput.value = data.focus_time;
        breakInput.value = data.break_time;
        longBreakMinutes.value = data.long_break_time;
        pomodoro_count.value = data.pomodoro_count;

        const count = document.getElementById("pomodoro-count");
        count.textContent = getFocusTime();
    }

    saveData(data);

    let saveButton = document.getElementById("save-configuration");
    saveButton.addEventListener("click", saveConfiguration);

    function saveConfiguration(){

        data = {
            "focus_time":document.getElementById("focus-minutes").value,
            "long_break_time":document.getElementById("long-break-minutes").value,
            "break_time":document.getElementById("break-minutes").value,
            "pomodoro_count":document.getElementById("before-long-break").value
        };

        editSettings(data);

        let element = document.getElementById("settings");
        if (element.classList.contains("settings-active")) {
            element.classList.remove("settings-active");
            element.classList.add("settings-desactive");
        } else {
            element.classList.remove("settings-desactive");

            element.classList.add("settings-active");
        }
    }



}


