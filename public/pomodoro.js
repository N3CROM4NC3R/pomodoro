
import { getFocusMinutes, getBreakMinutes,getBeforeLongBreak,getLongBreakMinutes } from "./utils.js";

const modes = {
    "FOCUS":0,
    "BREAK":1,
    "LONG_BREAK":2
};


let intervalId;
let currentMode = modes["FOCUS"];
let cycleCount = 1; // añadir un contador de ciclos

function getFocusTime(){
    let minutes = getFocusMinutes();
    return `${minutes}:00`;
}

function getBreakTime(){
    let minutes;
    if (cycleCount == getBeforeLongBreak()) { // si se ha completado el número de ciclos antes del descanso largo
      minutes = getLongBreakMinutes(); // usar el tiempo de descanso largo
    } else {
      minutes = getBreakMinutes(); // usar el tiempo de descanso normal
    }
    return `${minutes}:00`;
}


function startCountdown() {
  intervalId = setInterval(updateCount, 1000);
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

function resetCountdown() {
    const count = document.getElementById("pomodoro-count");

    if(currentMode === modes["BREAK"] || currentMode === modes["LONG_BREAK"] ){
        count.textContent = getBreakTime();
    }else{
        count.textContent = getFocusTime();
    }

    stopCountdown();
    const button = document.querySelector("#pomodoro-button .fa-solid");
    if (button.classList.contains("fa-pause")) {
        button.classList.remove("fa-pause");
        button.classList.add("fa-play");
    }
}

function changeFocusOrBreak(){
    stopCountdown();

    const count = document.getElementById("pomodoro-count");
    const mode = document.getElementById("pomodoro-mode");
    const cycleCountLimit = getBeforeLongBreak();


    if(currentMode === modes["FOCUS"]){
        updateCycleCount();
        if(cycleCount == cycleCountLimit){
            currentMode = modes["LONG_BREAK"];
            mode.textContent = "Long Break";
        }else{
            mode.textContent = "Break"
            currentMode = modes["BREAK"];
        }
        count.textContent = getBreakTime();
    }else{
        if(currentMode == modes["LONG_BREAK"]){
            updateCycleCount();
        }
        currentMode = modes["FOCUS"];
        mode.textContent = "Focus";
        count.textContent = getFocusTime();
    }


    changePomodoroButton();
}

function updateCycleCount() {
    let cycleCountLimit = getBeforeLongBreak();

    if(cycleCount == cycleCountLimit){
        cycleCount = 1;
    }else{
        cycleCount++;
    }

    let cycleCountText = `${cycleCount}/${cycleCountLimit}`;
    let cycleCountContainer = document.getElementById("pomodoro-cycle");
    cycleCountContainer.textContent = cycleCountText;
}

function subtractOneSecond(time) {
  const [minutes, seconds] = time.split(":");
  const date = new Date();
  date.setMinutes(minutes);
  date.setSeconds(seconds);
  date.setSeconds(date.getSeconds() - 1);
  const newMinutes = date.getMinutes().toString().padStart(2, "0");
  const newSeconds = date.getSeconds().toString().padStart(2, "0");
  return `${newMinutes}:${newSeconds}`;
}

function changePomodoroButton() {
  const button = document.querySelector("#pomodoro-button .fa-solid");
  if (button.classList.contains("fa-play")) {
    startCountdown();
    button.classList.remove("fa-play");
    button.classList.add("fa-pause");
  } else {
    stopCountdown();
    button.classList.remove("fa-pause");
    button.classList.add("fa-play");
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
