StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});

var volume = new Tone.Volume(20);
var click = new Tone.FMSynth(Tone.Synth).chain(volume, Tone.Master);
var number = Tone.Frequency("G1").harmonize([
    7, 10, 12,
    10, 12, 14,
    12, 14, 17,
]);
var numberIndex = 0;

$(function() {
    $(".label").click(function() {
        var numberNote = Math.floor(Math.random() * number.length);
        click.triggerAttackRelease(number[numberNote], "4");
        $("#grid div").removeClass("list_toggle");
    });
    if ($("#grid div").hasClass("list_toggle")) {
        $(".reset .reset-button").click(function() {
            $("#grid div").removeClass("is-hide");
        });
    }
});

var searchBox = ".search-box";
var listItem = ".list_item";
var hideClass = "is-hide";

$(function() {
    $(document).on("change", searchBox + " input", function() {
        search_filter();
    });
});

function search_filter() {
    $(listItem).removeClass(hideClass);
    for (var i = 0; i < $(searchBox).length; i++) {
        var name = $(searchBox)
            .eq(i)
            .find("input")
            .attr("name");
        var searchData = get_selected_input_items(name);
        if (searchData.length === 0 || searchData[0] === "") {
            continue;
        }
        for (var j = 0; j < $(listItem).length; j++) {
            var itemData = $(listItem)
                .eq(j)
                .data(name);
            if (searchData.indexOf(itemData) === -1) {
                $(listItem)
                    .eq(j)
                    .addClass(hideClass);
            }
        }
    }
}

function get_selected_input_items(name) {
    var searchData = [];
    $("[name=" + name + "]:checked").each(function() {
        searchData.push($(this).val());
    });
    return searchData;
}