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

function getFocusTime(){
    const minutes = getFocusMinutes();
    return `${minutes}:00`;
}

function getDayHours(){
    let hours = new Array();
    let today = new Date().toISOString().slice(0, 10);
    for(let i = 0;i<24;i++){
        let hour = `${i}`.padStart(2,"0");
        hours.push(`${today}T${hour}:00:00Z`);
    }

    return hours;
}

function updateCountTitle(count){
    document.title = `Pomo - ${count}`
}

export {updateCountTitle, getFocusTime, getFocusMinutes, getBreakMinutes,getBeforeLongBreak,getLongBreakMinutes, subtractOneSecond,getDayHours};
