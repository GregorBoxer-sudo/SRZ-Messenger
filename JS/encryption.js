function encrypt(message, key) {
    let encrypt = CryptoJS.AES.encrypt(message, key).toString();
    return encrypt;
}

function decrypt(message, key) {
    decryptedJSON = CryptoJS.AES.decrypt(message, key).toString(CryptoJS.enc.Utf8);
    return decryptedJSON;
}

function changeKey() {
    newKey = getKey();
    sessionStorage.setItem('key', newKey);
    getMessages();
}

function validKey(key) {
    valid = 'unknown Error';
    if (key.length >= 8) {
        var pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*.,?]).+$");
        if (pattern.test(key)) {
            valid = 'true';
        } else {
            valid = "Key not valid!\nThe key needs to contain at least one lowercase character, one uppercase character, one numeric character and one special character."
        }
    } else {
        valid = "Key is to short!\nThe key must consist of 8 characters or more.";
    }
    return valid;
}

function getKey() {
    var newKey = '';
    if (sessionStorage.getItem('key') !== null) {
        if (!confirm('You already set a key. Are you sure you want to change it?')) {
            return sessionStorage.getItem('key');
        }
        while (true) {
            newKey = prompt("Enter the new Key for message-encryption:");
            valid = validKey(newKey);
            if ('true' != valid) {
                alert(valid);
            } else {
                alert('To reload the chat with the new key, write a message or reload the page.');
                return newKey;
            }
        }
    }
}