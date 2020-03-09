var udateTime = function() {
    let currentDate = new Date(),
        hours = currentDate.getHours(),
        minutes = currentDate.getMinutes(), 
        seconds = currentDate.getSeconds(),
        weekDay = currentDate.getDay(), 
        day = currentDate.getDay(), 
        month = currentDate.getMonth(), 
        year = currentDate.getFullYear();

    let meridian = "AM";
        
        if( hours > 12 ) 
            { 
                hours = currentDate.getHours() - 12; 
                meridian = "PM"
                if(hours < 10) hours = "0" + hours;   
            }
 
    /*const weekDays = [
        'Domingo',
        'Lunes',
        'Martes',
        'Miércoles',
        'Jueves',
        'Viernes',
        'Sabado'
    ];
 
    document.getElementById('weekDay').textContent = weekDays[weekDay];
    document.getElementById('day').textContent = day;
 
    const months = [
        'Enero',
        'Febrero',
        'Marzo',
        'Abril',
        'Mayo',
        'Junio',
        'Julio',
        'Agosto',
        'Septiembre',
        'Octubre',
        'Noviembre',
        'Diciembre'
    ];
 
    document.getElementById('month').textContent = months[month];
    document.getElementById('year').textContent = year; */
 
    
 
    if (minutes < 10) {
        minutes = "0" + minutes
    }
 
    if (seconds < 10) {
        seconds = "0" + seconds
    }

    let hora = hours+":"+minutes+":"+seconds;

    document.getElementById('clock').textContent = hora; 
    //document.getElementById('minutes').textContent = minutes;
    //document.getElementById('seconds').textContent = seconds; 
    document.getElementById('meridian').textContent = meridian; 
};
 
udateTime();
 
setInterval(udateTime, 1000);