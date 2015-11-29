/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


var StartCounter = function(endDate){
	// set the date we're counting down to
	var target_date = new Date(endDate).getTime();
	 
	// variables for time units
	var days, hours, minutes, seconds;
	 
	// get tag element
	var countdown = document.getElementById('countdown');
	 
	// update the tag with id "countdown" every 1 second
	setInterval(function () {
	 
		// find the amount of "seconds" between now and target
		var current_date = new Date().getTime();
		var seconds_left = (target_date - current_date) / 1000;
	 
		// do some time calculations
		days = parseInt(seconds_left / 86400);
		seconds_left = seconds_left % 86400;
		 
		hours = parseInt(seconds_left / 3600);
		seconds_left = seconds_left % 3600;
		
                // green #ccff66 #00cc33
		// red #cc3300
                minutes = parseInt(seconds_left / 60);
		seconds = parseInt(seconds_left % 60);
		 
		// format countdown string + set tag value
                if (seconds_left > 0)
                    if (seconds_left >= 600)
                        countdown.innerHTML = '<span  style="color: #cf6"><span class="days">' + days +  ' <b>Giorni</b></span> <span class="hours">' + hours + ' <b>Ore</b></span> <span class="minutes">'
		+ minutes + ' <b>Minuti</b></span> <span class="seconds">' + seconds + ' <b>Secondi</b></span></span>';
                       // countdown.innerHTML = '<span class="time" style="color: #cf6"> '+ hours + ':' + minutes +':' + seconds + ' </span>';  
                    else
                        countdown.innerHTML = '<span  style="color: #c30"><span class="days">' + days +  ' <b>Giorni</b></span> <span class="hours">' + hours + ' <b>Ore</b></span> <span class="minutes">'
		+ minutes + ' <b>Minuti</b></span> <span class="seconds">' + seconds + ' <b>Secondi</b></span></span>';
                       // countdown.innerHTML = '<span class="time" style="color: #c30"> '+ hours + ':' + minutes +':' + seconds + ' </span>'; 
                else 
                    countdown.innerHTML = '<span class="time" style="color: #c30"> Tempo Scaduto </span>';
	
        }, 1000);
}