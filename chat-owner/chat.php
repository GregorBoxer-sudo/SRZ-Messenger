<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_POST['chatID'];
    $pwd = $_POST['pwd'];
    if (checkForPassword($pwd, $guid)!=1) {
        #echo "<script>window.location.href = 'dashboard-owner.php?error=NoConn&chatID=".$guid."';</script>";
    } else {
        setConnStatTrue($guid);
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="../stylesheet.css" rel="stylesheet" type="text/css" />
        <style>
            body{
                background-image: url('../images/krita bubble pim.png');
                background-repeat:no-repeat;
                background-size:contain;
                background-position: center;
            }
            .yourMessage{
                margin: 0.2em;
                margin-left: 0;
                margin-right: 0;
                text-align: right;
            }
            .opponentMessage{
                margin: 0.2em;/*todo je nach dem wir lange die nachricht her ist die margin setzen*/
                text-align: left;
                margin-left: 0;
                margin-right: 0;
            }
            .time{
                font-size: 0.75em;
                color: #AAAAAA;
            }

            .chatIDP{
                color: #AAAAAA;
                text-align: center;
            }
            .seeMessages{
                margin: 1em;
                margin-bottom: 0;
                margin-top: 0;
                padding-bottom: 0.5em;
                font-family: Roboto;
                font-size: 15px;

                height: 95%;
                color: #EEEEEE;
                overflow: scroll;
                -ms-overflow-style: none;  /* IE and Edge */
                scrollbar-width: none;  /* Firefox */
            }
            .seeMessages::-webkit-scrollbar {
                display: none;
            }

            .writingContainer{
                margin-left: 1em;
                margin-right: 1em;
                display: flex;
            }

            .textsusField{
                height: 5%;
                width: 95%;

                font-family: Roboto;
                font-size: 1.5em;
                font-weight: 300;
                text-align: left;
                padding-left: 0.25em;
                color: var(--text);

                background: var(--inputBackground);
                border-style: none;
                border-radius: 0.5em;

            }
            .textsusField:focus{
                outline: none;
            }

            #sendingButton{
                width: 5%;
                border-radius: 0.75em;
                border-style: none;
                font-size: 1em;
            }
            #sendingButton:hover{
                background: black;
                color: white;
            }



            .footer {
                position: fixed;
                left: 0;
                bottom: 0;
                width: 100%;
                padding-left: 1em;
            }
            .interactionContainer{
                padding-top: 1em;
                padding-bottom: 0.5em;
                width: 50%;
                margin-left: 25%;
                margin-right: 25%;
                margin-top: 2em;


                height: 80%;

                background-color: rgba(0, 0, 0, .1);
                backdrop-filter: blur(50px);

                border-radius: 1em;
            }

        </style>
        <script>
            //todo implement darkmode and add style to css file
            //todo bug fixen, dass wenn man noch nichts schreibt kein fehler bekommt
            let messages = {};

            let lastTime = 0
            function getMessages(){
                let data = { "user": 0, "chatID": '<?php echo $guid?>' };

                let xhr = new XMLHttpRequest();
                xhr.open('POST', '../Conversation/get_Message.php', true);
                xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        let res = JSON.parse(JSON.parse(xhr.response));

                        if (res.length !== messages.length){
                            let htmlMessage = ""
                            let lastUser = -1

                            for (i = 0; i < res.length; i++) {
                                let date = new Date(parseInt(res[i]["time"])*1000);
                                let hour = date.getHours();
                                let minutes = date.getMinutes()
                                if (hour < 10)
                                    hour = "0" + hour
                                if (minutes < 10)
                                    minutes = "0" + minutes

                                let time = hour+":"+minutes;


                                if (res[i]["user"] !== lastUser){
                                    if (i !== 0 && i !== res.length){
                                        if (res[i]["user"] === 0)
                                            htmlMessage += "<div class='time' style='text-align: left'>" + time + "</div>"
                                        else
                                            htmlMessage += "<div class='time' style='text-align: right'>" + time + "</div>"
                                        htmlMessage += "</div>"
                                    }
                                    htmlMessage += "<div>"
                                    lastUser = res[i]["user"]
                                    console.log(i)
                                }


//TODO FIND ERROR IN FILESTUFF ALSO FEHLER FINDEN BEI DEM ZIPPEN, DENN DA WIRFT ER NEN FEHLER DESWEGEN FUNKTIONIERT ES GLAUBE NICHT
                                let message = ""


                                //hab ich nicht vom internetman geklaut👀...
                                function fancyCount2(str){
                                    const joiner = "\u{200D}";
                                    const split = str.split(joiner);
                                    let count = 0;

                                    for(const s of split){
                                        //removing the variation selectors
                                        const num = Array.from(s.split(/[\ufe00-\ufe0f]/).join("")).length;
                                        count += num;
                                    }

                                    //assuming the joiners are used appropriately
                                    return count / split.length;
                                }


                                const regex = /(?=\p{Emoji})(?!\p{Number})/u;//find emojis and tripples them in size

                                console.log(fancyCount2(res[i]["message"]))
                                console.log(res[i]["message"])
                                if (regex.test(res[i]["message"]) && fancyCount2(res[i]["message"]) === 1){
                                    if (res[i]["user"] === 0)
                                        message = "<div class='yourMessage' style='font-size: 3em'>" + res[i]["message"] + "<br></div>";
                                    else
                                        message = "<div class='opponentMessage' style='font-size: 3em>'" + res[i]["message"] + "<br></div>"
                                }else{//normal text
                                    if (res[i]["user"] === 0)
                                        message = "<div class='yourMessage'>" + res[i]["message"] + "<br></div>";
                                    else
                                        message = "<div class='opponentMessage'>" + res[i]["message"] + "<br></div>"
                                }



                                if (i === res.length-1){
                                    if (res[i]["user"] === 0){
                                        message += "<div class='time' style='text-align: right'>" + time + "</div>"
                                    }else{
                                        message += "<div class='time' style='text-align: left'>" + time + "</div>"
                                    }

                                }


                                htmlMessage += message;

                                lastTime = parseInt(res[i]["time"])+(5*60)
                            }
                            document.getElementsByClassName("seeMessages")[0].innerHTML = htmlMessage

                            document.getElementsByClassName("seeMessages")[0].scrollTo(0,document.body.scrollHeight);
                        }
                        messages = res

                    }
                };

                xhr.send(JSON.stringify(data));
                return false;
            }

            function sendMessage(){
                if (document.getElementsByClassName("textsusField")[0].value !== ""){
                    let data = { "user": 0, "chatID": '<?php echo $guid?>', "message": document.getElementsByClassName("textsusField")[0].value};

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../Conversation/send_Message.php', true);
                    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                    xhr.onreadystatechange = function () {

                    };

                    xhr.send(JSON.stringify(data));
                    document.getElementsByClassName("textsusField")[0].value = "";
                    getMessages();
                    return false;
                }else{
                    //todo alert
                }
            }


            $(document).ready(function(){
                getMessages();
                let interval = setInterval(getMessages, 100);
                //todo es anders lösen, dass ich nciht die gnaze zeit nach den nachrichten frage sonder man halt nur einzelne hat und dann noch überhaupt nachfrgaen ob da in dem directory was drin ist damit es keine errrs wirft

            })
///todo microseconds in der time php file

        document.addEventListener('keydown', (e) => {
            if (e.code === "Enter")
                sendMessage();
        })

        </script>
    </head>
    <body class="preload dark"> <!--onload="removePreload()" todo do remove preload or check if its necessary-->
        <div class="navigationBar">
            <a class="navItem" id="home" href="../choose.php">Pim</a>
            <a class="navItem" id="switch" onclick="newTheme()" href="#">&#x2600;&#xFE0F;</a>
        </div>

        <p class="chatIDP">ChatID: <?php echo $_POST['chatID'];?></p>
        <br>

    <div class="interactionContainer">
        <div class="seeMessages">
        </div>

        <div class="writingContainer">
            <!--            TODO input file/pic ...-->
            <input type="text" name="TextField" placeholder="Deine Nachricht ..." class="textsusField" autofocus="autofocus"
                   autocomplete="off">
            <button id="sendingButton" onclick="sendMessage()">&#11014;</button>
        </div>

    </div>


    <footer class="footer">
        <form action="../PHP/deleteRow.php" method="post">
            <input type="submit" name="someAction" value="Delete Chat" class="smallButtons" id="deleteChatButton"/>
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
    </footer>
    </body>
</html>