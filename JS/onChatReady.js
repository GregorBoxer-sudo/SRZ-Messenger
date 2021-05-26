$(document).ready(function(){
    getMessages();
    let interval = setInterval(getMessages, 100);
    document.getElementById('printKey').innerText = sessionStorage.getItem('key')
})