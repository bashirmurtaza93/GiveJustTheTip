var tip_options = justthetip_vars.donation_options;
$(document).ready(function(){
    countDown();
    setDonationInfo();
    setSocialMedia();
    percentageSubmit();
    socialMedia();
    scrollDonation();
});

function socialMedia(){
    var hashtag = tip_options.donation_twitter_hashtag;
    $(document).on('click','.twitter-button',function(e){
       e.preventDefault();
        var url = 'https://twitter.com/intent/tweet?hashtags='+hashtag+'%2C&original_referer=http%3A%2F%2Flocalhost%3A8000%2F&ref_src=twsrc%5Etfw&text='+$('#social-share').val()+'&tw_p=tweetbutton';
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

function setDonationInfo(){
    $('#percentage').val(tip_options.donation_percentage);
    $('.donate-percentage').attr('data-text',tip_options.donation_calculator_success);
}

function setSocialMedia(){
    $('.social-media').text(tip_options.donation_social_media_header);
    $('#social-share').text(tip_options.donation_social_media)
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

    $(".share-button-anchor").click(function () {
        $([document.documentElement, document.body]).animate({
            scrollTop: $(".social-media").offset().top - 200
        }, 1000);
        // ...
    });
}
