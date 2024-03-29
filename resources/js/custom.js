/*********************************/
/*         INDEX                 */
/*================================
 *     01.  Preloader            *
 *     02.  Menus                *
 *     03.  Back to top          *
 ================================*/
window.addEventListener("load", fn, false);

//  window.onload = function loader() {
function fn() {
    // Preloader
    if (document.getElementById("preloader")) {
        setTimeout(() => {
            document.getElementById("preloader").style.visibility = "hidden";
            document.getElementById("preloader").style.opacity = "0";
        }, 350);
    }
}
/*********************/
/*     Menus         */
/*********************/

// Function to handle scroll event
function windowScroll() {
    const navbar = document.getElementById("navbar");

    // Check if the page is scrolled down
    if (
        document.body.scrollTop >= 50 ||
        document.documentElement.scrollTop >= 50
    ) {
        navbar.classList.add("is-sticky");
    } else {
        navbar.classList.remove("is-sticky");
    }
}

// Add event listener for scroll event
window.addEventListener("scroll", windowScroll);

// Call the function on page load
window.onload = windowScroll;

// Navbar Active Class
try {
    var spy = new Gumshoe("#navbar-navlist a", {
        // Active classes
        // navClass: 'active', // applied to the nav list item
        // contentClass: 'active', // applied to the content
        offset: 80,
    });
} catch (error) {}

// Smooth scroll
try {
    var scroll = new SmoothScroll("#navbar-navlist a", {
        speed: 800,
        offset: 80,
    });
} catch (error) {}

// Menu Collapse
const toggleCollapse = (elementId, show = true) => {
    const collapseEl = document.getElementById(elementId);
    if (show) {
        collapseEl.classList.remove("hidden");
    } else {
        collapseEl.classList.add("hidden");
    }
};

document.addEventListener("DOMContentLoaded", () => {
    // Toggle target elements using [data-collapse]
    document
        .querySelectorAll("[data-collapse]")
        .forEach(function (collapseToggleEl) {
            var collapseId = collapseToggleEl.getAttribute("data-collapse");

            collapseToggleEl.addEventListener("click", function () {
                toggleCollapse(
                    collapseId,
                    document
                        .getElementById(collapseId)
                        .classList.contains("hidden")
                );
            });
        });
});

window.toggleCollapse = toggleCollapse;

/*********************/
/*    Back To Top    */
/*********************/

window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    var mybutton = document.getElementById("back-to-top");
    if (mybutton != null) {
        if (
            document.body.scrollTop > 500 ||
            document.documentElement.scrollTop > 500
        ) {
            mybutton.classList.add("block");
            mybutton.classList.remove("hidden");
        } else {
            mybutton.classList.add("hidden");
            mybutton.classList.remove("block");
        }
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

/*********************/
/* Dark & Light Mode */
/*********************/
try {
    const switcher = document.getElementById("chk");

    function changeTheme() {
        const htmlTag = document.getElementsByTagName("html")[0];

        if (switcher.checked) {
            htmlTag.className = "dark";
            localStorage.setItem("theme", "dark");
        } else {
            htmlTag.className = "light";
            localStorage.setItem("theme", "light");
        }
    }

    function setInitialTheme() {
        const savedTheme = localStorage.getItem("theme") || "light";
        const htmlTag = document.getElementsByTagName("html")[0];

        if (savedTheme === "dark") {
            switcher.checked = true;
            htmlTag.className = "dark";
        } else {
            switcher.checked = false;
            htmlTag.className = "light";
        }
    }

    // Call setInitialTheme on page load
    setInitialTheme();

    switcher.addEventListener("change", changeTheme);
} catch (err) {
    console.error(err);
}

/*********************/
/*  Active Sidebar   */
/*********************/
(function () {
    var current = location.pathname.substring(
        location.pathname.lastIndexOf("/") + 1
    );
    if (current === "") return;
    var menuItems = document.querySelectorAll(".sidebar-nav a");
    for (var i = 0, len = menuItems.length; i < len; i++) {
        if (menuItems[i].getAttribute("href").indexOf(current) !== -1) {
            menuItems[i].parentElement.className += " active";
        }
    }
})();
