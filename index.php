<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>WiP</title>
        <link rel="icon" href="https://lh3.googleusercontent.com/proxy/LLwGSJOeIeB9Xy10EjCXU5hhO4kjSL17llih51Mr1ydWaVFanvBBf5Ny_6jj9R0093i61P7OGuhsM6Ag9mWiyvPn9GqBaoIUAQRGDQkV18G5zb5y1OUuJ8VzjNl3VboWHJgBceKOQ1GqwGM5rJR42rLT8UKtu57A6M2V9g-aDQ">
        <link href="stylesheet.css" rel="stylesheet" type="text/css"/>
        <!-- Fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700|Quicksand:300,500" rel="stylesheet">
        <!--Montserrat:300-->
    </head>
    <body>
        <!--navigation bar-->
        <div class="navigationBar">
            <a class="navItem" id="home" href="choose.php">Home</a>
    
            <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
            <a class="navItem" id="FAQ" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki">FAQ</a>
        </div>
    
        <h1 class = titleIndex> HEY!</h1> <br>
        <h1 class = lead> this service isn't finished yet</h1>
        <p class = notFinishedYetText>
            We are currently working very hard on our Website, we try to finish it as soon as possible. <br>
            Thank your for your patience. <br>
            If your still want to test it, then click "TRY IT" </p>
        <div class = progressbarContainer><div class = progressbar></div></div>
    
        <button onclick="window.location.href = 'choose.php'" class="slideButton" id="tryIt">TRY IT</button>
    
        <div class = linkContainer>
            <a href="https://github.com/GregorBoxer-sudo/SRZ-Messenger" class = linkImages id = github><img src="images/githubBlack.png" width = "166" height = "166" id="githubImage" alt="GitHUb"></a>
            <a href="https://docs.google.com/document/d/1AW7I1kLx_LlGN_nbQE43joOdSn5mnM2fA2ZUST9VvsM/edit?usp=sharing" class=linkImages id = googleDocs><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/Google_Docs_logo.svg/1200px-Google_Docs_logo.svg.png" width="120" height="166" id="googleDocsImage" alt="GitHub"></a>
        </div>
    </body>
    <script>
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
                document.getElementById("githubImage").src = "images/githubBlack.png";
            } else {
                document.body.className = "dark";
                document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
                document.getElementById("githubImage").src = "images/githubWhite.png";
            }
        }

        //select system theme: light/dark
        function isDarkMode() {
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                // dark mode
                document.body.className = "dark";
                document.getElementById("switch").innerHTML = "&#x2600;&#xFE0F;";
                document.getElementById("githubImage").src = "images/githubWhite.png";
            } else {
                // light mode
                document.body.className = "light";
                document.getElementById("switch").innerHTML = "&#x1F311;";
                document.getElementById("githubImage").src = "images/githubBlack.png";
            }
        }
        window.onload(isDarkMode());
    </script>
</html>