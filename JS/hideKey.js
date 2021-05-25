function hideKey() {
    if (document.getElementById('printKey').className === "keyHidden") {
        document.getElementById('printKey').className = "keyVisible";
    } else {
        document.getElementById('printKey').className = "keyHidden";
    }
}