$(".show-sidebar-btn").click(function () {
    $(".sidebar").animate({marginLeft:0});
});

$(".hide-sidebar-btn").click(function () {
    $(".sidebar").animate({marginLeft:"-100%"});
});

$(function () {
    $('[data-toggle="popover"]').popover();
})

$(".full-screen-btn").click(function () {
    let current = $(this).closest(".card");
    current.toggleClass("full-screen-card");
    if(current.hasClass("full-screen-card")){
        $(this).html(`<i class="fa fa-arrow-alt-circle-left"></i>`);
    }else{
        $(this).html(`<i class="fa fa-arrow-alt-circle-right"></i>`);
    }
});
