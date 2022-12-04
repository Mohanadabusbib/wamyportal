const daysEl = document.getElementById('days'),
    hoursEl = document.getElementById('hours'),
    minsEl = document.getElementById('mins'),
    secondsEl = document.getElementById('seconds'),
    /* form = document.getElementById('form'),
    myDateEl = document.getElementById('myDate'), */
    newYears = '11 July 2021 08:30:00';
    
/* form.addEventListener('submit',(e) =>{
    e.preventDefault();
    const newYears = myDateEl.value;
    setInterval(countdown(newYears), 1000);
}) */
function countdown(myDate) {
    const newYearsDate = new Date(myDate),
        currentDate = new Date(),
        totalSeconds = (newYearsDate - currentDate) / 1000,
        days = Math.floor(totalSeconds / 3600 /24),
        hours = Math.floor(totalSeconds / 3600) % 24,
        minutes = Math.floor(totalSeconds / 60) % 60,
        seconds = Math.floor(totalSeconds) % 60;

    daysEl.innerHTML = formatTime(days);
    hoursEl.innerHTML = formatTime(hours);
    minsEl.innerHTML = formatTime(minutes);
    secondsEl.innerHTML = formatTime(seconds);
        

        
// Set the date we're counting down to
    /* const countDownDate = new Date("Jan 5, 2022 15:37:25").getTime();
    
    console.log(countDownDate); */
}

function formatTime(time) {
    return time < 10 ? (`0${time}`) : time;
}
/* countdown(); */

setInterval(countdown(newYears), 1000);
