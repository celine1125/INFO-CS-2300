// Make it easy to test PHP.
// Set this variable to true, if you want to test PHP form validation without
// client-side jQuery validation too.
var TEST_PHP_FORM = false;

$(document).ready(function() {

  $("#more").click( function() {
    if($("#more-content").is(':hidden')) {
      $("#more-content").show();
    } else if ($("#more-content").is(':visible')) {
      $("#more-content").hide();
    }
  });

  if (!TEST_PHP_FORM) {
    // Validate form on submit
    $("#subscribeForm").on("submit", function() {
      var emailIsValid = $("#mail").prop("validity").valid;
      if(emailIsValid) {
        $("#emailError").hide();
      } else {
        $("#emailError").show();
        return false;
      }
    });
  }

});
