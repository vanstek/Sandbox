//setting the variables
var score = 0;
var wrong = 0;
var size = 3.75;
var gameStarted = false;
var finalScore = 0;
var gen_string = words({
    exactly: 2,
    maxLength: 8,
    join: ' '
}).toUpperCase();

//POST scpre to database
function sendJSON(score) {
    $.post(
        './eyesightsql.php',
        {
            value: finalScore
        },
        function(data, status) {
            console.log(data);
        }
    );
}

// var highscore = sql connection

function startEyesight() {
    //RESET VALUES
    score = 0;
    wrong = 0;
    size = 3.75;
    var gen_string = words({
        exactly: 2,
        maxLength: 8,
        join: ' '
    }).toUpperCase();
    //REMOVES UNNECESSARY COMPONENTS
    $('#eyesight_desc').remove();
    if ($('#startButton').length) {
        $('startButton').remove();
    }
    //GENERATES NECESSARY COMPONENTS

    $('#eyesight-string').html(gen_string);
    $('.eyesight-string').css('font-size', size.toString() + 'in');
    $('#eyesight-counter').css('display', 'flex');
    $('#eyesight-score').html(score);

    //SCROLLS TO DECENT VIEWING AREA
    $(window).scrollTop(
        $('#eyeball').offset().top - $('.game-header').height() / 50
    );
    gameStarted = true;
}

if (annyang) {
    // command definitions
    var commands = {
        //start game vocal command
        'start game': function() {
            //RESET VALUES
            score = 0;
            wrong = 0;
            size = 3.75;

            //REMOVES UNNECESSARY COMPONENTS
            $('#eyesight_desc').remove();
            if ($('button').length) {
                $('button').remove();
            }
            //GENERATES NECESSARY COMPONENTS

            $('#eyesight-string').html(gen_string);
            $('.eyesight-string').css('font-size', size.toString() + 'in');
            $('#eyesight-counter').css('display', 'flex');
            $('#eyesight-score').html(score);

            //SCROLLS TO DECENT VIEWING AREA
            $(window).scrollTop(
                $('#eyeball').offset().top - $('.game-header').height() / 50
            );
            gameStarted = true;
        }

        // 'test this': function() {
        //     string = [...Array(5)].map(i => (~~(Math.random() * 36)).toString(36).toUpperCase()).join('');
        //     alert(string);
        //     $("#eyeball").stop().animate({
        //         rotation: 360
        //     }, {
        //         duration: 500,
        //         step: function(now, fx) {
        //             $(this).css({
        //                 "transform": "rotate(" + now + "deg)"

        //             });
        //         }
        //     });
        // }
    };

    // add commands to annyang
    annyang.addCommands(commands);

    // Start listening.
    annyang.start();
}

//annyang word printer. checks if correct string is said, then changes text size and text
annyang.addCallback('result', function(phrases) {
    new_phrases = [];
    //removes white space from random strings for easier comparison
    for (index = 0; index < phrases.length; index++) {
        new_phrases.push(phrases[index].replace(/\s+/g, ''));
    }
    console.log('I think the user said: ', phrases[0]);
    console.log('But then again, it could be any of the following: ', phrases);

    //CHECKS IF THE GAME HAS STARTED. IS RUN EVERY TIME THERE ARE ANY UTTERANCES FROM THE USER
    if (gameStarted) {
        //RIGHT WORDS VS USER WORDS VARIABLES
        gen_string_nospaces = gen_string.replace(/\s+/g, '').toUpperCase();
        var answer = new_phrases[0].toString().toUpperCase();
        console.log('question: ' + gen_string_nospaces);
        console.log('answer: ' + answer);
        console.log(answer.localeCompare(gen_string_nospaces));

        // SKIP COMMAND
        if (answer.localeCompare('SKIP') == 0) {
            if ($('#eyesight_desc').length) {
                $('#eyesight_desc').remove();
            }
            console.log('skipped!');
            $('#eyesight-string').html('Skipped');
            $('#eyesight-string').html();
            $('#eyesight-string').change(function() {
                $('.eyesight-string').css('font-size', '3.5in');
            });

            //NEW WORD GENERATION
            gen_string = words({
                exactly: 2,
                maxLength: 8,
                join: ' '
            }).toUpperCase();

            //WAITS BEFORE CHANGING VALUE FROM "SKIPPED"
            setTimeout(function() {
                $('#eyesight-string').html(gen_string);
                $('.eyesight-string').css('font-size', size.toString() + 'in');
            }, 1500);

            //KEEPS TEXT MOSTLY IN VIEW
            $(window).scrollTop(
                $('#eyeball').offset().top - $('.game-header').height() / 50
            );
        }

        // CORRECT ANSWER CODE
        else if (answer.localeCompare(gen_string_nospaces) == 0) {
            console.log('correct!');
            score++;
            //SCORE COUNTER UPDATE
            $('#eyesight-score').html(score);

            //FONT-SIZE DECREASE
            size *= 0.75;
            console.log('score: ' + score);
            //NEW WORD GENERATION
            gen_string = words({
                exactly: 2,
                maxLength: 8,
                join: ' '
            }).toUpperCase();
            var point = ' points.';
            if (score == 1) {
                point = 'point.';
            }

            //DISPLAY "CORRECT"
            $('#eyesight-string').html('Correct! ' + score.toString() + point);
            $('#eyesight-string').change(function() {
                $('.eyesight-string').css('font-size', '3.5in');
            });

            //WAITS BEFORE CHANGING VALUE FROM "CORRECT"
            setTimeout(function() {
                $('#eyesight-string').html(gen_string);
                $('.eyesight-string').css('font-size', size.toString() + 'in');
            }, 3000);

            //KEEPS TEXT MOSTLY IN VIEW
            $(window).scrollTop(
                $('#eyeball').offset().top - $('.game-header').height() / 50
            );
        }
        // WRONG ANSWER CODE
        else if (new_phrases[0] !== gen_string) {
            console.log('wrong answer');
            wrong++;
            console.log(wrong + ' wrong');

            //DISPLAY "WRONG"
            $('#eyesight-string').html(
                'Wrong! ' + (5 - wrong).toString() + ' lives left.'
            );
            $('#eyesight-string').html();
            $('#eyesight-string').change(function() {
                $('.eyesight-string').css('font-size', '3.5in');
            });
            $('#skull' + wrong.toString()).remove();

            //CHECKS FOR 0 LIVES, ENDING GAME. SENDS JSON WITH SCORE TO DATABASE
            if (wrong >= 5) {
                //PREVENTS GAME CODE FROM BEING RUN
                gameStarted = false;
                finalScore = score;

                //WAITS BEFORE CHANING VALUE FROM "WRONG"
                setTimeout(function() {
                    $('#eyesight-string').html(
                        'You lost! Your score is: ' + finalScore
                    );

                    $('.eyesight-string').css('font-size', '6vh');

                    sendJSON(finalScore);
                    $('#eyesight-string').append(
                        '<br><button class="btn btn-light" onClick="startEyesight()">Play again</button>'
                    );

                    //SEND JSON
                }, 3000);

                //RESET VALUES
                score = 0;
                wrong = 0;
                size = 3.75;
                gen_string = words({
                    exactly: 2,
                    maxLength: 8,
                    join: ' '
                }).toUpperCase();

                //resets skulls, but are hidden
                $('#eyesight-counter').css('display', 'none');
                $('#eyesight-lives').append(`
                        <img alt="skull icon" id="skull1" src="./img/skull.png">
                        <img alt="skull icon" id="skull2" src="./img/skull.png">
                        <img alt="skull icon" id="skull3" src="./img/skull.png">
                        <img alt="skull icon" id="skull4" src="./img/skull.png">
                        <img alt="skull icon" id="skull5" src="./img/skull.png">
                    `);
                console.log('success after');
            }
            //CONTINUE IF THERE ARE LIVES LEFT
            else {
                //NEW WORD GENERATION
                gen_string = words({
                    exactly: 2,
                    maxLength: 8,
                    join: ' '
                }).toUpperCase();

                //WAITS BEFORE CHANGING VALUE FROM "WRONG"
                setTimeout(function() {
                    $('#eyesight-string').html(gen_string);
                    $('.eyesight-string').css(
                        'font-size',
                        size.toString() + 'in'
                    );
                }, 3000);

                //KEEPS TEXT MOSTLY IN VIEW
                $(window).scrollTop(
                    $('#eyeball').offset().top - $('.game-header').height() / 50
                );
            }
        }
    }
});
