jQuery(function($) {

  var menuToggle = $('#menu-toggle');

  menuToggle.change(function () {
    if(menuToggle.is(':checked')) {
      $('body').addClass('menu-active');
    } else {
      $('body').removeClass('menu-active');
    }
  });



  // $('.slider').slick({
  //   // autoplay: true,
  //   // adaptiveHeight: true,
  //   // vertical: true
  // });
  //
  //
  // $('.lightbox').Chocolat({
  //   // fullScreen: true
  //   // imageSelector: 'lightbox-link',
  //   imageSize: 'cover'
  // });


  // $('.image-grid__link').each(function(){
  //   $(this).removeAttr('title');
  // });

  function onCatChange() {
    if ( dropdown.options[dropdown.selectedIndex].value > 0 ) {
      location.href = i18n.homeURL + '?cat=' + dropdown.options[dropdown.selectedIndex].value;
    } else {
      location.href = i18n.homeURL;
    }
  }

  var dropdown = document.getElementById("cat");
  if (dropdown !== null) {
    dropdown.onchange = onCatChange;
  }
});
