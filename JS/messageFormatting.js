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

        ["/grinning", "&#128512; "], //😀
        ["/grin_smile", "&#128513; "], //😁
        ["/xD", "&#128514; "], //😂
        ["/smiley", "&#128515; "], //😃
        ["/smile", "&#128516; "], //😄
        ["/sweat_smile", "&#128517; "], //😅
        ["/angel", "&#128519; "], //😇
        ["/devil", "&#128520; "], //😈
        ["/wink", "&#128521; "], //😉
        ["/blush", "&#128522; "], //😊
        ["/tasty", "&#128523; "], //😋
        ["/omnomnom", "&#128523; "], //😋
        ["/heart_eyes", "&#128525; "], //😍
        ["/shades", "&#128526; "], //😎
        ["/smirk", "&#128527; "], //😏
        ["/neutral", "&#128528; "], //😐
        ["/._.", "&#128528; "], //😐
        ["/unamused", "&#128530; "], //😒
        ["/sweat_face", "&#128531; "], //😓
        ["/confused", "&#128533; "], //😕
        ["/confused", "&#128533; "], //😕
        ["/kiss", "&#128537; "], //😙
        ["/love_kiss", "&#128536; "], //😘
        ["/tongue", "&#128540; "], //😜
        ["/angry", "&#128544; "], //😠
        ["/pouting", "&#128545; "], //😡
        ["/cry", "&#128546; "], //😢
        ["/sob", "&#128557; "], //😭
        ["/sleep", "&#128564; "], //😴
        ["/dead", "&#128565; "], //😵
        ["/no_mouth", "&#128566; "], //😶
        ["/mask", "&#128567; "], //😷
        ["/corona", "&#128567; "], //😷
        ["/2020", "&#128567; "], //😷
        ["/2021", "&#128567; "], //😷
        ["/cowboy", "&#129312; "], //🤠
        ["/mhh", "&#129300; "], //🤔
        ["/glasses", "&#129299; "], //🤓
        ["/nerd", "&#129299; "], //🤓
        ["/sick", "&#129298; "], //🤒
        ["/clown", "&#129313; "], //🤡
        ["/rofl", "&#129315; "], //🤣
        ["/lie", "&#129317; "], //🤥
        ["/pinocchio", "&#129317; "], //🤥
        ["/puke", "&#129326; "], //🤮
        ["/mind_blow", "&#129327; "], //🤯
        ["/monocle", "&#129488; "], //🧐

        ["/aubergine", "&#127814; "], //🍆
        ["/peach", "&#127825; "], //🍑
        ["/cherry", "&#127826; "], //🍒
        ["/pizza", "&#127829; "], //🍕
        ["/burger", "&#127828; "], //🍔
        ["/chicken_wing", "&#127831; "], //🍗
        ["/fries", "&#127839; "], //🍟
        ["/sushi", "&#127843; "], //🍣
        ["/apple", "&#127823; "], //🍏
        ["/ramen", "&#127836; "], //🍜
        ["/naruto", "&#127845; "], //🍥
        ["/cookie", "&#127850; "], //🍪
        ["/wine", "&#127863; "], //🍷
        ["/beer", "&#127866; "], //🍺
        ["/champagne", "&#127870; "], //🍾
        ["/cake", "&#127874; "], //🎂

        ["/eye", "&#128065; "], //👁
        ["/2eyes", "&#128064; "], //👀
        ["/ear", "&#128066; "], //👂
        ["/nose", "&#128067; "], //👃
        ["/mouth", "&#128068; "], //👄
        ["/tongue", "&#128069; "], //👅

        ["/left_finger", "&#128072; "], //👈
        ["/right_finger", "&#128073; "], //👉
        ["/top_finger", "&#128070; "], //👆
        ["/down_finger", "&#128071; "], //👇
        ["/fist", "&#128074; "], //👊
        ["/+1", "&#128077; "], //👍
        ["/like", "&#128077; "], //👍
        ["/thumbs_up", "&#128077; "], //👍
        ["/-1", "&#128078; "], //👎
        ["/dislike", "&#128078; "], //👎
        ["/thumbs_down", "&#128078; "], //👎
        ["/shut_up", "&#128405; "], //🖕
        ["/middle_finger", "&#128405; "], //🖕

        ["/flame", "&#128293; "], //🔥
        ["/gun", "&#128299; "], //🔫
        ["/pewpew", "&#128299; "], //🔫
        ["/microscope", "&#128300; "], //🔬
        ["/rocket", "&#128640; "], //🚀
        ["/robot", "&#129302; "], //🤖
        ["/beepboop", "&#129302; "], //🤖




        ["/molly", "&#128571; "], //😻
        ["/merlin", "&#128571; "] //😻
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
        ["/tiny{", "<p style='font-size: 0.5em' class='blankP'>"], //tiny text
        ["/u{", "<p style='text-decoration: underline' class='blankP'>"], //underline
        ["/bold{", "<p style='font-weight: bold;' class='blankP'>"], //underline
//todo italic

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

/**
 * @param {*} response
 * @param {*} cryptoKey
 * @param {boolean} getMessageMode
 */
function formatMessage(response, cryptoKey, getMessageMode) {
    // let res = JSON.parse(response);
    if (!getMessageMode) {
        console.log("start")
        console.log(response)
        console.log(JSON.parse(response))
        console.log(JSON.parse(JSON.parse(response)))
        console.log("end")
    }
    let res = JSON.parse(JSON.parse(response));
    // }
    if (!getMessageMode){
        console.log(res.length +","+messages.length)
    }
    if (res.length !== messages.length) {
        let htmlMessage = ""
        let lastUser = -1
        for (let i = 0; i < res.length; i++) {
            let resUser = res[i]["user"]
            let rawMessage = res[i]["message"]
            let decryptedMessage = decrypt(rawMessage, cryptoKey)
            let time = getTime(res[i]["time"])
            console.log(resUser+" vs "+user);
            if (resUser === user) {
                if (getMessageMode) {
                    console.log("continue");
                    continue;
                }
            }
            decryptedMessage = injectionProtection(decryptedMessage);

            if (decryptedMessage === '') {
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