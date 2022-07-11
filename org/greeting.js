var Greeting = [
    "1",
    "2",
    "3",
    "4"
]

$('#greeting').html(Greeting);

function more() {
    $("#header marquee").html(Greeting[Math.floor(Math.random() * Greeting.length)]);
}