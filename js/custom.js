
  $(function () {

    // MENU
    $('.navbar-collapse a').on('click',function(){
      $(".navbar-collapse").collapse('hide');
    });

    // AOS ANIMATION
    AOS.init({
      disable: 'mobile',
      duration: 800,
      anchorPlacement: 'center-bottom'
    });


    // SMOOTHSCROLL NAVBAR
    $(function() {
      $('.navbar a, .hero-text a').on('click', function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: $($anchor.attr('href')).offset().top - 49
        }, 1000);
        event.preventDefault();
      });
    });    
  });

  $(document).ready(function(){
    holdTextBeforeLoader = "";
    $("#submit-button").on('click', function(e){
      var $btn = $(this);
      showLoader($btn);
      e.preventDefault();
        $.ajax({
            url: 'email/email.php',
            type: 'POST',
            data: $('#contact-form').serialize(),
            success: function(msg) {
                hideLoader($btn);
                $('#contact-form').trigger('reset');
                showSuccess('Thanks for reaching us, We will get back to you soon.');
            },
            error: function(err) {
              showError();
              hideLoader();
            }
        });
    })

  });

  function showLoader($btn) {
    holdTextBeforeLoader = $btn.text();
    $btn.html('<span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>Loading...').attr('disabled', true);
  }
  
  function hideLoader($btn) {
    $btn.html(holdTextBeforeLoader).removeAttr('disabled');
  }

function showSuccess(msg) {
  $('#alert').html('<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> '+msg+'</div>');
  setTimeout(function(){
    $('#alert').html('');
  },5000);
}

function showError(msg) {
  $('#alert').html('<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Error!</strong> Please try again later.</div>');
  setTimeout(function(){
    $('#alert').html('');
  },5000);
}
