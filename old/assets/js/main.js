(function($){
	"use strict";
	jQuery(document).on('ready', function () {

		// Last Word Color JS
        $(".coming-soon-content h1").html(function(){
            var text= $(this).text().trim().split(" ");
            var last = text.pop();
            return text.join(" ") + (text.length > 0 ? " <span>" + last + "</span>" : last);
        });

		// Sidebar Modal
        $(".navbar-menu .burger-menu").on('click',  function() {
			$('.sidebar-modal').toggleClass('active');
		});
        $(".sidebar-modal-close-btn").on('click',  function() {
			$('.sidebar-modal').removeClass('active');
		});

        // Count Time 
        function makeTimer() {
            var endTime = new Date("May 20, 2022 17:00:00 PDT");			
            var endTime = (Date.parse(endTime)) / 1000;
            var now = new Date();
            var now = (Date.parse(now) / 1000);
            var timeLeft = endTime - now;
            var days = Math.floor(timeLeft / 86400);
            $("#days").html(days + "<span>Days to Launch</span>");
        }
        setInterval(function() { makeTimer(); }, 0);

        // Subscribe form
		$(".newsletter-form").validator().on("submit", function (event) {
			if (event.isDefaultPrevented()) {
			// handle the invalid form...
				formErrorSub();
				submitMSGSub(false, "Please enter your email address.");
			} else {
				// everything looks good!
				event.preventDefault();
			}
		});
		function callbackFunction (resp) {
			if (resp.result === "success") {
				formSuccessSub();
			}
			else {
				formErrorSub();
			}
		}
		function formSuccessSub(){
			$(".newsletter-form")[0].reset();
			submitMSGSub(true, "Thank you for subscribing!");
			setTimeout(function() {
				$("#validator-newsletter").addClass('hide');
			}, 4000)
		}
		function formErrorSub(){
			$(".newsletter-form").addClass("animated shake");
			setTimeout(function() {
				$(".newsletter-form").removeClass("animated shake");
			}, 1000)
		}
		function submitMSGSub(valid, msg){
			if(valid){
				var msgClasses = "validation-success";
			} else {
				var msgClasses = "validation-danger";
			}
			$("#validator-newsletter").removeClass().addClass(msgClasses).text(msg);
		}
		// AJAX MailChimp
		$(".newsletter-form").ajaxChimp({
			url: "https://envytheme.us20.list-manage.com/subscribe/post?u=60e1ffe2e8a68ce1204cd39a5&amp;id=42d6d188d9", // Your url MailChimp
			callback: callbackFunction
        });

    });

    // WOW JS
	$(window).on ('load', function (){
        if ($(".wow").length) { 
            var wow = new WOW({
            boxClass:     'wow',      // Animated element css class (default is wow)
            animateClass: 'animated', // Animation css class (default is animated)
            offset:       20,         // Distance to the element when triggering the animation (default is 0)
            mobile:       true,       // Trigger animations on mobile devices (default is true)
            live:         true,       // Act on asynchronously loaded content (default is true)
          });
          wow.init();
        }
	});

	// Preloader JS
	$(window).on('load', function() {
		$('.preloader').fadeOut();
	});
    
}(jQuery));