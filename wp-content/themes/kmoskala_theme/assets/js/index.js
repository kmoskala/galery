require("../scss/style.scss");

$(document).ready(() => {
  
  var macy = Macy({
    container: '#macy',
    trueOrder: false,
    waitForImages: false,
    margin: 20,
    columns: 3,
    breakAt: {
        991: 2,
        768: 1
    }
  });
  $('.card_cake .image ').on('click', function(){
    $(this).find('.layer .visibility_part').hide()
    $(this).find('.layer .hidden_part').show()
  });
  $( ".card_cake .image" ).hover(
    function() {
      $(this).find('.layer .visibility_part').show()
      $(this).find('.layer .hidden_part').hide();
    }, function() {
      $(this).find('.layer .visibility_part').hide()
      $(this).find('.layer .hidden_part').show();
    }
  );
    
});
