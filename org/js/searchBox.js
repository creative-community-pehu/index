var volume;
var synth;
var notes;

$(document).ready(function(event) {
    // StartAudioContext(Tone.context, window);  
    $(window).click(function() {
        Tone.context.resume();
    });

    volume = new Tone.Volume(-10);
    synth = new Tone.PolySynth(10, Tone.Synth).chain(volume, Tone.Master);
    notes = Tone.Frequency("A6").harmonize([12, 14, 16, 19, 21, 24]);


});

$(".org li").hover(function() {
    let randNote = Math.floor(Math.random() * notes.length);
    synth.triggerAttackRelease(notes[randNote], "6n");
});

$(function() {
    $(".label").click(function() {
        $(".org li").removeClass("list_toggle");
    });
    if ($(".org li").hasClass("list_toggle")) {
        $(".reset .reset-button").click(function() {
            $(".org li").removeClass("is-hide");
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