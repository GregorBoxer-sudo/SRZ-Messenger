//fixing the bug in google chrome, where it plays at the beginning(button and theme transitions)
//is still there, when you are in the developer mode idk why
function removePreload() {
    document.getElementsByClassName("preload")[0].classList.remove("preload");
    console.log("now")
}

//this function is for the different themes
function newTheme() {
    console.log(document.body.className)
    if (document.body.className === "dark") {
        document.body.className = "light";
        document.getElementById("switch").innerHTML = "&#x1F311;";
    } else {
        document.body.className = "dark";
        document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
    }
}

//select system theme: light/dark
function isDarkMode() {
    if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
        // dark mode
        document.body.className = "dark";
        document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
    } else {
        // light mode
        document.body.className = "light";
        document.getElementById("switch").innerHTML = "&#x1F311;";
    }
}
window.onload(isDarkMode());