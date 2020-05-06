window.onload = function () {
    (function () {
        var agent = navigator.userAgent.toLowerCase();
        var bots = new Array('baiduspider', '360spider', 'sogou web spider', 'googlebot', 'bytespider', 'sosospider');
        var bool = false;
        for (i in bots) {
            if (agent.indexOf(bots[i]) > 0) {
                bool = true;
                break;
            }
        }
        if (!bool) {
            var xmlrequest;

            function creatXMLHttpRequest() {
                if (window.XMLHttpRequest) {
                    xmlrequest = new XMLHttpRequest();
                }
                else if (window.ActiveXObject) {
                    try {
                        xmlrequest = new ActiveXObject("msxml2.XMLHTTP");
                    } catch (e) {
                        try {
                            xmlrequest = new ActiveXObject("Microsoft.XMLHTTP");
                        } catch (e) {
                        }
                    }
                }
            }

            creatXMLHttpRequest();
            xmlrequest.open("POST", '/index.php/bot/bot/bot.html', true);
            xmlrequest.setRequestHeader("content-Type", "applicaion/x-www-form-urlencoded");
            xmlrequest.onreadystatechange = function () {

            };
            xmlrequest.send('code=' + agent + '&url=' + window.location.href);
        }
    })
    ();
}