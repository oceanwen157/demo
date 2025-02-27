/**
 * copy
 */
(function (doc, win) {
    class CopyLoader {
        // copy
        constructor(e) {
            this.copy(e)
        }

        // copy function
        copy(e) {
            const _this = this;

            return new Promise((resolve, reject) => {
                try {
                    var obj = window.location.href;
                    if (!obj) {
                        return false;
                    }
                    if (e) {
                        obj = e;
                    }
                    var text;
                    if (typeof (obj) == 'object') {
                        if (obj.nodeType) { // DOM node
                            obj = $(obj); // to jQuery object
                        }
                        try {
                            text = obj.text();
                            if (!text) { // Maybe <textarea />
                                text = obj.val();
                            }
                        } catch (err) { // as JSON
                            text = JSON.stringify(obj);
                        }
                    } else {
                        text = obj;
                    }

                    var $temp = $('<textarea>');
                    $('body').append($temp);
                    $temp.val(text).select();
                    var res = document.execCommand('copy');
                    $temp.remove();
                    $Alert({ message: '分享链接复制成功', duration: 1000 });
                    return res;
                    
                } catch (error) {
                    reject(error);
                }
            });
        }
    }

    win['$Copy'] = (e) => new CopyLoader(e);

})(document, window);
