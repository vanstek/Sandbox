function textToSpeech(pirateInput) {
    var utter = new SpeechSynthesisUtterance();
    utter.rate = 0.75;
    utter.pitch = 0.5;
    utter.text = pirateInput;

    // event after text has been spoken
    utter.onend = function() {};
    // speak
    window.speechSynthesis.speak(utter);
}

function toPirate() {
    var output = '';
    var pirateInput = $('#pirate-input').val();
    output = piratify(pirateInput);
    $('#pirate-input').val(output);
    textToSpeech(output);
}

//starts annyang and records

var recording = false;

function record() {
    if (!recording) {
        recording = true;
        //change button to red
        $('.record').css('background-color', '#a60300');
        $('.record').css('border-color', '#d10a06');
        $('.record').html('Stop');

        //start annyang
        if (annyang) {
            // Start listening.
            console.log('annyang listening');
            annyang.start();
        }
        //annyang word printer
        annyang.addCallback('result', function(phrases) {
            //removes white space from random strings for easier comparison

            console.log('I think the user said: ', phrases[0]);
            console.log(
                'But then again, it could be any of the following: ',
                phrases
            );
            output = phrases[0];
            console.log(output);
            $('#pirate-input').val(output);
        });
    } else if (recording) {
        recording = false;
        //change button to green
        $('.record').css('background-color', 'rgb(53, 158, 53)');
        $('.record').css('border-color', 'rgb(37, 173, 37)');
        $('.record').html('Record');

        setTimeout(function() {
            annyang.pause();
        }, 5000);
    }
}
