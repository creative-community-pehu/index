const random = [
  "https://nekogazou.com/wp-content/uploads/2015/03/282e6ed4976b181c78381a609c0f4e32-e1427784795864.jpg",
  "https://nekogazou.com/wp-content/uploads/2015/03/gazou12-e1426694824704.jpg",
  "https://nekogazou.com/wp-content/uploads/2015/03/gazou21-e1426694843537.jpg",
  "https://nekogazou.com/wp-content/uploads/2015/03/gazou31-e1426694857105.jpg"
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
  
