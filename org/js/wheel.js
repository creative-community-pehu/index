var volume = new Tone.Volume(-5);
var wheel = new Tone.Synth(Tone.Synth).chain(volume, Tone.Master);
var scrool = Tone.Frequency("G3").harmonize([
    1, 3, 6, 8, 10,
    3, 6, 8, 10, 13,
    6, 8, 10, 13, 15,
    8, 10, 13, 15, 18,
    10, 13, 15, 18, 20,
    13, 15, 18, 20, 22,
    15, 18, 20, 22, 25,
]);
var scroolIndex = 0;


$(document).ready(function(event) {
    window.addEventListener("wheel", scrolling, { passive: false });
    timer();
});

$(window).scroll(function(event) {
    scrolling();
});

function scrolling() {
    wheel.triggerAttackRelease(scrool[scroolIndex], "10n");
    scroolIndex++;
    if (scroolIndex >= scrool.length) {
        scroolIndex = 0;
    }
}