function encrypt(message, key) {
    return CryptoJS.AES.encrypt(message, key).toString();
}

function decrypt(message, key) {
    return CryptoJS.AES.decrypt(message, key).toString(CryptoJS.enc.Utf8);
}

function changeKey() {
    let newKey = getKey();
    sessionStorage.setItem('key', newKey);
    location.reload();
}

function validKey(key) {
    let valid = "unknown Error";
    if (key.length >= 8) {
        const pattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-+_!@#$%^&*.,?]).+$");
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
    let newKey = '';
    let valid;
    if (sessionStorage.getItem('key') !== null) {
        if (!confirm('You already set a key. Are you sure you want to change it?')) {
            return sessionStorage.getItem('key');
        }
        while (true) {
            newKey = prompt("Enter the new Key for message-encryption:");
            valid = validKey(newKey);
            if ('true' !== valid) {
                alert(valid);
            } else {
                return newKey;
            }
        }
    }
}