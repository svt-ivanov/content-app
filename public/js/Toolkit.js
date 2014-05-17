var Toolkit = {};

Toolkit.createXHR = function(url, options) {
    var xhr = false;

    if (window.XMLHttpRequest) {
        xhr = new XMLHttpRequest();
    // support for IE6
    } else if (window.ActiveXObject) {
        try {
            xhr = new ActiveXObject('Microsoft.XMLHTTP');
        } catch(e) {
            xhr = false;
        }
    }

    if (xhr) {
        options = options || {};
        options.method = options.method || 'GET';
        options.data = options.data || null;

        if (options.data) {
            var qstring = [];

            for (var key in options.data) {
                qstring.push(encodeURIComponent(key)+'='+encodeURIComponent(options.data[key]));
            }

            options.data = qstring.join('&');
        }

        if (options.cache == false && options.method.toUpperCase() == 'GET') {
            // attach unique value to the link make it non-cacheable
            url = url + '?_=' + new Date().getTime();
        }

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 1) {
                if (options.before) {
                    options.before.call(xhr);
                }
            }

            if ((xhr.readyState == 4) && (xhr.status == 200 || xhr.status == 304)) {
                // define the header 'Content-Type'
                var contentType = xhr.getResponseHeader('Content-Type');

                // set xhr object and 'response' in the callback function
                if (options.complete) {
                    if (contentType == 'application/json') {
                        options.complete.call(xhr, JSON.parse(xhr.responseText));

                    } else if (contentType == 'text/xml' || contentType == 'application/xml') {
                        options.complete.call(xhr, xhr.responseXML);

                    } else {
                        options.complete.call(xhr, xhr.responseText);
                    }
                }
            }
        };

        xhr.open(options.method, url, true);
        return xhr;
    } else {
        return false;
    }
};

Toolkit.ajax = function(url, options) {
    var xhr = Toolkit.createXHR(url, options);

    if (xhr) {
        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

        if (options.method.toUpperCase() == 'POST') {
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        }

        xhr.send(options.data);
    }
};