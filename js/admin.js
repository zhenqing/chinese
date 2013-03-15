function showimages(uid,aid){
    var linkaddr = '';
    if(aid){
        linkaddr = "./?r=articleimages/ajaxlist&aid="+aid+"&uid="+uid;
    }else{
        linkaddr = "./?r=articleimages/ajaxlist"+"&uid="+uid;
    }
    $.get(linkaddr,function(data){
        var articleform = document.forms.articleform;
        var tempstr = "";
        var htmlstr = '<ul class="imagedata">';
        for(var vk in data){
            tempstr += data[vk].id+",";
            htmlstr +=" <li><div class=\"thumbbox\" >";
            htmlstr +=" <img src=\"/chinese/datainfo/thumbs/"+data[vk].path+"\" /><br /><div class=\"title\">"+data[vk].title;
            htmlstr +="<img onclick=\"delimages('"+aid+"','"+uid+"',"+data[vk].id+")\" src=\"/chinese/images/ic_delete.jpg\" /> ";
            //htmlstr +="<a class=\"thickbox\" href=\"/manage/?r=articleimages/ajaxadd&uid="+uid+"&articleid="+aid+"&height=400&width=600\"><img src=\"/images/ic_edit.jpg\" /></a> ";
            htmlstr +="</div>";
            htmlstr +=" <div></li> \r\n";
        }
        htmlstr += "</ul>";
        $("#imageboxes").html(htmlstr);
        articleform.elements[1].value = tempstr;
        tb_remove();
    },'json');
}     
    function delimages(aid,uid,imageid){
        $.post('./?r=articleimages/ajaxdelete',{'imageid':imageid});
        showimages(uid,aid);
    }
/*    */
var setdata = function(section,filename,pos){
    $.post('./?r=updatepages/ajaxdataupdate',$("#form-"+section+"-"+pos).serialize(),function(data){
        
        $("#"+section+"-"+pos).html(data);
    });
    

}