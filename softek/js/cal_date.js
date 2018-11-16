function calculate_date(sdate,duration) {
    var c_day = parseInt(sdate.substr(0,2));
    var c_month = parseInt(sdate.substr(3,2));
    var c_year = parseInt(sdate.substr(6,4));
    var c_duration = parseInt(duration);
    var e_day = c_day;
    var e_month = c_month;
    var e_year = c_year;
    var i = 0;
    for (i = 0; i<c_duration; i++){
    	if(e_month < 12){
        	e_month += 1;
        }
        else if(e_month >= 12){
        	e_year += 1;
            e_month = 1;
        }
    }

    e_day = e_day - 1;
    
    if(e_day == 0){
		e_day = 9873;
		e_month = e_month - 1;
		if(e_month == 0){
			e_month = 12;
			e_year = e_year - 1;
		}
    }
	
    if (e_day == 9873){
		if(e_month == 2){
			var ly = leapYear(e_year);
			if (ly){
				e_day = 29;
		}
		else{
			e_day = 28;
		}
	}
	else {
		switch(e_month){
			case 1: e_day = 31;
				break;
			case 3: e_day = 31;
				break;
			case 4: e_day = 30;
				break;
			case 5: e_day = 31;
				break;
			case 6: e_day = 30;
				break;
			case 7: e_day = 31;
				break;
			case 8: e_day = 31;
				break;
			case 9: e_day = 30;
				break;
			case 10:e_day = 31;
				break;
			case 11:e_day = 30;
				break;
			case 12:e_day = 31;
				break;
		}
	}
    }
    if(e_day < 10){
	var edate = "0"+e_day;
    }
    else{
	var edate = ""+e_day;
    }

    if(e_month < 10)
	edate = edate+"-0"+e_month+"-"+e_year;
    else
	edate = edate+"-"+e_month+"-"+e_year;		
	
		
    return(edate);
}

function leapYear(year)
{
  return ((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0);
}