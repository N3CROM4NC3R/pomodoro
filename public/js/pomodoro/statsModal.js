import { showStatistics, updateSummary, destroyStatistics} from "/js/pomodoro/statistics.js";

let modal = document.getElementById("stats-modal");

let statButton = document.getElementById("statistics-button");

statButton.addEventListener("click",showModal);



function showModal(){
    if (modal.classList.contains("statistics-active")) {
        modal.classList.remove("statistics-active");
        modal.classList.add("statistics-desactive");
        destroyStatistics();
    } else {
        showStatistics();
        updateSummary();
        modal.classList.remove("statistics-desactive");

        modal.classList.add("statistics-active");
    }
}
