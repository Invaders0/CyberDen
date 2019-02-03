$(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
        theme: "minimal"

});

    $('#dismiss, .overlay').on('click', function () {
        $('#sidebar').removeClass('active');
        $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').addClass('active');
        $('.overlay').addClass('active');
        $('.collapse.in').toggleClass('in');
        $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
    var sidebar_parent_height = $("#sidebar")[0].scrollHeight;
    var sidebar_child_height = $("#sidebar_content").height();
    //alert(sidebar_parent_height + " " + sidebar_child_height);
    if(sidebar_parent_height > sidebar_child_height){
    	$("#sidebar_content").height(sidebar_parent_height);
    }else{

    }
});