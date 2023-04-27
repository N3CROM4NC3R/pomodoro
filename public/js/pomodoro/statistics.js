import {getDailyStats} from "/js/helpers/requests.js";
import {getDayHours} from "/js/helpers/utils.js";

async function getStats(){
    let data = await getDailyStats();

    return data;
}



async function showStatistics(){
    let stats = await getStats();
    let hourResult = stats.map((object)=>{return {"focus_time":object.focus_time,"start_time":object.created_at}});
    let pomodoroData = [];
    let anotherArray = [];


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
        anotherArray.push({x:pomodoroHour,y:pomodoroData[pomodoroHour]});

    });

    let hours = getDayHours();
    const data = {
        labels: hours,
        datasets: [
            {
                fill:false,
                label: 'Pomodoros',
                data: anotherArray,
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
    new Chart(ctx, config);

}


showStatistics();
