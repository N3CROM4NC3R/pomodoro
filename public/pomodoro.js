let intervalId;

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
    resetCountdown();
  } else {
    countNumber = subtractOneSecond(countNumber);
    count.textContent = countNumber;
  }
}

function resetCountdown() {
  const count = document.getElementById("pomodoro-count");
  count.textContent = "25:00";
  stopCountdown();
  const button = document.querySelector("#pomodoro-button .fa-solid");
  if (button.classList.contains("fa-pause")) {
    button.classList.remove("fa-pause");
    button.classList.add("fa-play");
  }
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

function handleButtonClick() {
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
buttonContainer.addEventListener("click", handleButtonClick);

resetContainer = document.getElementById("pomodoro-reset");
resetContainer.addEventListener("click",resetCountdown);

