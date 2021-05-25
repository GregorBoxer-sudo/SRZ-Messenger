document.addEventListener('keydown', (e) => {
    if (e.code === "Enter" && e.shiftKey)
        if(document.getElementById("messageInput").value !== "")
            document.getElementById("messageInput").value += "/n";
    if (e.code === "Enter" && !e.shiftKey)
        sendMessage();
})