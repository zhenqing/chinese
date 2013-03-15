    var currentnum = 1;
    var total       = 4;
    var settab = function(num){
        var setclass = "";
        var pastclass = "";
        if(num == 1)
            setclass = "current first";    
        else
            setclass = "current";    
        
        if ( currentnum ==  1)
            pastclass = "first";
        else    
            pastclass = "";
            
        $("#tabli"+num).attr("class",setclass);
        $("#tabli"+currentnum).attr("class",pastclass);
        $("#tabbox"+num).css("display","block");
        $("#tabbox"+currentnum).css("display","none");
        currentnum = num;
    }
    
    var settabplus = function(){
        if(currentnum < 4){
            var setnum =currentnum +1;
            settab(setnum);
        }else
            settab(1);            
    }

    var settabminus = function(){
        if(currentnum > 1){
            var setnum =currentnum - 1;
            settab(setnum);
        }else
            settab(4);            
    }
    
    
    