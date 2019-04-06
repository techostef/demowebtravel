    function inttomoney(data,$res){
        if(typeof $res=="undefined"){
            $res='';
        }

        if(data===''){
            return 0;
        }
        var d = data.toString();
        if(d.indexOf(".")>=0){
            if(d.indexOf(",")>=0){
                n = d.indexOf(",");
                var g = d.substr(n, d.length);
                d = data.substr(0, n);
            }
            
            var b = d.split('.');
            var i = b.length;
            var c  = 0;
            var check = 0;

            for(c=0;c<i;c++){
                if(b[c].length>3){
                    check = 1;
                }
            }
            if(check==0){
                return data;
            }
        }
        
        var n = '';
        var temp = '';
        data = data.toString();
        data = data.replace('.',',');
        if(data.indexOf(",")>=0){
            n = data.indexOf(",");
            data = data.replace(/,/g, '.');
            data = parseFloat(data);
            data = data.toFixed(2);
            temp = data.substr(n, data.length);
            data = data.substr(0, n);
        }
        
        data = data.replace(/[^\d,-]/g, '');
        
        var cut = 3;

        if(data.length>3){
            var length = data.length;
            temp = temp.replace('.', ',');
            if($res===''){
                $res = data.substr(length-cut, cut)+""+temp;
            }else{
                $res = data.substr(length-cut, cut)+"."+$res+""+temp;
            }
            data = data.substr(0, length-cut);
            return inttomoney(data,$res);
        }else{
            temp = temp.replace('.', ',');
            if($res.length>=3){
                return data+"."+$res+""+temp;
            }else{
                return data+""+$res+""+temp;
            }
        }
    }
    function removeMask(data){
        if(data===''){
            data = 0;
        }
        data = data.toString();
        data = data.replace(/\./g,'');

        data = data.replace(',','.');
        return parseFloat(data);
    }