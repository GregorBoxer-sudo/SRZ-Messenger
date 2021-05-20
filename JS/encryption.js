function encrypt(message, key) {
    let encrypt = CryptoJS.AES.encrypt(message, key).toString();
    return encrypt;
}

function decrypt(message, key) {
    decryptedJSON = CryptoJS.AES.decrypt(message, key).toString(CryptoJS.enc.Utf8);
    console.log(key);
    return decryptedJSON;
}