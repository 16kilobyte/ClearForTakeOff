$(document).ready(function()
{
    $("#from").keyup(function()
    {
        var fromsuggest = new CTTO;
        fromsuggest.autoSuggest(this, "#departure_airport");
        fromsuggest.loadSuggestionsIntoInput("#from", "#departure_airport");
    })

    $("#destination").keyup(function()
    {
        var tosuggest = new CTTO;
        tosuggest.autoSuggest(this, "#destination_airport");
        tosuggest.loadSuggestionsIntoInput("#destination", "#destination_airport");
    })
    $(document).on("click", "#result a", function(e)
    {
        e.preventDefault();

    });

    rome(datetime);
});

function CTTO(){};

CTTO.prototype.autoSuggest = function(tinput,id){
    var enteredText = tinput.value.trim();
    var $s_box = $(id+".s_box");
    // if text box is not empty //
    //alert(enteredText);
    if(enteredText.length>0) {
        try {
            $.ajax({
                url: "search/suggest",
                type: "post",
                data: {
                    suggestfor : enteredText,
                },
                success: function(data) {
                    $s_box.html(data).fadeIn();
                },
                error: function(errorThrown) {
                    alert("An error occured and autoSuggest could not work again. Please try again later");
                },
                beforeSend: function() {
                    $s_box.html("<ul class=\"result\"><li class=\"text-center\">Loading...</li></ul>").fadeIn();
                },
                async: true,
            });
        } catch (error) {
            alert("Fatal Error: "+error.message);
        }
    } else {
        $s_box.fadeOut();
    }
}

CTTO.prototype.loadSuggestionsIntoInput = function(tinput, id)
{
    var $s_box = $(id+".s_box");
    //alert(id)
    $(document).on("click", "#result a", function(e)
    {
        e.preventDefault();
        $(this).closest("div").siblings().find("input").val($(this).find("div div span").text().trim())// = $(this).find("li div div span").text().trim();
        $s_box.fadeOut().html("");
    });
}
