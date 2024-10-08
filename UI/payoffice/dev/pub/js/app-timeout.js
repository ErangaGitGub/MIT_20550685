// $(document).ready(function() {   

//Session TimeOut
var timer = 0;

function set_interval(timeInSeconds) {

    timeInMiliseconds = timeInSeconds * 1000;

    // the interval 'timer' is set as soon as the page loads
    timer = setInterval("auto_logout()", timeInMiliseconds);
    // the figure '10000' above indicates how many milliseconds the timer be set to.
    // Eg: to set it to 5 mins, calculate 5min = 5x60 = 300 sec = 300,000 millisec.
    // So set it to 300000
}

function reset_interval(timeInSeconds) {
    //resets the timer. The timer is reset on each of the below events:
    // 1. mousemove   2. mouseclick   3. key press 4. scroliing
    //first step: clear the existing timer

    timeInMiliseconds = timeInSeconds * 1000;

    if (timer != 0) {
        clearInterval(timer);
        timer = 0;
        // second step: implement the timer again
        timer = setInterval("auto_logout()", timeInMiliseconds);
        // completed the reset of the timer
    }
}

function auto_logout() {
    // this function will redirect the user to the logout script
    window.location = "auth/logout";
}

// });