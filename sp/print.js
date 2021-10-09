const random = [
  "print/drawing.jpg",
  "print/org.jpg",
  "print/orgup.jpg",
  "print/sign.jpg",
  "print/weareopen.jpg",
  "print/weareclose.jpg"
  ];
  
  function randomImg(randomArray) {
    var random =
    randomArray[Math.floor(Math.random() * randomArray.length)];
    console.log(random);
    return random;
  }
  function imgGenerator() {
    var img = `<img src="${randomImg(random)}">`;
    document.querySelector(".random").innerHTML = img;
  }
  window.setInterval(function() {
    imgGenerator();
  }, 2000);
  
