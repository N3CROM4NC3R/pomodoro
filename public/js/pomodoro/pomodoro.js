
import { getFocusTime, getBreakMinutes,getBeforeLongBreak,getLongBreakMinutes,subtractOneSecond } from "../helpers/utils.js";

const modes = {
    "FOCUS":0,
    "BREAK":1,
    "LONG_BREAK":2
};

let intervalId;
let currentMode = modes.FOCUS;
let cycleCount = 1;


function getBreakTime(){
    const minutes = isCycleLimit() ? getLongBreakMinutes() : getBreakMinutes();
    return `${minutes}:00`;
}
function openPomodoroButton(){
    const button = document.querySelector("#pomodoro-button .fa-solid");
    button.classList.remove("fa-pause");
    button.classList.add("fa-play");
}

function closePomodoroButton(){
    const button = document.querySelector("#pomodoro-button .fa-solid");
    button.classList.remove("fa-play");
    button.classList.add("fa-pause");
}

function startCountdown() {

    intervalId = setInterval(updateCount, 1000);
}

function isCycleLimit() {
    return cycleCount == getBeforeLongBreak();
}

function stopCountdown() {
    clearInterval(intervalId);
}

function updateCount() {
    const count = document.getElementById("pomodoro-count");
    let countNumber = count.textContent;
    if (countNumber === "00:00") {
        changeFocusOrBreak();

    } else {
        countNumber = subtractOneSecond(countNumber);
        count.textContent = countNumber;
    }
}

function changeFocusOrBreak(){
    stopCountdown();

    const count = document.getElementById("pomodoro-count");
    const mode = document.getElementById("pomodoro-mode");

    if(currentMode === modes.FOCUS){
        updateCycleCount();

        if(isCycleLimit()){
            currentMode = modes.LONG_BREAK;
            mode.textContent = "Long Break";
        }else{
            currentMode = modes.BREAK;
            mode.textContent = "Break";
        }
        count.textContent = getBreakTime();

    }else{
        if(currentMode == modes.LONG_BREAK){
            updateCycleCount();
        }
        currentMode = modes.FOCUS;
        mode.textContent = "Focus";
        count.textContent = getFocusTime();
    }
    notification();
    changePomodoroButton();
}

function notification(){
     const audio = new Audio("sound.ogg");
     audio.play();
}

function resetCountdown() {
    stopCountdown();

    const countContainer = document.getElementById("pomodoro-count");

    if(currentMode === modes.BREAK || currentMode === modes.LONG_BREAK ){
        countContainer.textContent = getBreakTime();
    }else{
        countContainer.textContent = getFocusTime();
    }

    const button = document.querySelector("#pomodoro-button .fa-solid");
    if (button.classList.contains("fa-pause")) {
        openPomodoroButton();
    }
}


function updateCycleCount() {

    if(isCycleLimit()){
        cycleCount = 1;
    }else{
        cycleCount++;
    }
    let cycleCountLimit = getBeforeLongBreak();
    let cycleCountText = `${cycleCount}/${cycleCountLimit}`;
    let cycleCountContainer = document.getElementById("pomodoro-cycle");
    cycleCountContainer.textContent = cycleCountText;
}



function changePomodoroButton() {
  const button = document.querySelector("#pomodoro-button .fa-solid");
  if (button.classList.contains("fa-play")) {

    startCountdown();
    closePomodoroButton();
} else {
    stopCountdown();
    openPomodoroButton();
  }
}

const buttonContainer = document.getElementById("pomodoro-button");
buttonContainer.addEventListener("click", changePomodoroButton);

let resetContainer = document.getElementById("pomodoro-reset");
resetContainer.addEventListener("click",resetCountdown);

function settingsButtonEvent(){
    let element = document.getElementById("settings");
    if (element.classList.contains("settings-active")) {
        element.classList.remove("settings-active");
        element.classList.add("settings-desactive");
    } else {
        element.classList.remove("settings-desactive");

        element.classList.add("settings-active");
    }
}
let settingsButton = document.getElementById("settings-button");
settingsButton.addEventListener("click",settingsButtonEvent);


let focusMinutesInput = document.getElementById("focus-minutes");
focusMinutesInput.addEventListener("change",resetCountdown);
