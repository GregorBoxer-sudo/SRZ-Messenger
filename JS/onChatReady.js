$(document).ready(function(){
    getMessages();
    let interval = setInterval(getMessages, 100);
    document.getElementById('printKey').innerText = sessionStorage.getItem('key')
    //todo es anders lösen, dass ich nciht die gnaze zeit nach den nachrichten frage sonder man halt nur einzelne hat und dann noch überhaupt nachfrgaen ob da in dem directory was drin ist damit es keine errrs wirft
    //todo in der php file werden sekunden benutzt,da kann man evtl mikrosekunden benutzen
    //TODO FIND ERROR IN FILESTUFF ALSO FEHLER FINDEN BEI DEM ZIPPEN, DENN DA WIRFT ER NEN FEHLER DESWEGEN FUNKTIONIERT ES GLAUBE NICHT
})