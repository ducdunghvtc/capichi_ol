$(document).ready(function () {
  $(".js-toggle-navi").click(function () {
    $(".header").toggleClass("on-nav");
    $("body").toggleClass("overflow-hidden");
  });

  $(window).scroll(function () {
    let header = $("header").innerHeight();
    if ($(this).scrollTop()) {
      $(".backtotop").fadeIn();
      $(".header").addClass("fixed");
      // $("body").css("padding-top", header);
    } else {
      $(".backtotop").fadeOut();
      $(".header").removeClass("fixed");
      // $("body").css("padding-top", "0");
    }
  });
  // nav-link
  const widtScreen = window.innerWidth;
  let topMenu = 150;
  if (widtScreen < 768) {
    topMenu = 80;
  }
  // anker link
  $('a[href*="#"]:not([href="#"])').click(function () {
    $(".header").removeClass("on-nav");
    $("body").removeClass("overflow-hidden");
    let target = $(this.hash);
    $("html, body").animate(
      {
        scrollTop: target.offset().top - topMenu,
      },
      800
    );
    return false;
  });
});

$(document).ready(function () {
  var modal = $(".modal");
  var btn = $(".btn-show");
  var span = $(".close");

  btn.click(function () {
    modal.show();
    $("body").addClass("overflow-hidden");
  });

  span.click(function () {
    modal.hide();
    $("body").removeClass("overflow-hidden");
  });

  $(window).on("click", function (e) {
    if ($(e.target).is(".modal")) {
      modal.hide();
      $("body").removeClass("overflow-hidden");
    }
  });
});

$(document).ready(function () {
  $("form").validate({
    groups: {
      fullName: "your-tel your-number",
    },
    rules: {
      "your-name": "required",
      "your-email": "required",
      "your-tel": "required",
      "your-number": "required",
      "your-message": "required",
    },
    messages: {
      "your-name": "The field is required.",
      "your-email": "The field is required.",
      "your-message": "The field is required.",
      "your-tel": {
        required: "The field is required.",
      },
      "your-number": {
        required: "The field is required.",
      },
    },
    errorPlacement: function (error, $element) {
      var name = $element.attr("name");
      if (name === "your-tel" || name === "your-number") {
        error.insertAfter(".form-phone");
      } else {
        error.insertAfter($element);
      }
    },
  });
});

$(document).ready(function () {
  var btn = $(".btn-more");
  var text = $(".text");

  btn.click(function () {
    $(this).parent().find(".text").show();
    $(this).css("display", "none");
  });
});
