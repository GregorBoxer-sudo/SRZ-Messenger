document.addEventListener('keydown', (e) => {
    if (e.code === "Enter" && e.shiftKey)
        document.getElementById("messageInput").value += "/n";
    if (e.code === "Enter" && !e.shiftKey)
        sendMessage();
})