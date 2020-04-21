
$(document).ready(function(){
    countDown();
    percentageSubmit();
    socialMedia();
    scrollDonation();

});

function socialMedia(){
    $(document).on('click','.twitter-button',function(e){
       e.preventDefault();
        var url = 'https://twitter.com/intent/tweet?hashtags=givejustthetip%2C&original_referer=http%3A%2F%2Flocalhost%3A8000%2F&ref_src=twsrc%5Etfw&text='+$('#social-share').val()+'&tw_p=tweetbutton';
        window.open(url, '_blank');

    });
}

function percentageSubmit(){

    $(document).on('click','.submit-donation',function(){

        var percentage = $('#percentage').val()/100;
        var paycheck   = $('#paycheck').val();
        var donate = percentage * paycheck;
        //TODO put this in backend for donation
        var text   = $('.donate-percentage').attr('data-text');
        $('.donate-percentage').text(text).append('<div class="donation-amount">$'+donate.toFixed(2)+'</div>');
        $('.inline-field').val(donate.toFixed(2));
        $('.mat-input-element').val(text);
    })
}

function countDown(){
    var countdown = $('#countdown').attr('data-time');
    var countDownDate = new Date(countdown).getTime();

// Update the count down every 1 second
    var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = addLeadingZero(Math.floor(distance / (1000 * 60 * 60 * 24)));
        var hours = addLeadingZero(Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
        var minutes = addLeadingZero(Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60)));
        var seconds = addLeadingZero(Math.floor((distance % (1000 * 60)) / 1000));

        // Display the result in the element with id="demo"
        document.getElementById("countdown").innerHTML = days + ":" + hours + ":"
            + minutes + ":" + seconds + "";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Donation Open!";
        }
    }, 1000);
}

function addLeadingZero(num){
    if(num < 10){
        return '0'+num;
    } else{
        return num;
    }
}

function scrollDonation(){
    $(".donate-button-anchor").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $(".donations").offset().top - 200
        }, 1000);
        // ...
    });
}
