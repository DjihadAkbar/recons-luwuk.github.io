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

    //Report.php
    //On Change Selected
    $('#jenis_laporan').change(function(){
        $("#form-report").attr("action","report/" + $(this).val()); 
    })

    //Auto Count Jumlah Produksi bersdasarkan nomor seri awal dan akhir
    $('.input-produksi').change(function(){
        $produksi = $(this).attr("name").split(/(?=[A-Z])/);
        if($produksi[1] == "Serial_start" || $produksi[1] == "Serial_end"){
            $produksi[1] = '';
        }
        $saldoAwal = parseInt($('#'+$produksi[0]+$produksi[1]+"Serial_start").val());
        $saldoAkhir = parseInt($('#'+$produksi[0]+$produksi[1]+"Serial_end").val());
        $('#'+$produksi[0]+$produksi[1]).attr("value",($saldoAkhir - $saldoAwal + 1));
    })

    $('.button-collapse').click(function(){
        if($(this).attr("aria-expanded") == 'true'){
            $(this).text("-");
        } else {
            $(this).text("+");
        }
    })

<<<<<<< HEAD
    $(document).on("keydown", ":input:not(textarea)", function(event) {
        // return event.key != "Enter";
        if (event.key === "Enter") {
            var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
            focusable = form.find('input,a,select,button,textarea').filter(':visible');
            next = focusable.eq(focusable.index(this)+1);
            if (next.length) {
                next.focus();
            } else {
                form.submit();
            }
            return false;
        }
    });



    
=======


    $()

>>>>>>> ac529ab6ce9452b844389607085401db5948f94d
    //Auto FIlter Pelabuhan di report
    // $('#pelabuhan_asal_report').change(function(){
    //     var $pelabuhan = $(this).val();
    //     $('#lintasan_report option').each(function(){
    //         var $lintasanAsal = $(this);
    //         var $arr = ($lintasanAsal.val()).split('-');
    //         if($arr[0] != $pelabuhan){
    //             $lintasanAsal.hide();
    //         } else {
    //             $lintasanAsal.show();
    //         }     
    //     });
        

    //     // $("#lintasan option[value='"+$(this).val+"']").remove();
    // })

});

