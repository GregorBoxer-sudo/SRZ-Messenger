<?php
    require('../PHP/session.php');
    require('../PHP/idGen.php');
    $guid = $_POST['chatID'];
    $pwd = $_POST['pwd'];
    if (checkForPassword($pwd, $guid)!=1) {
        echo "<script>window.location.href = 'dashboard-owner.php?error=NoConn&chatID=".$guid."';</script>";
    } else {
        setConnStatTrue($guid);
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        <style>
            .seeMessages{
                height: 40%;
                width: 50%;
                font-family: Roboto;
                font-size: 15px;
            }
        </style>
        <script>
            console.log("hi")
            $(document).ready(function(){
                let interval = setInterval(function(){
                    let data = { "user": 0, "chatID": '<?php echo $guid?>' };

                    let xhr = new XMLHttpRequest();
                    xhr.open('POST', '../Conversation/get_Message.php', true);
                    xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            let res = JSON.parse(JSON.parse(xhr.response));
                            document.getElementsByClassName("seeMessages")[0].innerHTML = "";
                            for (i = 0; i < res.length; i++) {
                                console.log(res[i]);
                                let date = new Date(parseInt(res[i]["time"])*1000);
                                let time = date.getHours()+":"+date.getMinutes();
                                if (res[i]["user"] == 0){
                                    document.getElementsByClassName("seeMessages")[0].innerHTML += "Du: " + res[i]["message"] + "<br>"
                                    document.getElementsByClassName("seeMessages")[0].innerHTML += time + "<br>"
                                }else{
                                    document.getElementsByClassName("seeMessages")[0].innerHTML += "Waschbär: " + res[i]["message"] + "<br>"
                                    document.getElementsByClassName("seeMessages")[0].innerHTML += time + "<br>"
                                }
                            }
                        }
                    };

                    xhr.send(JSON.stringify(data));
                    return false;
                }, 100);

                //todo es anders lösen, dass ich nciht die gnaze zeit nach den nachrichten frage sonder man halt nur einzelne hat und dann noch überhaupt nachfrgaen ob da in dem directory was drin ist damit es keine errrs wirft
                $("#sendingButton").click(function (){
                    if (document.getElementsByClassName("textsusField")[0].value !== ""){
                        let data = { "user": 0, "chatID": '<?php echo $guid?>', "message": document.getElementsByClassName("textsusField")[0].value};

                        let xhr = new XMLHttpRequest();
                        xhr.open('POST', '../Conversation/send_Message.php', true);
                        xhr.setRequestHeader("Content-Type", "application/json; charset=UTF-8");
                        xhr.onreadystatechange = function () {

                        };

                        xhr.send(JSON.stringify(data));
                        document.getElementsByClassName("textsusField")[0].value = "";
                        return false;
                    }else{
                        alert("schreibe was!")
                    }

                })
            })

        </script>
    </head>
    <body class="preload dark"> <!--onload="removePreload()" todo do remove preload or check if its necessary-->
        <h1>Welcome at Pim</h1>
        <br>
        <p>ChatID: <?php echo $_POST['chatID'];?><br>Chat eröffnet!</p>
        <br>
        <form action="../PHP/deleteRow.php" method="post">
            <input type="submit" name="someAction" value="Delete Chat"/>
            <input type="hidden" name="chatID" value="<?php echo $guid;?>"/>
        </form>
        <div class="seeMessages">

        </div>


        <!--            TODO input file/pic ...-->
        <input type="text" name="TextField" placeholder="Deine Nachricht ..." class="textsusField" autofocus="autofocus"
               autocomplete="off">
        <button id="sendingButton">></button>

    </body>
</html>