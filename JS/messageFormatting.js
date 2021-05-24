let hasEmoji = false

function countEmojis(str) {
    const joiner = "\u{200D}";
    const split = str.split(joiner);
    let count = 0;

    for (const s of split) {
        const num = Array.from(s.split(/[\ufe00-\ufe0f]/).join("")).length;
        count += num;
    }

    return count / split.length;
}

function getTime(rawTime) {
    let date = new Date(parseInt(rawTime) * 1000);
    let hour = date.getHours();
    let minutes = date.getMinutes()
    if (hour < 10)
        hour = "0" + hour
    if (minutes < 10)
        minutes = "0" + minutes

    return hour + ":" + minutes;
}

function setEmoji(text) {
    let length = text.length

    let emojiList = [
        ["<3", "&#x2764;&#xfe0f; "], //❤️
        ["</3", "&#x1f494; "], //💔
        ["<+3", "&#10084;&#8205;&#129657; "], //❤️‍🩹 (mending heart)
    ]

    for (let i = 0; i < emojiList.length; i++) {
        let tempLength = emojiList[i][0].length
        text = text.replace(emojiList[i][0], emojiList[i][1])

        if (length === tempLength && length !== text.length)
            hasEmoji = true
    }

    return text
}

function setFormattingHTML(text) {
    let formattingList = [
        ["/n", "<br>"], //linebreak
        ["/big{", "<p style='font-size: 3em' class='blankP'>"], //big text
        ["/small{", "<p style='font-size: 0.5em' class='blankP'>"], //small text

        ["/spoiler{", "<p class='blankP spoiler'>"], //spoiler

        ["/d{", "<p style='color: var(--text)' class='blankP'>"], //default
        ["/b{", "<p style='color: blue' class='blankP'>"], //blue
        ["/r{", "<p style='color: red' class='blankP'>"], //red
        ["/g{", "<p style='color: green' class='blankP'>"], //green
        ["/y{", "<p style='color: yellow' class='blankP'>"], //yellow
        ["/o{", "<p style='color: orange' class='blankP'>"], //yellow
        ["/p{", "<p style='color: purple' class='blankP'>"], //purple
        ["/rainbow{", "<p class='blankP rainbow'>"], //rainbow
        ["/jeb_{", "<p class='blankP rainbow'>"], //rainbow (minecraft easterEgg)
        ["}", "</p>"]//p end
    ]

    for (let i = 0; i < formattingList.length; i++) {
        text = text.replace(formattingList[i][0], formattingList[i][1])
    }

    return text
}

function biggerEmojiTest(decryptedMessage, resUser, time) {
    const regex = /(?=\p{Emoji})(?!\p{Number})/u; //find emojis and tripples them in size

    let formattedText = "";
    decryptedMessage = setFormattingHTML(decryptedMessage);
    decryptedMessage = setEmoji(decryptedMessage);
    if (regex.test(decryptedMessage) && countEmojis(decryptedMessage) === 1 || hasEmoji) {
        if (resUser === user)
            formattedText = "<div class='yourMessage' style='font-size: 3em'>" + decryptedMessage + "<br></div>";
        else
            formattedText = "<div class='opponentMessage' style='font-size: 3em'>" + decryptedMessage + "<br></div>"
    } else { //normal text
        if (resUser === user)
            formattedText = "<div class='yourMessage'>" + decryptedMessage + "<br></div>";
        else
            formattedText = "<div class='opponentMessage'>" + decryptedMessage + "<br></div>"
    }

    hasEmoji = false
    return formattedText;
}

function alertInjection() {
    alert('Pim found a possible Injection, that could harm you.\nIt could be a button, event or script.\nWe blocked it to protect you, your computer and the chat!');
}

function injectionProtection(text) {
    let formattingList = [
        ['onclick='],
        ['onload='],
        ['<button>'],
        ['<script>']
    ];
    for (let i = 0; i < formattingList.length; i++) {
        text = text.replace(formattingList[i][0], '--found injection <a style="text-decoration: underline" onclick="alertInjection()">help</a>--');
    }
    return text;
}

function formatMessage(response, cryptoKey) {
    let res = JSON.parse(JSON.parse(response));

    if (res.length !== messages.length) {
        let htmlMessage = ""
        let lastUser = -1

        for (i = 0; i < res.length; i++) {
            let resUser = res[i]["user"]
            let rawMessage = res[i]["message"]
            let decryptedMessage = decrypt(rawMessage, cryptoKey)
            let time = getTime(res[i]["time"])

            decryptedMessage = injectionProtection(decryptedMessage);

            if (decryptedMessage == '') {
                decryptedMessage = 'Warning: encryption key changed or does not work! <a href="javascript:onclick=changeKey()">Click here to change the key</a>';
            }

            if (resUser !== lastUser) {
                if (i !== 0 && i !== decryptedMessage.length) {
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

            let individualHTMLMessage = biggerEmojiTest(decryptedMessage, resUser, time)

            if (i === res.length - 1) {
                if (resUser === user)
                    individualHTMLMessage += "<div class='time' style='text-align: right'>" + time + "</div>"
                else
                    individualHTMLMessage += "<div class='time' style='text-align: left'>" + time + "</div>"
            }

            htmlMessage += individualHTMLMessage;

            let lastTime = parseInt(res[i]["time"]) + (5 * 60)
        }
        // document.getElementsByClassName("seeMessages")[0].innerHTML = htmlMessage
         document.getElementsByClassName("seeMessages")[0].innerHTML += htmlMessage
        document.getElementsByClassName("seeMessages")[0].scrollTo(0, document.body.scrollHeight);
    }
    return res
}