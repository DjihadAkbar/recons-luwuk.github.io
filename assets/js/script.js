$(document).ready(function(){
    var count = 0;

    $('#sidebar').mCustomScrollbar({
        theme: 'minimal'
    });

    

    $('#sidebarCollapse').click(function(){
        $('#sidebar').toggleClass('tutup');
        $('#content').toggleClass('layarPenuh');
    });

    //Sticky Navbar
    window.onscroll = function() {myFunction()};

    // Get the navbar
    var navbar = document.getElementById("navbar-dashboard");
    var content = document.getElementById("content");

    // Get the offset position of the navbar
    var sticky = navbar.offsetTop;

    // Add the sticky class to the nabar when you reach its scroll position. Remove "sticky" when you leave the scroll position
    function myFunction() {
    if (window.pageYOffset >= sticky) {
        navbar.classList.add("sticky")
        content.classList.add("sticky")
    } else {
        navbar.classList.remove("sticky");
        content.classList.remove("sticky");
    }
    }

    if(count != 1){
        if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)) {
            $('#sidebar').toggleClass('tutup');
            $('#content').toggleClass('layarPenuh');
        }
        count = 1;
    }

        
});

