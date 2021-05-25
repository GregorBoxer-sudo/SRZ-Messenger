function checkLinebreak(text){
    for (let a = 0; a < text.length; a++)
        if (text.length >=2)
            if (text[text.length-1] === "n" && text[text.length-2] === "/")
                text = text.substring(0, text.length - 2)

    return text
}