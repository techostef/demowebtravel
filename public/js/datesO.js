function rangedates(date1,date2,type){
    if(typeof type=='undefined'){
        type='m';
    }
    switch(type){
        case 'd':
            type='day';
            break;
        case 'm':
            type='month';
            break;
        case 'y':
            type='year';
            break;
        default:
            type='month';
            break;
    }

    var startDate = moment(date1);
    var endDate = moment(date2);

    var result = [];

    if (endDate.isBefore(startDate)) {
        throw "End date must be greated than start date."
    }

    var currentDate = startDate.clone();

    while (currentDate.isBefore(endDate)) {
        result.push(currentDate.format("YYYY-MM-01"));
        currentDate.add(1, type);
    }
    return result.length-1;
}
function dayinmonth($month,$year){
    var $arr = [31,28,31,30,31,30,31,31,30,31,30,31];
    var $arr1 = [31,29,31,30,31,30,31,31,30,31,30,31];
    $year = parseInt($year);

    if(typeof $year!="undefined"){
        return $arr[$month-1];
    }else{
        if($year%4==0){
            return $arr1[$month-1];
        }else{
            return $arr[$month-1];
        }
    }
}

function validDate($date){
    var $arr = $date.split("-");
    var $y = parseInt($arr[0]);
    var $m = parseInt($arr[1]);
    var $d = parseInt($arr[2]);
    var $day = dayinmonth($m,$y);
    if($d>$day){
        return false;
    }else{
        return true;
    }
}

function plusmonth($date,$M){
    var $arr = $date.split("-");
    var $y = parseInt($arr[0]);
    var $m = parseInt($arr[1]);
    var $d = parseInt($arr[2]);
    var temp;
    $M = parseInt($M);
    $m = $m+$M;
    if($m>12){
        console.log($m);
        if($m%12==0){
            temp = parseInt($m/12);
            temp -=1;
        }else{
            temp = parseInt($m/12);
        }
        
        $y+=temp;
        if($m>(temp*12)){
            $m = $m - (temp*12);
        }
    }
    $date = $y+"-"+$m+"-"+$d;
    if(validDate($date)){
        if($m<10){
            $m = "0"+$m;
        }
        if($d<10){
            $d = "0"+$d;
        }
        $date = $y+"-"+$m+"-"+$d;
        return $date;
    }else{
        $d = dayinmonth($m,$y);
        if($m<10){
            $m = "0"+$m;
        }
        if($d<10){
            $d = "0"+$d;
        }
        return $date = $y+"-"+$m+"-"+$d;
    }
}

function addMonth(date,month){
    var arr = date.split("-");
    var y = parseInt(arr[0]);
    var m = parseInt(arr[1]);
    var d = parseInt(arr[2]);
    var temp ;
    month = parseInt(month);
    m = m + month;
    if(m>12){
        m = m - 12;
        y += 1;
    }
    if(m<10){
        m = "0"+m;
    }
    if(d<10){
        d = "0"+d;
    }
    return y+"-"+m+"-"+d;
}

function onlynumber(str){
    return str.replace(/[^\d.-]/g, '');
}