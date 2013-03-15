//article counter
function article_counter(artid,maincat_id){
    xmlHttp=GetXmlHttpObject();
    var url="/article/article_counter_ct.php";
    url=url+"?id="+artid+"&maincat_id="+maincat_id;
    xmlHttp.open("GET",url,true);
    xmlHttp.send(null);        
}
//font size new
var bh_fontsize = new Array("10","12","14");
function setFontReSize(sz){
    if(sz == 10 || sz == 12 || sz == 14){
        document.getElementById("bodytext1").className= "fontresize" + sz;
         document.getElementById("bodytext2").className= "fontresize" + sz ;
         setCookie("IBTIMES_FONTSIZE_NEW", sz,1);
     }
}
$(document).ready(function(){
	
	$(".ic-textsize").click(function(){
			
			var namestr = $(this).attr('id');
			var namearr = namestr.split('-');
			
			$(".newsListBody p").css('font-size',namearr[1]+'px');
			
		});
});
function loadingFontReSize(){
    var sz = parseInt(getCookie("IBTIMES_FONTSIZE_NEW"));
    if(!sz)sz=10;
    document.getElementById("bodytext1").className= "fontresize" + sz;
    document.getElementById("bodytext2").className= "fontresize" + sz ;
}

function setCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
//print article
function POPprint(num,table,folder){
    window.open(folder+"/services/pop_print.htm?id="+num+"&tb="+table,"printing","toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=520,height=520 ,left = 100,top = 100");
}
function POPemail(num,table,folder){
    window.open(folder+"/services/pop_email.htm?artid="+num+"&tb="+table,"email","toolbar=0,scrollbars=auto,location=0,statusbar=0,menubar=0,resizable=0,width=585,height=670 ,left = 100,top = 100");
}

function popUp(URL, width, height) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, 'infoPage', 'toolbar=0,scrollbars=1,location=0,statusbar=0,menubar=0,resizable=0,width=' + width + ',height=' + height + ',left = 100,top = 0');");
}

//photo resize(like graph somthing)
var container_img;
function photos_realsize(Obj,val) { 
    if(!container_img){
        container_img = document.createElement("div");
        document.body.appendChild(container_img);
        container_img.className="artimg";
        container_img.style.position = "absolute";
        container_img.onclick = pimg_close;
    }else{ 
        container_img.innerHTML = '';
        container_img.style.display = "block";
    }
    container_img.style.left = (findPos(Obj)[0]-50)+"px";
    container_img.style.top  = (findPos(Obj)[1])+"px";
    container_img.innerHTML = "<img src='"+val+"' class='hand'>";
} 
function pimg_close(){
    container_img.style.display = "none";
}
 //new photo resize
 var img_orgsize;
 var img_newsize;
 function resizeImg(Obj,size) {
 img_orgsize=Obj.width;
 Obj.name = Obj.width;
 Obj.width=size;
 img_newsize=size;
 Obj.onclick = function(){
  if(!container_img){
   container_img = document.createElement("div");
   document.body.appendChild(container_img);
   container_img.className="artimg";
   container_img.style.position = "absolute";
   container_img.onclick = pimg_close;
  }else{ 
   container_img.innerHTML = '';
   container_img.style.display = "block";
  }
  container_img.style.left = (findPos(Obj)[0]+(img_newsize/2)-(Obj.name/2))+"px";
  container_img.style.top  = (findPos(Obj)[1])+"px";
  container_img.innerHTML = "<img src='"+Obj.src+"' class='hand'>"; 
 }
 }
 function findPos(obj) {
    var pos = new Array();
    pos[0] = pos[1] = 0;
    if (obj.offsetParent) {
        pos[0] = obj.offsetLeft
        pos[1] = obj.offsetTop
        while (obj = obj.offsetParent) {
            pos[0] += obj.offsetLeft
            pos[1] += obj.offsetTop
        }
    }    
    return pos;
}

var exURL     = escape("");
var exHed, exDek,http_host, keywords ="";
 function share_this(site,pal_name){
      exHed=encodeURIComponent(document.getElementById('title'+pal_name).value);
      exDek=encodeURIComponent(document.getElementById('sum'+pal_name).value);
      keywords=encodeURIComponent(document.getElementById('keywords'+pal_name).value);
      exURL=escape(document.getElementById('url'+pal_name).value);
      shareArticle(site,pal_name);
 }
var shareartcle = function(site){
    switch(site){
        case "twitter":
            OpenPop('http://twitter.com/home?status='+exHed+'+'+exURL,'twitter','toolbar=no,resizable=yes,scrollbars=yes,width=850,height=500');
            break; 
        case "digg":
            OpenPop('http://digg.com/remote-submit?phase=2&url='+exURL+'&title='+exHed+'&bodytext='+exDek,'digg','toolbar=no,resizable=yes,scrollbars=yes,width=850,height=500');
            break;        
        case "newsvine":
            OpenPop('http://www.newsvine.com/_wine/save?ver=2&popoff=0&aff=ibtimes&t=' + keywords + '&e=' + exDek + '&h=' + exHed + '&u=' + exURL, 'newsvine', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "delicious":
            OpenPop('http://del.icio.us/post?tags=test&v=4&noui&jump=close&url='+exURL+'&title='+exHed+'&notes='+exDek+'&tags='+keywords, 'delicious','toolbar=no,resizable=yes,scrollbars=yes,width=850,height=500');
            break;        
        case "facebook":
            OpenPop('http://www.facebook.com/sharer.php?u=' + exURL + '&t=' + exHed, 'facebook', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "stumbleupon":
            OpenPop('http://www.stumbleupon.com/submit?url=' + exURL + '&title=' + exHed, 'stumbleupon', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "yahoo":
            OpenPop('http://buzz.yahoo.com/submit?submitUrl=' + exURL + '&submitHeadline=' + exHed+ '&submitSummary=' + exDek, 'yahoo', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "myspace":
            OpenPop('http://www.myspace.com/Modules/PostTo/Pages/?u=' + exURL + '&t=' + exHed+ '&c=' + exDek, 'myspace', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "google":
            OpenPop('http://www.google.com/bookmarks/mark?op=add&bkmk=' + exURL + '&title=' + exHed+ '&annotation=' + exDek, 'google', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "reddit":
            OpenPop('http://www.reddit.com/submit?url=' + exURL + '&title=' + exHed, 'reddit', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;        
        case "linkedin":
            OpenPop('http://www.linkedin.com/shareArticle?mini=true&url=' + exURL + '&title=' + exHed+ '&summary=' + exDek, 'linkedin', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "technorati":
            OpenPop('http://technorati.com/faves/inistone?add=' + exURL, 'technorati', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "yahoobookmk":
            OpenPop('http://bookmarks.yahoo.com/toolbar/savebm?opener=tb&u=' + exURL+'&t='+ exHed, 'yahoobookmk', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "mixx":
            OpenPop('http://www.mixx.com/submit?page_url=' + exURL+'&t='+ exHed, 'mixx', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "yahoomyweb":
            OpenPop('http://myweb2.search.yahoo.com/myresults/bookmarklet?u=' + exURL+'&t='+ exHed, 'yahoomyweb', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "propeller":
            OpenPop('http://www.propeller.com/submit/?U=' + exURL+'&T='+ exHed, 'propeller', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "propeller":
            OpenPop('http://www.propeller.com/submit/?U=' + exURL+'&T='+ exHed, 'propeller', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "windowslive":
            OpenPop('https://favorites.live.com/quickadd.aspx?marklet=1&mkt=en-us&url=' + exURL+'&title='+ exHed+'&top=1', 'windowslive', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "friendfeed":
            OpenPop('http://friendfeed.com/share?url=' + exURL+'&title='+ exHed, 'friendfeed', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "furl":
            OpenPop('http://furl.net/storeIt.jsp?u=' + exURL+'&t='+ exHed, 'furl', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "xanga":
            OpenPop('http://www.xanga.com/private/editorx.aspx?u=' + exURL+'&t='+ exHed+'&s='+ exDek, 'xanga', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;
        case "blinklist":
            OpenPop('http://blinklist.com/index.php?Action=Blink/addblink.php&Url=' + exURL+'&Title='+ exHed, 'blinklist', 'toolbar=0,status=0,height=500,width=850,scrollbars=yes,resizable=yes');
            break;    }
}

function setFontReSize(sz){
    if(sz == 12 || sz == 14 || sz == 16){
        $(".newsListBody").css('font-size',sz+'px');
         
     }
}

function PopUp(URL, width, height,scroll) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, 'infoPage', 'toolbar=0,scrollbars='+scroll+',location=0,statusbar=0,menubar=0,resizable=0,width=' + width + ',height=' + height + ',left = 100,top = 0');");
}



function share_close(){
    document.getElementById("share_bx").style.display="none";
}
function OpenPop(url, name, params) {
    var win = window.open(url, name, params);
}

//comment
var request;
var queryString;
function setQueryString(frm){
    queryString = "";
    var numberElements = frm.elements.length - 1;
    for(var i = 0; i < numberElements; i++){
        if(i < numberElements-1){
            queryString += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value) + "&";
        }else{
            queryString += frm.elements[i].name + "=" + encodeURIComponent(frm.elements[i].value);
        }
    }
}
 function httpRequest(reqType,url,asynch){
    try{
            request = new XMLHttpRequest();
        }catch(trymicrosoft){
        try{
            request = new ActiveXObject("Msxm12.XMLHTTP");
        }catch(othermicrosoft){
            try{
                request = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(failed){
                request = null;
            }
        }
    }
    if (request == null){
        //alert("Object doesn't exist");
    }else{
        initReq(reqType,url,asynch);
    }
}
function initReq(reqType,url,isAsynch){
    request.onreadystatechange = handleResponse;
    request.open(reqType,url,isAsynch);
    request.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
    request.send(queryString);
}

function sendData(frm){
    if(checkform(frm)){
        document.getElementById('cmtsubmit').style.display='none';
        document.getElementById('sbmstats').innerHTML='<img src="/2009IBT/images/dots-white.gif" style="padding-top:10px;">';
        setQueryString(frm);
        var url = "/article/cmt_post_ct.php";
        httpRequest("post",url,true);
    }
}

function handleResponse(){
    if(request.readyState == 4){
        if (request.status == 200){
            document.getElementById('formResponse').innerHTML=request.responseText;
            document.getElementById('post_comment').innerHTML="Comment Posted.";
        }else{
            //alert("Check status code");
        }
    }
}

function votes(folder,article_id,loading,target){
    if(loading)$(loading).src="http://img.ibtimes.com/www/site/ibtimesfx/images/icon_vote_check.gif";
    var url='/'+folder+'/ajax/vote.php'+"?sid="+Math.random()+"&article_id="+article_id;
    xmlHT=GetXmlHttpObject();
        xmlHT.onreadystatechange=function(){
        if((xmlHT.readyState==4 || xmlHT.readyState=="complete")){
            if(xmlHT.responseText){
                $('votetxt').innerHTML=xmlHT.responseText;
                $('votetxt1').innerHTML=xmlHT.responseText;
                if(loading)$(loading).src="http://img.ibtimes.com/www/site/ibtimesfx/images/icon_vote_c.gif";
            }
        }
    };
    xmlHT.open("GET",url,true);
    xmlHT.send(null);    
}