$(document).ready(function () {
    closeLoader();
});

let closeLoader = () => {
    $(".loader").fadeOut("slow");
    $(".textloader").hide();
};

let openLoader = (msg) => {
    $(".loader").show();
    $(".textloader")
        .css({
            display: "block",
            "font-style": "italic",
        })
        .text(msg);
};
