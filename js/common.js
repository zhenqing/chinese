function PopUp(URL, width, height,scroll) {
    day = new Date();
    id = day.getTime();
    eval("page" + id + " = window.open(URL, 'infoPage', 'toolbar=0,scrollbars='+scroll+',location=0,statusbar=0,menubar=0,resizable=0,width=' + width + ',height=' + height + ',left = 100,top = 0');");
}
