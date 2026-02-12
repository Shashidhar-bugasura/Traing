function max(a, b) {
    if (a > b) {
        return a;
    } else {
        return b;
    }
}

function showMax() {
    let a = Number(document.getElementById("num1").value);
    let b = Number(document.getElementById("num2").value);
    document.getElementById("max").innerText = " Max = " + max(a, b);
}


function reverse(str) {
    let result = "";
    for (let i = str.length - 1; i >= 0; i--) {
        result += str[i];
    }
    return result;
}

function showReverse() {
    let s = document.getElementById("revString").value;
    document.getElementById("reverse").innerText = reverse(s);
}


function FindLongestWord(words) {
    let longest = "";
    for (let i = 0; i < words.length; i++) {
        if (words[i].length > longest.length) {
            longest = words[i];
        }
    }
    return longest;
}

function showLargestWord() {
    let input = document.getElementById("wordList").value;
    let words = input.split(",");
    document.getElementById("largestWord").innerHTML =
        FindLongestWord(words);
}


function saveCookie() {
    let name = document.getElementById("username").value;
    let phone = document.getElementById("phone").value;

    document.cookie = "username=" + name;
    document.cookie = "phone=" + phone;

    alert("Details saved in cookie");
}


window.onload = function () {
    let cookies = document.cookie.split(";");

    let name = "";
    let phone = "";

    for (let i = 0; i < cookies.length; i++) {
        let c = cookies[i].trim();

        if (c.startsWith("username=")) {
            name = c.substring(9);
        }
        if (c.startsWith("phone=")) {
            phone = c.substring(6);
        }
    }

    if (name !== "") {
        document.getElementById("header").innerHTML = name;
        document.getElementById("footer").innerHTML =
            "Phone: " + phone;
    }
};
$(document).ready(function () {

    // input background color changed and border set to none
    $("input").css({
        "background-color": "#FFFF88",
        "border": "none"
    });

    // Table border color and text color changed
    $("table").css("border-color", "#FF1A00");
    $("table").css("color", "#CC0000");

    //footer hidden
    $("#footer").hide();

    // added new div tag with references id and added some references
    $("<div id='references'>" +
        "<h3>References</h3>" +
        "<p>Reference 1: VTU University</p>" +
        "<p>Reference 2: Moolya Software Testing</p>" +
      "</div>").insertBefore("#footer");

    // header properties changed for animation purpose
    $("#header").css({
        "height": "10px",
        "overflow": "hidden",
        "font-size":"15px"
    });

    // header animation on mouseenter
    $("#header").mouseenter(function () {
        $(this).animate({ height: "40px",fontSize:"35px"},700);
    });

    // header animation on mouseleave
    $("#header").mouseleave(function () {
        $(this).animate({ height: "10px" ,fontSize:"15px"},700);
    });

    // footer slideDown effect
    $("#footer").slideDown(10000,function () {
        alert("Footer animation completed!");
    });

});
