//hab ich nicht vom internetman geklaut👀...
function countEmojis(str){
    const joiner = "\u{200D}";
    const split = str.split(joiner);
    let count = 0;

    for(const s of split){
        const num = Array.from(s.split(/[\ufe00-\ufe0f]/).join("")).length;
        count += num;
    }

    return count / split.length;
}

function getTime(rawTime){
    let date = new Date(parseInt(rawTime)*1000);
    let hour = date.getHours();
    let minutes = date.getMinutes()
    if (hour < 10)
        hour = "0" + hour
    if (minutes < 10)
        minutes = "0" + minutes

    return hour+":"+minutes;
}

function biggerEmojiTest(res, decryptedMessage, resUser, time){
    const regex = /(?=\p{Emoji})(?!\p{Number})/u;//find emojis and tripples them in size

    let formattedText = ""
    if (regex.test(decryptedMessage) && countEmojis(decryptedMessage) === 1){
        if (resUser === user)
            formattedText = "<div class='yourMessage' style='font-size: 3em'>" + decryptedMessage + "<br></div>";
        else
            formattedText = "<div class='opponentMessage' style='font-size: 3em>'" + decryptedMessage + "<br></div>"
    }else{//normal text
        if (resUser === user)
            formattedText = "<div class='yourMessage'>" + decryptedMessage + "<br></div>";
        else
            formattedText = "<div class='opponentMessage'>" + decryptedMessage + "<br></div>"
    }

    if (i === res.length-1){
        if (resUser === user){
            formattedText += "<div class='time' style='text-align: right'>" + time + "</div>"
        }else{
            formattedText += "<div class='time' style='text-align: left'>" + time + "</div>"
        }

    }
    return formattedText;
}


function formatMessage(response, cryptoKey){
    let res = JSON.parse(JSON.parse(response));


    if (res.length !== messages.length){
        let htmlMessage = ""
        let lastUser = -1

        for (i = 0; i < res.length; i++) {
            let resUser = res[i]["user"]
            let rawMessage = res[i]["message"]
            let decryptedMessage = decrypt(rawMessage, cryptoKey)
            let time = getTime(res[i]["time"])

            if (resUser !== lastUser){
                if (i !== 0 && i !== res.length){
                    if (resUser === user)
                        htmlMessage += "<div class='time' style='text-align: left'>" + time + "</div>"
                    else
                        htmlMessage += "<div class='time' style='text-align: right'>" + time + "</div>"
                    htmlMessage += "</div>"
                }
                htmlMessage += "<div>"
                lastUser = resUser
                console.log(i)
            }

            let individualHTMLMessage = biggerEmojiTest(res, decryptedMessage, resUser, time)

            htmlMessage += individualHTMLMessage;

            lastTime = parseInt(res[i]["time"])+(5*60)
        }
        document.getElementsByClassName("seeMessages")[0].innerHTML = htmlMessage
        document.getElementsByClassName("seeMessages")[0].scrollTo(0,document.body.scrollHeight);
    }
    return res
}