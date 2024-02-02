/***********************************/
/*         INDEX                   */
/*==================================
 *     01.  Tobii lightbox         * (For Portfolio pages)
 *     02.  Data Counter           *
 *     03.  Typed Text animation   *
 *     04.  Back Button            *
 *     04.  Contact Js             *
 ==================================*/

//=========================================//
/*/*            01) Tobii lightbox         */
//=========================================//

try {
    const tobii = new Tobii();
} catch (err) {}

//=========================================//
/*/*            03) Data Counter           */
//=========================================//

try {
    const counter = document.querySelectorAll(".counter-value");
    const speed = 2500; // The lower the slower

    counter.forEach((counter_value) => {
        const updateCount = () => {
            const target = +counter_value.getAttribute("data-target");
            const count = +counter_value.innerText;

            // Lower inc to slow and higher to slow
            var inc = target / speed;

            if (inc < 1) {
                inc = 1;
            }

            // Check if target is reached
            if (count < target) {
                // Add inc to count and output in counter_value
                counter_value.innerText = (count + inc).toFixed(0);
                // Call function every ms
                setTimeout(updateCount, 1);
            } else {
                counter_value.innerText = target;
            }
        };

        updateCount();
    });
} catch (err) {}

//=========================================//
/*/* 03) Typed Text animation (animation) */
//=========================================//

try {
    var TxtType = function (el, toRotate, period) {
        this.toRotate = toRotate;
        this.el = el;
        this.loopNum = 0;
        this.period = parseInt(period, 10) || 2000;
        this.txt = "";
        this.tick();
        this.isDeleting = false;
    };

    TxtType.prototype.tick = function () {
        var i = this.loopNum % this.toRotate.length;
        var fullTxt = this.toRotate[i];
        if (this.isDeleting) {
            this.txt = fullTxt.substring(0, this.txt.length - 1);
        } else {
            this.txt = fullTxt.substring(0, this.txt.length + 1);
        }
        this.el.innerHTML = '<span class="wrap">' + this.txt + "</span>";
        var that = this;
        var delta = 200 - Math.random() * 100;
        if (this.isDeleting) {
            delta /= 2;
        }
        if (!this.isDeleting && this.txt === fullTxt) {
            delta = this.period;
            this.isDeleting = true;
        } else if (this.isDeleting && this.txt === "") {
            this.isDeleting = false;
            this.loopNum++;
            delta = 500;
        }
        setTimeout(function () {
            that.tick();
        }, delta);
    };

    function typewrite() {
        if (toRotate === "undefined") {
            changeText();
        } else var elements = document.getElementsByClassName("typewrite");
        for (var i = 0; i < elements.length; i++) {
            var toRotate = elements[i].getAttribute("data-type");
            var period = elements[i].getAttribute("data-period");
            if (toRotate) {
                new TxtType(elements[i], JSON.parse(toRotate), period);
            }
        }
        // INJECT CSS
        var css = document.createElement("style");
        css.type = "text/css";
        css.innerHTML =
            ".typewrite > .wrap { border-right: 0.08em solid transparent}";
        document.body.appendChild(css);
    }
    window.onload(typewrite());
} catch (err) {}

//=========================================//
/*/*            04) Back Button            */
//=========================================//
document
    .getElementsByClassName("back-button")[0]
    ?.addEventListener("click", (e) => {
        if (document.referrer !== "") {
            e.preventDefault();
            window.location.href = document.referrer;
        }
    });

if (document.getElementsByClassName("tiny-two-item").length > 0) {
    var slider = tns({
        container: ".tiny-two-item",
        controls: true,
        mouseDrag: true,
        loop: true,
        rewind: true,
        autoplay: true,
        autoplayButtonOutput: false,
        autoplayTimeout: 3000,
        navPosition: "bottom",
        controlsText: [
            '<i class="mdi mdi-chevron-left "></i>',
            '<i class="mdi mdi-chevron-right"></i>',
        ],
        nav: false,
        speed: 400,
        gutter: 0,
        responsive: {
            768: {
                items: 2,
            },
        },
    });
}

//=========================================//
/*/*            05) Contact Form           */
//=========================================//
try {
    function validateForm() {
        var name = document.forms["myForm"]["name"].value;
        var email = document.forms["myForm"]["email"].value;
        var subject = document.forms["myForm"]["subject"].value;
        var comments = document.forms["myForm"]["comments"].value;
        document.getElementById("error-msg").style.opacity = 0;
        document.getElementById("error-msg").innerHTML = "";
        if (name == "" || name == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Name*</div>";
            fadeIn();
            return false;
        }
        if (email == "" || email == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Email*</div>";
            fadeIn();
            return false;
        }
        if (subject == "" || subject == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Subject*</div>";
            fadeIn();
            return false;
        }
        if (comments == "" || comments == null) {
            document.getElementById("error-msg").innerHTML =
                "<div class='alert alert-warning error_message'>*Please enter a Comments*</div>";
            fadeIn();
            return false;
        }
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("simple-msg").innerHTML =
                    this.responseText;
                document.forms["myForm"]["name"].value = "";
                document.forms["myForm"]["email"].value = "";
                document.forms["myForm"]["subject"].value = "";
                document.forms["myForm"]["comments"].value = "";
            }
        };
        xhttp.open("POST", "php/contact.php", true);
        xhttp.setRequestHeader(
            "Content-type",
            "application/x-www-form-urlencoded"
        );
        xhttp.send(
            "name=" +
                name +
                "&email=" +
                email +
                "&subject=" +
                subject +
                "&comments=" +
                comments
        );
        return false;
    }

    function fadeIn() {
        var fade = document.getElementById("error-msg");
        var opacity = 0;
        var intervalID = setInterval(function () {
            if (opacity < 1) {
                opacity = opacity + 0.5;
                fade.style.opacity = opacity;
            } else {
                clearInterval(intervalID);
            }
        }, 200);
    }
} catch (error) {}
