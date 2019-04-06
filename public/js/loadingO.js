function toView($id){
    $id = $id?$id:"theForm";
    $("#"+$id).find("[name!='']").each(function(){
        var attr = $(this).attr("name");
        var val = $(this).val()==""?"Belum diisi":$(this).val();
        var template = "<label>{{value}}</label>";
        if (typeof attr !== typeof undefined && attr !== false) {
            if($(this).attr("type")=="password"||$(this).attr("type")=="hidden"||$(this).css("display")=="none"){
                $(this).remove();
            }else{
                val = $(this).prop("tagName").toLowerCase()=="select"?$(this).find(":selected").text().trim():val;
                $(this).parent().find("label").eq(0).css({display:"block"});
                template = template.replace("{{value}}",val);
                template = $(template);
                $(this).parent().append(template);
                $(this).hide();
            }
        }
    })
    $("#"+$id).find("button").each(function(){
        var attr = $(this).attr("type");
        if(typeof(attr)!="undefined"||attr=='submit'){
            $(this).remove();
        }
        // if (typeof attr !== typeof undefined && attr !== false) {
        //     if($(this).attr("type")=="password"||$(this).attr("type")=="hidden"||$(this).css("display")=="none"){
        //         $(this).remove();
        //     }else{
        //         val = $(this).prop("tagName").toLowerCase()=="select"?$(this).find(":selected").text().trim():val;
        //         $(this).parent().find("label").eq(0).css({display:"block"});
        //         template = template.replace("{{value}}",val);
        //         template = $(template);
        //         $(this).parent().append(template);
        //         $(this).hide();
        //     }
        // }
    })
}
function disableInput($id){
$id = $id?$id:"theForm";
$("#"+$id).find("[name!=\'\']").each(function(){
    var attr = $(this).attr("name");
    if (typeof attr !== typeof undefined && attr !== false) {
        if($(this).attr("type")=="hidden"&&$(this).attr("type")=="password"){
            $(this).remove();
        }else{
            $(this).prop("disabled",true);
            $(this).prop("readonly",true);
        }
    }
})
}
  
function addLoading(string) {
    var style = "<style id='loadinganimationO'>";
    style += ".sk-circle {";
    style += "margin: 50vh auto;";
    style += "width: 40px;";
    style += "height: 40px;";
    style += "position: relative;";
    style += "}";
    style += ".sk-circle .sk-child {";
    style += "width: 100%;";
    style += "height: 100%;";
    style += "position: absolute;";
    style += "left: 0;";
    style += "top: 0;";
    style += "}";
    style += ".sk-circle .sk-child:before {";
    style += "content: '';";
    style += "display: block;";
    style += "margin: 0 auto;";
    style += "width: 15%;";
    style += "height: 15%;";
    style += "background-color: #2ba3ff;";
    style += "border-radius: 100%;";
    style += "-webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;";
    style += "animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;";
    style += "}";
    style += ".sk-circle .sk-circle2 {";
    style += "-webkit-transform: rotate(30deg);";
    style += "-ms-transform: rotate(30deg);";
    style += "transform: rotate(30deg); }";
    style += ".sk-circle .sk-circle3 {";
    style += "-webkit-transform: rotate(60deg);";
    style += "-ms-transform: rotate(60deg);";
    style += "transform: rotate(60deg); }";
    style += ".sk-circle .sk-circle4 {";
    style += "-webkit-transform: rotate(90deg);";
    style += "-ms-transform: rotate(90deg);";
    style += "transform: rotate(90deg); }";
    style += ".sk-circle .sk-circle5 {";
    style += "-webkit-transform: rotate(120deg);";
    style += "-ms-transform: rotate(120deg);";
    style += "transform: rotate(120deg); }";
    style += ".sk-circle .sk-circle6 {";
    style += "-webkit-transform: rotate(150deg);";
    style += "-ms-transform: rotate(150deg);";
    style += "transform: rotate(150deg); }";
    style += ".sk-circle .sk-circle7 {";
    style += "-webkit-transform: rotate(180deg);";
    style += "-ms-transform: rotate(180deg);";
    style += "transform: rotate(180deg); }";
    style += ".sk-circle .sk-circle8 {";
    style += "-webkit-transform: rotate(210deg);";
    style += "-ms-transform: rotate(210deg);";
    style += "transform: rotate(210deg); }";
    style += ".sk-circle .sk-circle9 {";
    style += "-webkit-transform: rotate(240deg);";
    style += "-ms-transform: rotate(240deg);";
    style += "transform: rotate(240deg); }";
    style += ".sk-circle .sk-circle10 {";
    style += "-webkit-transform: rotate(270deg);";
    style += "-ms-transform: rotate(270deg);";
    style += "transform: rotate(270deg); }";
    style += ".sk-circle .sk-circle11 {";
    style += "-webkit-transform: rotate(300deg);";
    style += "-ms-transform: rotate(300deg);";
    style += "transform: rotate(300deg); }";
    style += ".sk-circle .sk-circle12 {";
    style += "-webkit-transform: rotate(330deg);";
    style += "-ms-transform: rotate(330deg);";
    style += "transform: rotate(330deg); }";
    style += ".sk-circle .sk-circle2:before {";
    style += "-webkit-animation-delay: -1.1s;";
    style += "animation-delay: -1.1s; }";
    style += ".sk-circle .sk-circle3:before {";
    style += "-webkit-animation-delay: -1s;";
    style += "animation-delay: -1s; }";
    style += ".sk-circle .sk-circle4:before {";
    style += "-webkit-animation-delay: -0.9s;";
    style += "animation-delay: -0.9s; }";
    style += ".sk-circle .sk-circle5:before {";
    style += "-webkit-animation-delay: -0.8s;";
    style += "animation-delay: -0.8s; }";
    style += ".sk-circle .sk-circle6:before {";
    style += "-webkit-animation-delay: -0.7s;";
    style += "animation-delay: -0.7s; }";
    style += ".sk-circle .sk-circle7:before {";
    style += "-webkit-animation-delay: -0.6s;";
    style += "animation-delay: -0.6s; }";
    style += ".sk-circle .sk-circle8:before {";
    style += "-webkit-animation-delay: -0.5s;";
    style += "animation-delay: -0.5s; }";
    style += ".sk-circle .sk-circle9:before {";
    style += "-webkit-animation-delay: -0.4s;";
    style += "animation-delay: -0.4s; }";
    style += ".sk-circle .sk-circle10:before {";
    style += "-webkit-animation-delay: -0.3s;";
    style += "animation-delay: -0.3s; }";
    style += ".sk-circle .sk-circle11:before {";
    style += "-webkit-animation-delay: -0.2s;";
    style += "animation-delay: -0.2s; }";
    style += ".sk-circle .sk-circle12:before {";
    style += "-webkit-animation-delay: -0.1s;";
    style += "animation-delay: -0.1s; }";
    style += "@-webkit-keyframes sk-circleBounceDelay {";
    style += "0%, 80%, 100% {";
    style += "    -webkit-transform: scale(0);";
    style += "    transform: scale(0);";
    style += "} 40% {";
    style += "      -webkit-transform: scale(1);";
    style += "      transform: scale(1);";
    style += "  }";
    style += "}";
    style += "@keyframes sk-circleBounceDelay {";
    style += "0%, 80%, 100% {";
    style += "    -webkit-transform: scale(0);";
    style += "    transform: scale(0);";
    style += "} 40% {";
    style += "      -webkit-transform: scale(1);";
    style += "      transform: scale(1);";
    style += "  }";
    style += "}";
    style += "</style>";
    try{
        if($("loadinganimationO").length===0){
            $("head").append(style);
        }
    }catch(err){
        if($("loadinganimationO").size()===0){
            $("head").append(style);
        }
    }
    
    var a;
    if(string){
        a = string;
    }else{
        a = "Mohon Tunggu";
        string = string;
    }
    var content = "<div id='modal-loadingO' style='position:fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.78);z-index: 999999'>";
    content += "<div class='sk-circle'>";
    content += "<div class='sk-circle1 sk-child'></div>";
    content += "<div class='sk-circle2 sk-child'></div>";
    content += "<div class='sk-circle3 sk-child'></div>";
    content += "<div class='sk-circle4 sk-child'></div>";
    content += "<div class='sk-circle5 sk-child'></div>";
    content += "<div class='sk-circle6 sk-child'></div>";
    content += "<div class='sk-circle7 sk-child'></div>";
    content += "<div class='sk-circle8 sk-child'></div>";
    content += "<div class='sk-circle9 sk-child'></div>";
    content += "<div class='sk-circle10 sk-child'></div>";
    content += "<div class='sk-circle11 sk-child'></div>";
    content += "<div class='sk-circle12 sk-child'></div>";
    content += "</div>";
    content += "<label id='textAddLoadingO' style='color: white;position: absolute;top: 50%;'>"+a+"</label>";
    content += "</div>";
    if($("#modal-loadingO").length>0){
        a = $("#textAddLoadingO");
        a.text(string);
        a.css({"left":"calc(50% - "+(a.width()/2)+"px)"})
    }else{
        $("body").prepend(content);
        a = $("#textAddLoadingO");
        a.css({"left":"calc(50% - "+(a.width()/2)+"px)"})
    }
    
}

function addLoadingProgress(start,end) {
    if(typeof(start)=="undefined"){
        console.log("Paramater start is missing");
        return;
    }
    if(typeof(end)=="undefined"){
        console.log("Paramater end is missing");

        return;
    }
    var style = "<style id='loadinganimationO'>";
    style += ".sk-circle {";
    style += "margin: 50vh auto;";
    style += "width: 40px;";
    style += "height: 40px;";
    style += "position: relative;";
    style += "}";
    style += ".sk-circle .sk-child {";
    style += "width: 100%;";
    style += "height: 100%;";
    style += "position: absolute;";
    style += "left: 0;";
    style += "top: 0;";
    style += "}";
    style += ".sk-circle .sk-child:before {";
    style += "content: '';";
    style += "display: block;";
    style += "margin: 0 auto;";
    style += "width: 15%;";
    style += "height: 15%;";
    style += "background-color: #2ba3ff;";
    style += "border-radius: 100%;";
    style += "-webkit-animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;";
    style += "animation: sk-circleBounceDelay 1.2s infinite ease-in-out both;";
    style += "}";
    style += ".sk-circle .sk-circle2 {";
    style += "-webkit-transform: rotate(30deg);";
    style += "-ms-transform: rotate(30deg);";
    style += "transform: rotate(30deg); }";
    style += ".sk-circle .sk-circle3 {";
    style += "-webkit-transform: rotate(60deg);";
    style += "-ms-transform: rotate(60deg);";
    style += "transform: rotate(60deg); }";
    style += ".sk-circle .sk-circle4 {";
    style += "-webkit-transform: rotate(90deg);";
    style += "-ms-transform: rotate(90deg);";
    style += "transform: rotate(90deg); }";
    style += ".sk-circle .sk-circle5 {";
    style += "-webkit-transform: rotate(120deg);";
    style += "-ms-transform: rotate(120deg);";
    style += "transform: rotate(120deg); }";
    style += ".sk-circle .sk-circle6 {";
    style += "-webkit-transform: rotate(150deg);";
    style += "-ms-transform: rotate(150deg);";
    style += "transform: rotate(150deg); }";
    style += ".sk-circle .sk-circle7 {";
    style += "-webkit-transform: rotate(180deg);";
    style += "-ms-transform: rotate(180deg);";
    style += "transform: rotate(180deg); }";
    style += ".sk-circle .sk-circle8 {";
    style += "-webkit-transform: rotate(210deg);";
    style += "-ms-transform: rotate(210deg);";
    style += "transform: rotate(210deg); }";
    style += ".sk-circle .sk-circle9 {";
    style += "-webkit-transform: rotate(240deg);";
    style += "-ms-transform: rotate(240deg);";
    style += "transform: rotate(240deg); }";
    style += ".sk-circle .sk-circle10 {";
    style += "-webkit-transform: rotate(270deg);";
    style += "-ms-transform: rotate(270deg);";
    style += "transform: rotate(270deg); }";
    style += ".sk-circle .sk-circle11 {";
    style += "-webkit-transform: rotate(300deg);";
    style += "-ms-transform: rotate(300deg);";
    style += "transform: rotate(300deg); }";
    style += ".sk-circle .sk-circle12 {";
    style += "-webkit-transform: rotate(330deg);";
    style += "-ms-transform: rotate(330deg);";
    style += "transform: rotate(330deg); }";
    style += ".sk-circle .sk-circle2:before {";
    style += "-webkit-animation-delay: -1.1s;";
    style += "animation-delay: -1.1s; }";
    style += ".sk-circle .sk-circle3:before {";
    style += "-webkit-animation-delay: -1s;";
    style += "animation-delay: -1s; }";
    style += ".sk-circle .sk-circle4:before {";
    style += "-webkit-animation-delay: -0.9s;";
    style += "animation-delay: -0.9s; }";
    style += ".sk-circle .sk-circle5:before {";
    style += "-webkit-animation-delay: -0.8s;";
    style += "animation-delay: -0.8s; }";
    style += ".sk-circle .sk-circle6:before {";
    style += "-webkit-animation-delay: -0.7s;";
    style += "animation-delay: -0.7s; }";
    style += ".sk-circle .sk-circle7:before {";
    style += "-webkit-animation-delay: -0.6s;";
    style += "animation-delay: -0.6s; }";
    style += ".sk-circle .sk-circle8:before {";
    style += "-webkit-animation-delay: -0.5s;";
    style += "animation-delay: -0.5s; }";
    style += ".sk-circle .sk-circle9:before {";
    style += "-webkit-animation-delay: -0.4s;";
    style += "animation-delay: -0.4s; }";
    style += ".sk-circle .sk-circle10:before {";
    style += "-webkit-animation-delay: -0.3s;";
    style += "animation-delay: -0.3s; }";
    style += ".sk-circle .sk-circle11:before {";
    style += "-webkit-animation-delay: -0.2s;";
    style += "animation-delay: -0.2s; }";
    style += ".sk-circle .sk-circle12:before {";
    style += "-webkit-animation-delay: -0.1s;";
    style += "animation-delay: -0.1s; }";
    style += "@-webkit-keyframes sk-circleBounceDelay {";
    style += "0%, 80%, 100% {";
    style += "    -webkit-transform: scale(0);";
    style += "    transform: scale(0);";
    style += "} 40% {";
    style += "      -webkit-transform: scale(1);";
    style += "      transform: scale(1);";
    style += "  }";
    style += "}";
    style += "@keyframes sk-circleBounceDelay {";
    style += "0%, 80%, 100% {";
    style += "    -webkit-transform: scale(0);";
    style += "    transform: scale(0);";
    style += "} 40% {";
    style += "      -webkit-transform: scale(1);";
    style += "      transform: scale(1);";
    style += "  }";
    style += "}";
    style += "</style>";
    try{
        if($("#loadinganimationO").length===0){
            $("head").append(style);
        }
    }catch(err){
        if($("#loadinganimationO").size()===0){
            $("head").append(style);
        }
    }

    var a = parseInt(start)/parseInt(end);
    a = a * 100;
    
    // var a;
    // if(string===false){
    //     a = "Mohon Tunggu";
    // }else{
    //     a = string;
    // }
    var modal = document.querySelector("#modal-loadingO");
    if(modal!=null){
        modal.getElementsByTagName("div")[0].getElementsByTagName("div")[0].style.width=a+"%";
        modal.getElementsByTagName("div")[0].getElementsByTagName("div")[1].innerText=a+"%";
    }else{
        var content = "<div id='modal-loadingO' style='position:fixed;width: 100%;height: 100%;background: rgba(0,0,0,0.78);z-index: 999999'>";
        content += "<div style='position:relative;margin: auto;margin-top: calc(50% - 100px);height: 50px;background: white;border: 1px solid black;border-radius: 15px;width: 80%;text-align: center;'>";
    
        content += "<div style='background: #23af9b;width: "+a+"%;border-radius: 15px;height: 100%;'>";
        content += "</div>";
        content += "<div style='position:absolute'>";
        content += a+"%";
        content += "</div>";
    
        content += "</div>";
        $("body").prepend(content);
        a = $("#modal-loadingO").find("label").eq(0);
        a.css({"left":"calc(50% - "+(a.width()/2)+"px)"})
    }
    
}

function removeLoading() {
    $("#loadinganimationO").remove();
    $("#modal-loadingO").remove();
}