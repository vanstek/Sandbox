<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Eyesight Checker</title>
    <!-- bootstrap and fontawesome -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/4067afb655.js" crossorigin="anonymous"></script>

    <!-- css -->
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Annyang voice recognition script -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.1/annyang.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- randomwords generator https://github.com/punkave/random-words-->
    <script src="./js/randomWords.js"></script>
    <!-- annyang commands -->
    <script>
        var score = 0;
        var wrong = 0;
        var size = 3.75;
        var gameStarted = false;
        var gen_string = words({
            exactly: 3,
            maxLength: 4,
            join: ' '
        }).toUpperCase();

        // var highscore = sql connection

        function startEyesight() {
            $('#eyesight_desc').remove();
            $('#eyesight-string').append(gen_string);
            $("#eyesight-counter").css("display", "flex");
            $(window).scrollTop($('#eyeball').offset().top - ($('.game-header').height() / 10));
            gameStarted = true;
        }

        if (annyang) {
            // command definitions
            var commands = {
                'start game': function() {
                    $('#eyesight_desc').remove();
                    $('#eyesight-string').append();
                    $("#eyesight-string").html(gen_string);
                    console.log($('#eyeball').offset().top)
                    $(window).scrollTop($('#eyeball').offset().top - ($('.game-header').height() / 10));
                    gameStarted = true;
                },


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
            console.log("I think the user said: ", phrases[0]);
            console.log("But then again, it could be any of the following: ", phrases);

            if (gameStarted) {
                gen_string_nospaces = gen_string.replace(/\s+/g, '').toUpperCase();
                var answer = new_phrases[0].toString().toUpperCase();
                console.log("question: " + gen_string_nospaces);
                console.log("answer: " + answer);
                console.log(answer.localeCompare(gen_string_nospaces));


                // SKIP COMMAND
                if (answer.localeCompare('SKIP') == 0) {
                    if ($('#eyesight_desc').length) {
                        $('#eyesight_desc').remove();
                    }
                    console.log("skipped!")
                    $("#eyesight-string").html('Skipped');
                    $("#eyesight-string").html();
                    $("#eyesight-string").change(function() {
                        $('.eyesight-string').css("font-size", "3.5in");
                    });



                    //generates new string when skipped
                    gen_string = words({
                        exactly: 3,
                        maxLength: 4,
                        join: ' '
                    }).toUpperCase();


                    setTimeout(
                        function() {
                            $("#eyesight-string").html(gen_string);
                            $('.eyesight-string').css("font-size", size.toString() + "in");
                        }, 1500);

                    $(window).scrollTop($('#eyeball').offset().top);
                    $(window).scrollTop($('#eyeball').offset().top - ($('.game-header').height() / 10));
                }



                // CORRECT ANSWER CODE
                else if (answer.localeCompare(gen_string_nospaces) == 0) {
                    console.log("correct!")
                    score++;
                    $("#eyesight-score").html(score);


                    size *= .75;
                    console.log('score: ' + score)
                    //generates new string when correct
                    gen_string = words({
                        exactly: 3,
                        maxLength: 4,
                        join: ' '
                    }).toUpperCase();
                    var point = ' points.'
                    if (score == 1) {
                        point = 'point.';
                    }
                    $("#eyesight-string").html('Correct! ' + score.toString() + point);
                    $("#eyesight-string").change(function() {
                        $('.eyesight-string').css("font-size", "3.5in");
                    });


                    setTimeout(
                        function() {
                            $("#eyesight-string").html(gen_string);
                            $('.eyesight-string').css("font-size", size.toString() + "in");
                        }, 3000);
                    $(window).scrollTop($('#eyeball').offset().top - ($('.game-header').height() / 10));



                }
                // WRONG ANSWER CODE
                else if (new_phrases[0] !== gen_string) {
                    console.log('wrong answer');
                    wrong++;
                    console.log(wrong + ' wrong')
                    $("#eyesight-string").html('Wrong! ' + (5 - wrong).toString() + ' lives left.');
                    $("#eyesight-string").html();
                    $("#eyesight-string").change(function() {
                        $('.eyesight-string').css("font-size", "3.5in");
                    });
                    $("#skull" + wrong.toString()).remove();



                    gen_string = words({
                        exactly: 3,
                        maxLength: 4,
                        join: ' '
                    }).toUpperCase();


                    setTimeout(
                        function() {
                            $("#eyesight-string").html(gen_string);
                            $('.eyesight-string').css("font-size", size.toString() + "in");
                        }, 3000);
                    $(window).scrollTop($('#eyeball').offset().top - ($('.game-header').height() / 10));
                }
            }

        });
    </script>





</head>

<body>
    <button class="loginbutton">
        <span>Log in</span>
    </button>

    <div class="container-fluid h-100">
        <div class="container-fluid h-100">
            <div class="row pt-md-0 pt-5">
                <div class="home-link col-4"><a class="home-link" href="index.php">Sandbox</a></div>
                <div class="game-header col-4 .game-header">Eyesight Test
                    <img src="./img/glasses.svg">
                </div>
                <div class="col-4"></div>
            </div>
            <div class="row justify-content-center align-items-center">

                <div class="col-12">
                    <div class="game eyesight-game" id="eyeball">
                        <div class="eyesight-description" id="eyesight_desc">Welcome to the Eyesight Test. This test is not endorsed by doctors, and you should not use this to come to any scientific or physiological conclusions about yourself.<br><br>
                            <b> Instructions:</b> <br>The game is simple. 3 random word will be displayed on screen.. It is your duty to recite those words at a distance of ~10 feet. Make sure you have allowed
                            the website to access your microphone, or else it won't work. Every time you recite the words correctly, the text will get smaller, and you will go again. Every correct answer is a point, and you get five strikes until you lose.
                            The text is ~4 inches tall, but varies with the PPI of your monitor. Also, if there are some words that could be homophones, feel free to say "skip" to generate new words. <br><br>Best of luck!
                            <br><br>
                            <center><button class="btn btn-light" onclick="startEyesight()">Start game</button></center>

                        </div>
                        <div class="eyesight-string" id="eyesight-string"></div>
                        <div class="eyesight-counter" id="eyesight-counter">
                            <div class="eyesight-lives" id="eyesight-lives">
                                <img alt="skull icon" id="skull1" src="./img/skull.png">
                                <img alt="skull icon" id="skull2" src="./img/skull.png">
                                <img alt="skull icon" id="skull3" src="./img/skull.png">
                                <img alt="skull icon" id="skull4" src="./img/skull.png">
                                <img alt="skull icon" id="skull5" src="./img/skull.png">
                            </div>
                            <div class="eyesight-score">
                                <p>Points</p>
                                <div id="eyesight-score">0</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid h-25">
    </div>



    <!-- bootstrap js -->
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- tilt.js -->
    <script src="./js/tilt.jquery.js">
    </script>


</body>

</html>