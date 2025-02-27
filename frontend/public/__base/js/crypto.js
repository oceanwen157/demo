// import CryptoJS from "crypto-js";

// 

(function (doc, win) {
    const cryptodata = __APP_CONFIG__.crypto;
    const cc = (e, o = true) => o ? (CryptoJS.enc.Utf8.parse(e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""))) : (e.split("_").map((a) => String.fromCharCode(parseInt(a))).join(""));
    const rc = (e) => (e.split('').map((char) => char.charCodeAt(0)).join('_'));

    // 报文加密
    function Encrypt(word) {
        word = (typeof word == "object") ? JSON.stringify(word) : word;
        let srcs = CryptoJS.enc.Utf8.parse(word);
        let encrypted = CryptoJS.AES.encrypt(srcs, cc(cryptodata.key), { iv: cc(cryptodata.iv), mode: CryptoJS.mode[cryptodata.mode], padding: CryptoJS.pad[cryptodata.padding] });
        const ciphertext = CryptoJS.enc.Base64.stringify(encrypted.ciphertext);
        const data = { data: ciphertext, timestamp: parseInt(String(Date.now() / 1000)), "client": "ios" };
        const sign = getSign(data);
        return SeralizeOrdered({ ...data, sign });
    }
    
    // 报文解密
    function Decrypt(word, msg) {
        word = (typeof word == "object") ? JSON.stringify(word) : word;
    
        // 1. 创建 AES 加密器
        const decrypt = CryptoJS.AES.decrypt(word, cc(cryptodata.key), { iv: cc(cryptodata.iv), mode: CryptoJS.mode[cryptodata.mode], padding: CryptoJS.pad[cryptodata.padding] });

        // 2. 转换为UTF-8编码
        const decryptedStr = decrypt.toString(CryptoJS.enc.Utf8);

        // 3. 有效数据校验
        const str = decryptedStr ? JSON.parse(decryptedStr.toString()) : {
            data: null,
            msg: msg,
            status: 0
        };
        return str;
    }
    
    // 图片解密
    function DecryptImage(word) {
        const decrypt = CryptoJS.AES.decrypt(word, cc(cryptodata.media_key), { iv: cc(cryptodata.media_iv), mode: CryptoJS.mode[cryptodata.mode], padding: CryptoJS.pad.NoPadding });
        const decryptedStr = decrypt.toString(CryptoJS.enc.Base64);
        return decryptedStr;
    }
    
    // 视频解密
    function DecryptVideo(word) {
        const decrypt = CryptoJS.AES.decrypt(word, cc(cryptodata.media_key), { iv: cc(cryptodata.media_iv), mode: CryptoJS.mode[cryptodata.mode], padding: CryptoJS.pad[cryptodata.padding] });
        const decryptedStr = decrypt.toString(CryptoJS.enc.Utf8);
        return decryptedStr;
    }
    
    // 视频解密
    function MD5(word) {
        const md5Hash = CryptoJS.MD5(word).toString();
        return md5Hash;
    }
    
    
    // IM密钥
    const im_key = CryptoJS.enc.Utf8.parse('Ksl5I9PXK63EdiJh');
    const im_iv = CryptoJS.enc.Utf8.parse('fyMqKuq1a4n0PJwf');
    
    // IM解密
    function DecryptIm(word) {
        const encryptedHexStr = CryptoJS.enc.Base64.parse(word);
        const srcs = CryptoJS.enc.Base64.stringify(encryptedHexStr);
        const decrypt = CryptoJS.AES.decrypt(srcs, im_key, {
            iv: im_iv,
            mode: CryptoJS.mode[cryptodata.mode],
            padding: CryptoJS.pad[cryptodata.padding]
        });
        const decryptedStr = decrypt.toString(CryptoJS.enc.Utf8);
        return JSON.parse(decryptedStr.toString());
      }
      
      // IM加密
      function EncryptIm(word) {
        if (typeof word == "object" && word !== null) word = JSON.stringify(word)
        const srcs = CryptoJS.enc.Utf8.parse(word);
        const encrypted = CryptoJS.AES.encrypt(srcs, im_key, {
            iv: im_iv,
            mode: CryptoJS.mode[cryptodata.mode],
            padding: CryptoJS.pad[cryptodata.padding]
        });
        let data = CryptoJS.enc.Base64.stringify(encrypted.ciphertext);
        return data;
      }
      
    //签名算法
    function getSign(obj) {
        const keyValues = [];
        if (typeof obj.client !== "undefined") {
            keyValues.push(`client=${obj.client}`);
        }
        if (typeof obj.data !== "undefined") {
            keyValues.push(`data=${obj.data}`);
        }
        if (typeof obj.timestamp !== "undefined") {
            keyValues.push(`timestamp=${obj.timestamp}`);
        }
    
        // 1. 参数拼接
        const text = keyValues.join("&") + cc(cryptodata.sign_key, false);
    
        // 2. 计算SHA哈希值
        const sha256Hash = CryptoJS.SHA256(text).toString();
    
        // 3. 计算MD5哈希值
        const md5Hash = CryptoJS.MD5(sha256Hash).toString();
    
        return md5Hash;
    }
    
    function SeralizeOrdered(params, splitStr = "&") {
        let timestamp, data, sign, client;
        for (const i in params) {
            const key = i;
            const value = params[i];
            if (i === "timestamp") {
                timestamp = `${key}=${value}`;
            } else if (i === "data") {
                data = `${key}=${value}`;
            } else if (i === "sign") {
                sign = `${key}=${value}`;
            } else {
                client = `${key}=${value}`;
            }
        }
        return  client+ splitStr + data + splitStr + sign + splitStr +timestamp ;
    };
    
    // 初始化
    win['$CryptoData'] = {
        Decrypt,
        DecryptImage,
        DecryptVideo,
        Encrypt,
        DecryptIm,
        EncryptIm,
        MD5
    };

    // console.log(`@报文加解密加载完成~`);
})(document, window);
