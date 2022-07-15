var Greeting = [
    "1",
    "2",
    "3",
    "4"
]

function more() {
    $("#header marquee").html(Greeting[Math.floor(Math.random() * Greeting.length)]);
}