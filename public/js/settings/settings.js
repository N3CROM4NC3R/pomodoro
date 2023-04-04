
import {getSettings,editSettings} from "/js/helpers/requests.js";

let isLogged = document.getElementById("is-logged");

if(isLogged){
    let settingsContainer = document.getElementById("settings");
    console.log(settingsContainer);

    let button = document.getElementById("save-configuration");

    // button.addEventListener("click",saveConfiguration);
    let data = await getSettings();
    console.log(data);

}


