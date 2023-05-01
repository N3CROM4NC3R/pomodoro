import {getDailyStats,getDailySummaryData} from "/js/helpers/requests.js";
import {getDayHours} from "/js/helpers/utils.js";

let chart = null;
// Tranform this app to react... it's better.

async function getStats(){
    let data = await getDailyStats();

    return data;
}

export async function showStatistics(){
    let stats = await getStats();
    let hourResult = stats.map((object)=>{return {"focus_time":object.focus_time,"start_time":object.created_at}});
    let pomodoroData = [];
    let finalData = [];

    hourResult.map((object)=>{
        //Create the logic for the data of the chart
        let hour = object.start_time;
        hour = moment(hour).minute(0).second(0).format();
        if(hour in pomodoroData){
            pomodoroData[hour] += 1;
        }else{
            pomodoroData[hour] = 1;
        }

    });

    let pomodoroHours = Object.keys(pomodoroData);

    pomodoroHours.forEach((pomodoroHour) => {
        finalData.push({x:pomodoroHour,y:pomodoroData[pomodoroHour]});

    });

    createChart(finalData);

}

function createChart(finalData){

    let hours = getDayHours();
    const data = {
        labels: hours,
        datasets: [
            {
                fill:false,
                label: 'Pomodoros',
                data: finalData,
                borderColor: 'white',
                backgroundColor: 'white',
                lineTension: 0,
            },

        ]
    };


    const config = {
        type: 'bar',
        data: data,
        options: {
            fill:true,
            maintainAspectRatio:true,
            responsive: true,
            scales: {
                x: {
                    type:"time",
                    time:{
                        unit:"hour",
                        displayFormats:{
                            hour:'HH:mm'
                        },

                    },
                    backgroundColor:"transparent",
                    display: true,
                    title:{
                        text:"Hours",
                        color:"white",
                        display:true,
                    },
                    ticks:{
                        color:"white",
                        source:"labels",
                        stepSize:1
                    },
                    scaleLabel: {
                        display: true,
                        labelString: "Time",
                    },

                },
                y: {
                    ticks: {
                        beginAtZero: true,
                    },
                    display: true,
                    scaleLabel: {
                        display: true,
                        labelString: "Page Views",
                    }

                }
            }
        }
    };

    let ctx = document.getElementById("stats-canvas");
    chart = new Chart(ctx, config);

}

export function destroyStatistics(){
    chart.destroy();
}


export async function updateSummary(){

    let pomodorosElement = document.getElementById("stats-pomodoros");
    let hoursElement = document.getElementById("stats-time");

    let summaryData = await getDailySummaryData();
    pomodorosElement.textContent = summaryData.total_pomodoros;
    hoursElement.textContent = summaryData.total_hours;
}


