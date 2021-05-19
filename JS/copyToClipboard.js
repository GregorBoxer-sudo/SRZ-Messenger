function copyToClipboard(element, input) {
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand("copy");

    element.style.borderColor = "#6bcf6d";
    element.style.borderWidth = "3px";
    element.style.borderStyle = "solid";
}