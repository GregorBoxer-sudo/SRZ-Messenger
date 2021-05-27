let hasEmoji = false
let includesYTLink = false
let videoID
let done = false;

let player;

let tag = document.createElement('script');
tag.id = "ytScript"
tag.src = "https://www.youtube.com/iframe_api";

let firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

let lastUser = -1
let lastMS
let lastTime = 0

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
    let date = new Date(parseInt(rawTime));
    let hour = date.getHours();
    let minutes = date.getMinutes()
    if (hour < 10)
        hour = "0" + hour
    if (minutes < 10)
        minutes = "0" + minutes

    return hour + ":" + minutes;
}

function commands(text) {
    if (text.startsWith('!delete')) {
        location.reload();
    } else if (text.startsWith('!reload')) {
        location.reload();
    } else if (text.startsWith('!clear')) {
        location.reload();
    } else if (text.startsWith('!help')) {
        text = '<a target="_blank" href="https://github.com/GregorBoxer-sudo/SRZ-Messenger/wiki/Commands---Style---Emoji" style="text-decoration: underline">Click here for help!</a>';
    } else if (text.startsWith('!randomWiki')) {
        if (text === '!randomWiki') {
            text = '<a target="_blank" href="https://en.wikipedia.org/wiki/Special:Random" style="text-decoration: underline">Random Wiki en</a>';
        } else {
            text = '<a target="_blank" href="https://' + text.substring(12, text.length) + '.wikipedia.org/wiki/Special:Random" style="text-decoration: underline">Random Wiki ' + text.substring(12, text.length) + '</a>';
        }
    } else if (text.startsWith('!randomSC')) {
        let chars = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z"];
        let randomGen = "";
        for (let i = 0; i < 2; i++) {
            randomGen += chars[Math.floor(Math.random() * 26)];
        }
        randomGen += (Math.floor(Math.random() * 10000) + 10000).toString().substring(1);
        console.log(randomGen);
        text = '<a target="_blank" href="https://prnt.sc/' + randomGen + '" style="text-decoration: underline">Random Screenshot</a>';
    }
    return text;
}

function setEmoji(text) {
    let emojiList = [
        ["<3", "&#x2764;&#xfe0f; "], //❤️
        ["</3", "&#x1f494; "], //💔
        ["<+3", "&#10084;&#8205;&#129657; "], //❤️‍🩹 (mending heart)
        ["<#3", "&#10084;&#65039;&#8205;&#128293; "], //❤️‍🔥 (flaming heart)

        [":grinning", "&#128512; "], //😀
        [":grin_smile", "&#128513; "], //😁
        [":xD", "&#128514; "], //😂
        [":smiley", "&#128515; "], //😃
        [":smile", "&#128516; "], //😄
        [":sweat_smile", "&#128517; "], //😅
        [":angel", "&#128519; "], //😇
        [":devil", "&#128520; "], //😈
        [":wink", "&#128521; "], //😉
        [":blush", "&#128522; "], //😊
        [":tasty", "&#128523; "], //😋
        [":omnomnom", "&#128523; "], //😋
        [":heart_eyes", "&#128525; "], //😍
        [":shades", "&#128526; "], //😎
        [":smirk", "&#128527; "], //😏
        [":neutral", "&#128528; "], //😐
        [":._.", "&#128528; "], //😐
        [":unamused", "&#128530; "], //😒
        [":sweat_face", "&#128531; "], //😓
        [":confused", "&#128533; "], //😕
        [":confused", "&#128533; "], //😕
        [":kiss", "&#128537; "], //😙
        [":love_kiss", "&#128536; "], //😘
        [":tongue", "&#128540; "], //😜
        [":angry", "&#128544; "], //😠
        [":pouting", "&#128545; "], //😡
        [":cry", "&#128546; "], //😢
        [":sob", "&#128557; "], //😭
        [":sleep", "&#128564; "], //😴
        [":dead", "&#128565; "], //😵
        [":no_mouth", "&#128566; "], //😶
        [":mask", "&#128567; "], //😷
        [":corona", "&#128567; "], //😷
        [":2020", "&#128567; "], //😷
        [":2021", "&#128567; "], //😷
        [":cowboy", "&#129312; "], //🤠
        [":mhh", "&#129300; "], //🤔
        [":glasses", "&#129299; "], //🤓
        [":nerd", "&#129299; "], //🤓
        [":sick", "&#129298; "], //🤒
        [":clown", "&#129313; "], //🤡
        [":rofl", "&#129315; "], //🤣
        [":lie", "&#129317; "], //🤥
        [":pinocchio", "&#129317; "], //🤥
        [":puke", "&#129326; "], //🤮
        [":mind_blow", "&#129327; "], //🤯
        [":monocle", "&#129488; "], //🧐

        [":aubergine", "&#127814; "], //🍆
        [":peach", "&#127825; "], //🍑
        [":cherry", "&#127826; "], //🍒
        [":pizza", "&#127829; "], //🍕
        [":burger", "&#127828; "], //🍔
        [":chicken_wing", "&#127831; "], //🍗
        [":fries", "&#127839; "], //🍟
        [":sushi", "&#127843; "], //🍣
        [":apple", "&#127823; "], //🍏
        [":ramen", "&#127836; "], //🍜
        [":naruto", "&#127845; "], //🍥
        [":cookie", "&#127850; "], //🍪
        [":wine", "&#127863; "], //🍷
        [":beer", "&#127866; "], //🍺
        [":champagne", "&#127870; "], //🍾
        [":cake", "&#127874; "], //🎂
        [":avocado", "&#129361; "], //🥑
        [":cheese", "&#129472; "], //🧀

        [":rat", "&#128000; "], //🐀
        [":mice", "&#128001; "], //🐁
        [":cow", "&#128004; "], //🐄
        [":muh", "&#128004; "], //🐄
        [":lion", "&#128005; "], //🐅
        [":leopard", "&#128006; "], //🐆
        [":rabbit", "&#128007; "], //🐇
        [":cat", "&#128008; "], //🐈
        [":kitten", "&#128008; "], //🐈
        [":whale", "&#128011; "], //🐋
        [":snail", "&#128012; "], //🐌
        [":gary", "&#128012; "], //🐌
        [":gerald_b._schneckerich", "&#128012; "], //🐌
        [":snake", "&#128013; "], //🐍
        [":orochimaru", "&#128013; "], //🐍
        [":chicken", "&#128013; "], //🐓
        [":dog", "&#128021; "], //🐕
        [":pig", "&#128022; "], //🐖
        [":hawk", "&#128022; "], //🐖
        [":octopus", "&#128025; "], //🐙
        [":ant", "&#128028; "], //🐜
        [":bee", "&#128029; "], //🐝
        [":sum_sum", "&#128029; "], //🐝
        [":fish", "&#128031; "], //🐟
        [":blop", "&#128031; "], //🐟
        [":blup", "&#128031; "], //🐟
        [":exotic_fish", "&#128032; "], //🐠
        [":puffer_fish", "&#128033; "], //🐡
        [":turtle", "&#128034; "], //🐢
        [":penguin", "&#128039; "], //🐧
        [":face_dog", "&#128054; "], //🐶
        [":face_mice", "&#128048; "], //🐰
        [":face_cat", "&#128049; "], //🐱
        [":face_monkey", "&#128053; "], //🐵
        [":face_frog", "&#128056; "], //🐸
        [":106", "&#128056; "], //🐸
        [":oink_oink", "&#128061; "], //🐽
        [":unicorn", "&#129412; "], //🦄
        [":batman", "&#129415; "], //🦇
        [":fox", "&#129418; "], //🦊
        [":butterfly", "&#129419; "], //🦋

        [":eye", "&#128065; "], //👁
        [":2eyes", "&#128064; "], //👀
        [":ear", "&#128066; "], //👂
        [":nose", "&#128067; "], //👃
        [":mouth", "&#128068; "], //👄
        [":tongue", "&#128069; "], //👅
        [":real_heart", "&#129728; "], //🫀
        [":lung", "&#129729; "], //🫁

        [":left_finger", "&#128072; "], //👈
        [":right_finger", "&#128073; "], //👉
        [":top_finger", "&#128070; "], //👆
        [":down_finger", "&#128071; "], //👇
        [":fist", "&#128074; "], //👊
        [":+1", "&#128077; "], //👍
        [":like", "&#128077; "], //👍
        [":thumbs_up", "&#128077; "], //👍
        [":-1", "&#128078; "], //👎
        [":dislike", "&#128078; "], //👎
        [":thumbs_down", "&#128078; "], //👎
        [":shut_up", "&#128405; "], //🖕
        [":middle_finger", "&#128405; "], //🖕

        [":flame", "&#128293; "], //🔥
        [":ghost", "&#128123; "], //👻
        [":gun", "&#128299; "], //🔫
        [":pewpew", "&#128299; "], //🔫
        [":microscope", "&#128300; "], //🔬
        [":rocket", "&#128640; "], //🚀
        [":robot", "&#129302; "], //🤖
        [":beepboop", "&#129302; "], //🤖
        [":syringe", "&#128137; "], //💉
        [":vaccine", "&#128137; "], //💉
        [":corona", "&#129440; "], //🦠
        [":covid-19", "&#129440; "], //🦠
        [":severe_acute_respiratory_syndrome_coronavirus_type_2", "&#129440; "], //🦠
        [":virus", "&#129440; "], //🦠
        [":microbe", "&#129440; "], //🦠
        [":bacteria", "&#129440; "], //🦠
        [":drug", "&#128138; "], //💊
        [":pill", "&#128138; "], //💊
        [":dna", "&#129516; "], //🧬
        [":deoxyribonucleic_acid", "&#129516; "], //🧬
        [":internet", "&#127760; "], //🌐
        [":poop", "&#128169; "], //💩
        [":shit", "&#128169; "], //💩
        [":stonks", "&#128200; "], //📈
        [":yen", "&#128180; "], //💴
        [":dollar", "&#128181; "], //💵
        [":euro", "&#128182; "], //💶
        [":pound", "&#128183; "], //💷
        [":paperclip", "&#128206; "], //📎
        [":clippy", "&#128206; "], //📎
        [":phone", "&#128241; "], //📱
        [":computer", "&#128187; "], //💻

        [":rex", "&#129430; "], //🦖
        [":molly", "&#128571; "], //😻
        [":merlin", "&#128571; "], //😻

        [":chequered_flag", "&#127937; "], //🏁
        [":black_flag", "&#127988; "], //🏴
        [":white_flag", "&#127987; "], //🏳
        [":rainbow_flag", "&#127987;&#65039;&#8205;&#127752"], //🏳️‍🌈
        [":lgbtq", "&#127987;&#65039;&#8205;&#127752"], //🏳️‍🌈
        [":austrian_flag", "&#127462;&#127481; "], //🇦🇹
        [":australian_flag", "&#127462;&#127482; "], //🇦🇺
        [":canadian_flag", "&#127464;&#127462; "], //🇨🇦
        [":switzer_flag", "&#127464;&#127469; "], //🇨🇭
        [":chinese_flag", "&#127464;&#127475; "], //🇨🇳
        [":german_flag", "&#127465;&#127466; "], //🇩🇪
        [":denmark_flag", "&#127465;&#127472; "], //🇩🇰
        [":egypt_flag", "&#127466;&#127468; "], //🇪🇬
        [":spanish_flag", "&#127466;&#127480; "], //🇪🇸
        [":eu_flag", "&#127466;&#127482; "], //🇪🇺
        [":european_union", "&#127466;&#127482; "], //🇪🇺
        [":european_union_flag", "&#127466;&#127482; "], //🇪🇺
        [":french_flag", "&#127467;&#127479; "], //🇫🇷
        [":uk_flag", "&#127468;&#127463; "], //🇬🇧
        [":greek_flag", "&#127468;&#127479; "], //🇬🇷
        [":indian_flag", "&#127470;&#127475; "], //🇮🇳
        [":italian_flag", "&#127470;&#127481; "], //🇮🇹
        [":japanese_flag", "&#127471;&#127477; "], //🇯🇵
        [":russian_flag", "&#127479;&#127482; "], //🇷🇺
        [":swedish_flag", "&#127480;&#127466; "], //🇸🇪
        [":us_flag", "&#127482;&#127480; "], //🇺🇸
        [":united_states", "&#127482;&#127480; "], //🇺🇸
        [":united_states_of_america", "&#127482;&#127480; "], //🇺🇸

        [":a_disapproval", "ಠ_ಠ "],
        [":a_angry", "(╬ ಠ益ಠ) "],
        [":4_chan", "( ͡° ͜ʖ ͡°) "],
        [":a_crying", "ಥ_ಥ "],
        [":a_concerned", "(´･_･`) "],
        [":a_loving_face", "♥‿♥ "],
        [":a_kiss", "( ˘ ³˘)♥ "],
        [":a_injured", "(҂◡_◡) "],
        [":a_rolling_eyes", "⥀.⥀ "],
        [":a_eyes_on_fire", "♨_♨ "],
        [":a_seal", "(ᵔᴥᵔ) "],

        [":a_shrug", "¯\\_(ツ)_/¯ "],
        [":a_fight", "ლ(｀ー 'ლ) "],
        [":a_strong", "ᕙ(⇀‸↼)ᕗ "],
        [":a_kirby", "⊂(◉‿◉)つ "],
        [":a_hug", "(づ￣ ³￣)づ "],
        [":a_shades", "(っ▀¯▀)つ "],

        [":a_minion_bear", "ʕ-ᴥ-ʔ "],
        [":a_flying_pig", "ح˚௰˚づ"],

        [":a_table_flip", "(╯°□°）╯︵ ┻━┻ "],
        [":a_unflip", "┬─┬ ノ( ゜-゜ノ) "]
    ]
    let help = "<div class='help'> /big{emoji list}"


    for (let i = 0; i < emojiList.length; i++) {
        help += "<br>" + emojiList[i][0] + "     " + emojiList[i][1]
        if (text === emojiList[i][0])
            hasEmoji = true
        for (let a = 0; a < text.length; a++)
            text = text.replace(emojiList[i][0], emojiList[i][1])
    }
    text = text.replace(":help", help + "</div>")

    return text
}

function setFormattingHTML(text) {
    let formattingList = [
        ["/n", "<br>"], //linebreak
        ["/large{", "<p style='font-size: 3em' class='blankP'>"], //large text
        ["/big{", "<p style='font-size: 1.5em' class='blankP'>"], //big text
        ["/small{", "<p style='font-size: 0.7em' class='blankP'>"], //small text
        ["/tiny{", "<p style='font-size: 0.5em' class='blankP'>"], //tiny text
        ["/u{", "<p style='text-decoration: underline' class='blankP'>"], //underline
        ["/bold{", "<p style='font-weight: bold;' class='blankP'>"], //underline
        ["/italic{", "<p style='font-style: italic;' class='blankP'>"], //italic

        ["/spoiler{", "<p class='blankP spoiler spoilerHidden' onclick='this.className = \"blankP spoiler spoilerVisible\"'>"], //spoiler

        ["/d{", "<p style='color: var(--text)' class='blankP'>"], //default

        ["/b{", "<p style='color: var(--blue)' class='blankP'>"], //blue
        ["/r{", "<p style='color: var(--red)' class='blankP'>"], //red
        ["/g{", "<p style='color: var(--green)' class='blankP'>"], //green
        ["/y{", "<p style='color: var(--yellow)' class='blankP'>"], //yellow
        ["/o{", "<p style='color: var(--orange)' class='blankP'>"], //orange
        ["/p{", "<p style='color: var(--purple)' class='blankP'>"], //purple

        ["/n_b{", "<p style='color: var(--n_blue)' class='blankP'>"], //blue
        ["/n_r{", "<p style='color: var(--n_red)' class='blankP'>"], //red
        ["/n_g{", "<p style='color: var(--n_green)' class='blankP'>"], //green
        ["/n_y{", "<p style='color: var(--n_yellow)' class='blankP'>"], //yellow
        ["/n_o{", "<p style='color: var(--n_orange)' class='blankP'>"], //orange
        ["/n_p{", "<p style='color: var(--n_purple)' class='blankP'>"], //purple

        ["/rainbow{", "<p class='blankP rainbow'>"], //rainbow
        ["/important{", "<p class='blankP important'>"], //important
        ["/jeb_{", "<p class='blankP rainbow'>"], //rainbow (minecraft easterEgg)
        ["}", "</p>"] //p end
    ]
    let help = "<p style='font-size: 3em' class='blankP'>formatting list</p>"

    for (let i = 0; i < formattingList.length; i++) {
        if (i > 0 && i < formattingList.length-2)
            help += "<br>" + formattingList[i][0] + "}     " + formattingList[i][1] + "text" + "</p>"
        for (let a = 0; a < text.length; a++)
            text = text.replace(formattingList[i][0], formattingList[i][1])
    }
    text = text.replace("/help", help)

    return text
}

function detectEmbed(text) {
    let ytIsLink = false
    let ytLinkList = [ //todo only one item
        ["www.youtube.com/watch?v=", "<div id='player'></div>"],
        ["youtu.be/", "<div id='player'></div>"]
    ]

    let isYT = false;

    for (let i = 0; i < ytLinkList.length; i++) {
        if (text.includes(ytLinkList[i][0])) {
            isYT = true;
            includesYTLink = true;
            ytIsLink = true;
            text = '<a target="_blank" href="' + text + '">' + text + '</a>'
            text += "<br><div id='player'></div>"
            videoID = text.substring(text.indexOf(ytLinkList[i][0]) + ytLinkList[i][0].length, text.indexOf(ytLinkList[i][0]) + ytLinkList[i][0].length + 11)
        }
    }
    if (text.includes('https://') || text.includes('http://')) {
        if (!isYT) {
            text = '<a target="_blank" href="' + text + '">' + text + '</a>'
        }
    }

    return text
}

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: '288',
        width: '512',
        videoId: videoID,
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerReady(event) {
    event.target.playVideo();
}

function onPlayerStateChange(event) {
    if (event.data === YT.PlayerState.PLAYING && !done) {
        setTimeout(stopVideo, 6000);
        done = true;
    }
}

function stopVideo() {
    player.stopVideo();
}

function setYoutubeVideo() {
    if (includesYTLink && document.getElementById("ytScript") !== null) {
        onYouTubeIframeAPIReady()
    }
}

function alertInjection() {
    alert('Pim found a possible Injection, that could harm you.\nIt could be a button, event or script.\nWe blocked it to protect you, your computer and the chat!');
}

function injectionProtection(text) {
    let formattingList = [
        ['onclick='],
        ['onload='],
        ['<button'],
        ['<script'],
        ['<a']
    ];
    for (let i = 0; i < formattingList.length; i++) {
        if (text.includes(formattingList[i])) {
            text = ('--found injection <a style="text-decoration: underline" onclick="alertInjection()">help</a>--');
            break;
        }
    }
    return text;
}

function checkInkection(text) {
    let formattingList = [
        ['onclick='],
        ['onload='],
        ['<button'],
        ['<script'],
        ['<a']
    ];
    for (let i = 0; i < formattingList.length; i++) {
        if (text.includes(formattingList[i])) {
            return true;
        }
    }
    return false;
}

function biggerEmojiTest(text, resUser, time) {
    let regex = /(?=\p{Emoji})(?!\p{Number})/u; //find emojis and tripples them in size

    let formattedText;
    if (regex.test(text) && countEmojis(text) === 1 || hasEmoji) {
        if (resUser === user)
            formattedText = "<div class='yourMessage' style='font-size: 3em'>" + text + "<br></div>";
        else
            formattedText = "<div class='opponentMessage' style='font-size: 3em'>" + text + "<br></div>"
    } else { //normal text
        if (resUser === user)
            formattedText = "<div class='yourMessage'>" + text + "<br></div>";
        else
            formattedText = "<div class='opponentMessage'>" + text + "<br></div>"
    }

    hasEmoji = false
    return formattedText;
}

/**
 * @param {*} response
 * @param {*} cryptoKey
 * @param {boolean} getMessageMode
 */
function formatMessage() {
    let i = messages.length - 1
    let mesUser = messages[i]["user"]
    let text = messages[i]["message"]
    let time = getTime(messages[i]["time"])

    if (text === '') {
        console.log('key')
        text = 'Warning: encryption key changed or does not work! <a href="javascript:onclick=changeKey()">Click here to change the key</a>';
        text = setFormattingHTML(text);
    } else if (checkInkection(text)) {
        text = injectionProtection(text);
        text = setFormattingHTML(text);
        text = biggerEmojiTest(text, mesUser, time);
    } else {
        console.log(messages) //todo time doesnt work
        text = setEmoji(text);
        text = setFormattingHTML(text);

        text = commands(text);
        text = detectEmbed(text);
        text = biggerEmojiTest(text, mesUser, time);
    }

    console.log(time)

    if (lastTime > 0 && lastUser === mesUser) { //300000
        let timeDiv = document.getElementById("" + lastTime - 1);
        timeDiv.parentNode.removeChild(timeDiv);
    }


    if (mesUser !== user)
        text += "<div class='time' id='" + lastTime + "' style='text-align: left'>" + time + "</div>"
    else
        text += "<div class='time' id='" + lastTime + "' style='text-align: right'>" + time + "</div>"
    lastTime += 1
    lastUser = mesUser
    lastMS = messages[i]["time"]


    if (lastTime === 1)
        document.getElementsByClassName("seeMessages")[0].innerHTML = ""
    let message = document.createElement("div");
    message.innerHTML = text
    document.getElementsByClassName("seeMessages")[0].appendChild(message);
    document.getElementsByClassName("seeMessages")[0].scrollTo(0, document.body.scrollHeight);

    setYoutubeVideo()
}