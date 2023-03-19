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


export {getFocusMinutes, getBreakMinutes,getBeforeLongBreak,getLongBreakMinutes};
