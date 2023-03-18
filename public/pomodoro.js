let intervalId;
let isBreak = false;

function getFocusMinutes(){
    return document.getElementById("focus-minutes").value.padStart(2,0);
}


function getBreakMinutes(){
    return document.getElementById("break-minutes").value.padStart(2,0);
}

function getLongBreakMinutes(){
    return document.getElementById("long-break-minutes").value.padStart(2,0);
}

function getBeforeLongBreak(){
    return document.getElementById("before-long-break").value;
}

function getFocusTime(){
    let minutes = getFocusMinutes();
    return `${minutes}:00`;
}

function getBreakTime(){
    let minutes = getBreakMinutes();
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

    if(isBreak){
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
    // cambiar el modo del contador
    isBreak = !isBreak;

    // usar el tiempo de foco o de descanso según el modo
    if (isBreak) {

      count.textContent = getBreakTime();
    } else {
      count.textContent = getFocusTime();
    }
    changePomodoroButton();
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

resetContainer = document.getElementById("pomodoro-reset");
resetContainer.addEventListener("click",resetCountdown);

function settingsButtonEvent(){
    element = document.getElementById("settings");
    if (element.classList.contains("settings-active")) {
        element.classList.remove("settings-active");
        element.classList.add("settings-desactive");
    } else {
        element.classList.remove("settings-desactive");

        element.classList.add("settings-active");
    }
}
settingsButton = document.getElementById("settings-button");
settingsButton.addEventListener("click",settingsButtonEvent);


focusMinutesInput = document.getElementById("focus-minutes");

focusMinutesInput.addEventListener("change",resetCountdown);
