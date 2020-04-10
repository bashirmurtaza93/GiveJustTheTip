
jQuery(document).ready(function(){
    countDown();
    percentageSubmit();


});

function percentageSubmit(){

    jQuery('.submit-donation').click(function(){
        var percentage = jQuery('#percentage').val()/100;
        var paycheck   = jQuery('#paycheck').val();
        var donate = percentage * paycheck;
        //TODO put this in backend for donation
        var text   = jQuery('.donate-percentage').attr('data-text');
        jQuery('.donate-percentage').text(text).append('<div class="donation-amount">$'+donate.toFixed(2)+'</div>');
        jQuery('.mat-input-element').val(text);
    })
}

function countDown(){
    var countdown = jQuery('#countdown').attr('data-time');
    var countDownDate = new Date(countdown).getTime();

// Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = "Donation opens in "+ days + "d " + hours + "h "
            + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Donation Open!";
        }
    }, 1000);
}