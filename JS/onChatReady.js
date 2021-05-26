$(document).ready(function() {
    getMessages();
    let interval = setInterval(getMessages, 250);
    document.getElementById('printKey').innerText = sessionStorage.getItem('key')
})