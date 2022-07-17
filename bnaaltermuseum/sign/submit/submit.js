StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});

var volume = new Tone.Volume(-5);
var click = new Tone.PolySynth(3, Tone.Synth).chain(volume, Tone.Master);
var number = Tone.Frequency("B5").harmonize([
    7, 10, 12,
    10, 12, 14,
    12, 14, 17,
]);
var numberIndex = 0;

$("#click .click").click(function(e) {
    var numberNote = Math.floor(Math.random() * number.length);
    click.triggerAttackRelease(number[numberNote], "10n");
});