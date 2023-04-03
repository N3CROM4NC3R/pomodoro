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


export {getFocusMinutes, getBreakMinutes,getBeforeLongBreak,getLongBreakMinutes, subtractOneSecond};
