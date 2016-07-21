window.onload = function(){
    var message = document.querySelector(".alert");
    if (message.innerHTML == "You have been already logged in") {

        // disable headers
        var h2 = document.querySelectorAll("h2");
        var i;
        for (i = 0; i < h2.length; i++)
        {
            h2[i].style.color = "#cccccc";
        }

        // disable label
        var label = document.querySelectorAll("label");
        for (i = 0; i < label.length; i++)
        {
            label[i].style.color = "#cccccc";
        }

        // disable input
        document.querySelector("#submit").style.background = "#cccccc";
        var input = document.querySelectorAll("input");
        for (i = 0; i < input.length; i++)
        {
            input[i].disabled = true;
        }

        // disable link
        document.querySelector("h2 a").removeAttribute("href");
    }
};