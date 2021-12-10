function validate() {
    var validation = validator();

    if (!validation.result) {
        printError(validation.error);
        return false;
    } else
        return false;
}


function validator() {
    var error = '';
    var email = document.getElementById("email1").value;
    var terms = document.getElementById("terms");

    var result = {result: false, error: error};

    if (!terms.checked) {
        result.error = "You must accept the terms and conditions";
        return result;
    }
    if (!checkValidEmail(email)) {
        result.error = "Please provide a valid e-mail address";
        return result;

    }
    if (email == '') {
        result.error = "Email address is required";
        return result;

    }
    if (domainCo(email)) {
        result.error = "We are not accepting subscriptions from Colombia emails";
        return result;

    }
    result.result = true;
    return result;
}

function checkValidEmail(email) {

    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function domainCo(email) {
    var domain = email.split("@")[1].split(".")[1];
    console.log(domain);
    if (domain == 'co')
        return true;
}

function printError(error) {
    var tag = document.createElement("p");
    var text = document.createTextNode(error);
    tag.appendChild(text);

    var element = document.getElementById("errordiv");

    element.innerHTML = tag.innerHTML;
    console.log(element);
    return true;
}

function injectCss(fileName) {

    var head = document.head;
    var link = document.createElement("link");

    link.type = "text/css";
    link.rel = "stylesheet";
    link.href = fileName;

    head.appendChild(link);
}
  