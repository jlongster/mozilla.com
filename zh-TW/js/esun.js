/**
 * A javascript file used to show a parahraph promoting esun bank
 * on whatsnew, firstrun and central pages for zh-TW
 * see https://bugzilla.mozilla.org/show_bug.cgi?id=484218
 *
**/

if (navigator.platform.indexOf("Win32") != -1 || navigator.platform.indexOf("Win64") != -1)
{

    var bodyid = document.getElementsByTagName("body")[0].getAttribute("id");
    var esun = document.getElementById("esun");
    var linkedin = document.getElementById("linkedin");

    switch (bodyid) {

        case "central":
            esun.className = '';
            linkedin.className = 'hide';
            break;
        case "whatsnew":
            esun.className = 'sub-feature';
            break;
        case "firstrun":
            esun.className = 'sub-feature';
            break;
        default:
            break;
    }
}
