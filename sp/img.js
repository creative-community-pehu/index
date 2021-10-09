const random = [
  "print/drawings.JPG",
  "print/org.jpg",
  "print/orgup.jpg",
  "print/sign.JPG",
  "print/weareopen.JPG",
  "print/weareclose.JPG"
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
  
