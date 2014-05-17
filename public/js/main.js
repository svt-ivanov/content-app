(function() {
    var form = document.getElementsByTagName('form')[0];

    // Used DOM Level 0 event handller.
    // It is easier for maintaining cross-browser issues.
    form.onsubmit = function() {
        var text = document.getElementById('content').value,
            url = form.getAttribute('action');

        var div = document.getElementById('analysis');
        // clean content in div if it exists already 
        div.innerHTML = '';

        var p = document.createElement('p');
        p.id = 'message-loading';
        p.style.fontSize = '18px';
        p.style.fontWeight = 'bold';
        div.appendChild(p);

        var paragraph = document.getElementById('message-loading'); 
    
        Toolkit.ajax(url, {
            method: 'POST',
            data: {
                content: text
            },
            before: function() {
                var pText = document.createTextNode('Please wait while loading content...');
                paragraph.appendChild(pText);
            },
            complete: function(response) {
                div.removeChild(paragraph);
                div.innerHTML = response;
            }
        });

        // prevent default behavior
        return false;
    };
})();