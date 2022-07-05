$(function(){
    $('.change').hide();
  
    $('.tab').on('click',function(){
      $('.change').not($($(this).attr('href'))).hide();
      $($(this).attr('href')).fadeToggle(1000);
    });
  });