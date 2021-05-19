<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>
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
    function cryptoKey() {
        $guid = $_POST['chatID'];
        $pwd = $_POST['pwd'];
        $guidHash = sha1($guid);
        $pwdHash = sha1($pwd);
        $randomPWD = 'uw+7XP$P+Pu6dkNtm8&q4!eYZ6MVDYD$Ygyb*jJa+sRr*NVuFme^RLH5JfhuDU&7*n7g9AbXHgE8asms@TtZg8WK%^rJ&pdmcRYvUyKLP-R4dr5UsXm6DL-=4!sf*@JQpBXm6DYZg+2vALjYs99Wq_r7tQy-Fr?vp^ZjWr=8j7VPAtrzRxyRFNC+p!RM?Dv$jK-PJvUR#6RFxYfH_hPMb_MK+Y*A45@Mj?Y&B?&F_mx5yC@Hx^cu!a@fgFVGm-$v9G_kH7?dm*vW?3-=9D?39wcKqb?csS#ucs9#!=yk%JxPEWEJdp7yXu@YDV*_+EFnWC!6^QDvd?2A$EkMvdUs!E7mjLjee?gS^$UD##jT!#Hn*fJ$8$NLFr-4E%GS&gfqT^XDVuJSv#^G8WsU$LMArHBrHJcx7xB89AcXrnnKcX8Tsju!RL4T_P@?*t9avSgGEJgDJM2jfkXkbyfakeM$KMLphCMBV8K2nU+MY+3=3vHV_jRnYs=zZHC^=9huB*Lu@8DxaQBEeQ9JPVh!KX*fSuwv499B-59yXhT3Gs@4Cf@Dy+YkRQMgQDatmwd&KsP%Y?MM3M^+FumKH6mGWjeb!TqX!3_Zg39RUhXDgEGN?LVx9h9?a5bdzDdM6aSJtYLhmfwdm=bAPruCjMyG#Q9G2L4xx!@mX2aHNLf=WBtu6ZxphzaD&rPZ9#JhmYADvc3e=dG%62@Qb-X9!tRYc%fN=ehwkx7AN@-&Nm*e29v-!GxdD*x&byw!9CNuATEAQ2z%VYZLVzy_&QufJhCxTfKc*!_#e7!2@WrXDhQk9dtaa9c5a&XBP9X3wv=zaA_??seWpsM-VFBZfH9C_^kTYzV#?4LZ%mH=-cKqgz$Z_@UwVvhbQXxyhwCQaR?hUy_r*N_V6w@_na6x#%QuHkzqDmUTm!Pkmt8+b*gVQ+RT8?5BCzpSaJRkQNdDRbLQsR=EBup=wEcY8xPdGAs8$WSsqWH5TaR_*DfPa*WNNk7q8AP^JZdHy_gJ!rr2D#Pk9x@CQHt2Y9=Mts%%E&#+qLdv@gmfZzh=bp!t6raMC!9t^JZmvXdG*7=hYUhd?MbecFTny&_LPn*-KqudN*P=8*@hptzGP=-3jju_J4mD7*nmPqZcM_4mLN^NWAR3rEuq7C&FZdzcULErT+66RB6?#4^mes74BCfp%MSw8%7tah@wmn#q+_skKU@wTnD6nAB7?4dNwtXq*4&-tU_pT5wd*6nr+DdHWcQ5NytWGubZxMjyb#s-B$_wMMgN&%gndbvm@*XkS_GSYkPYx++YWMz+_XVRHVL&qwYZrK&FzMcw+v!+EXF@W%TmgnFk@npaHPmAAwx3yCNM7?t+X&ek4EzV!gWZ*jNuNAAS7By^##?t?-dSTVQm#jgpU@d9AUTMZ#Ud+VLULuQKbaY$R5!V3BqYs8-YTv82MXGrP9UhvVYyAa!4Y!LpCrN6_!cq%amaFA3!pJPvK!=7-6%Ha#MN*rR4W7gGHhH^dymuA$^qZBfpg#Ct!43Wtze=E5cLjn-eV8vB%JjNCnj5FfR8rB=LqYj%*#DnPPKMzTawRj+57_v@2JCYdGuc96eKZSU@69Bs2qDqZrRwtJ68rb$HXw*9NG2=H4U@w7Zyr=gyGcXDX^g^Vgd+Tb_Z$K%Bn$FNXdJ7am@93R6&gv+mhs^u7a!Pb7397+QV#D-Z_&*-!zac$vrSZwh22@q%tbh8kL&MF7V@!$FXna-$amrye6y3PfnVGG79KUEB4-nzx_XfTBcr4A9qfyuyP8V=uwyy+^QjWp46=zJ+QmcG+U-e3CRxTjutbJrhd*+kYEg_V^qyXD4hare=JTE7-t$GkszYr#yj9B@HNjK+UaEPp=V6g!G$=cwchLLb7Lh!CdsBnQKkz&D%FzxQStcX7Qc*9yk_wHhW*GTN%tx+QB#t_AkJD6xY3SjqkFxNW^9VH5KuRtFsmbae4pLFDGERLDAuzXFcAKwr6xZsL#Bvrc!qtWY^U?#JzL4h63Qp@BfUz*sVYG+hb4HntcFmzjvY3dgx4Uv-W69S@#Y^6n-vALPtMeE^';
        $randomHash = 'a2ae129de744b125930dc18985046ee10ae904e74379434433a40d7d197b341361bda2818c0f928d9a0426d150b4d6cb9d56597a6a0714df4d8e2f71a4a552d2';
        $key = $randomHash.$guid.$pwdHash.$guidHash.$pwd.$randomPWD;
        $keyHash = sha1($key);
        return $keyHash;
    }
?>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <title>PIM-Chat</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="../Stylesheets/stylesheet.css" rel="stylesheet" type="text/css" />
        <link href="../Stylesheets/chatstyle.css" rel="stylesheet" type="text/css" />
        <style>


        </style>
        <script src="../JS/darmode.js"></script>
        <script>
            //todo bug fixen, dass wenn man noch nichts schreibt kein fehler bekommt
            let messages = {};

            let lastTime = 0
            function decrypt(message, key) {
                decryptedJSON = CryptoJS.AES.decrypt(message, key).toString(CryptoJS.enc.Utf8);
                console.log(key);
                return decryptedJSON;
            }

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
                                        message = "<div class='yourMessage' style='font-size: 3em'>" + decrypt(res[i]["message"], '<?php echo cryptoKey()?>') + "<br></div>";
                                    else
                                        message = "<div class='opponentMessage' style='font-size: 3em>'" + decrypt(res[i]["message"], '<?php echo cryptoKey()?>') + "<br></div>"
                                }else{//normal text
                                    if (res[i]["user"] === 0)
                                        message = "<div class='yourMessage'>" + decrypt(res[i]["message"], '<?php echo cryptoKey()?>') + "<br></div>";
                                    else
                                        message = "<div class='opponentMessage'>" + decrypt(res[i]["message"], '<?php echo cryptoKey()?>') + "<br></div>"
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

            function encrypt(message, key) {
		        var encrypt = CryptoJS.AES.encrypt(message, key).toString();
                return encrypt;
	        }

            function sendMessage(){
                if (document.getElementsByClassName("textsusField")[0].value !== ""){
                    let data = { "user": 0, "chatID": '<?php echo $guid?>', "message": encrypt(document.getElementsByClassName("textsusField")[0].value, '<?php echo cryptoKey()?>')};
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
    <body class="preload dark" id="bodyChat"> <!--onload="removePreload()" todo do remove preload or check if its necessary-->
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