//fixing the bug in google chrome, where it plays at the beginning(button and theme transitions)
//is still there, when you are in the developer mode idk why
function removePreload() {
    document.getElementsByClassName("preload")[0].classList.remove("preload");
    console.log("now")
}

//this function is for the different themes
function newTheme() {
    console.log(document.body.className);
    if (document.body.className === "dark" || document.body.className === "preload dark") {
        document.body.className = "light";
        setCookie('darkMode', 0, 0);
        document.getElementById("switch").innerHTML = "&#127763";
    } else {
        document.body.className = "dark";
        setCookie('darkMode', 1, 0);
        document.getElementById("switch").innerHTML = "&#127763";
    }
}

//select system theme: light/dark
function isDarkMode() {
    if (checkCookie('darkMode')) {
        console.log('mode already selected');
    } else {
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            // dark mode
            document.body.className = "dark";
            document.getElementById("switch").innerHTML = "&#127763";
            setCookie('darkMode', 1, 0);
        } else {
            // light mode
            document.body.className = "light";
            document.getElementById("switch").innerHTML = "&#127763";
            setCookie('darkMode', 0, 0);
        }
    }
}