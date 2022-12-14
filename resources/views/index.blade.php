<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('js/index.js') }}"></script>

    <title>JS-Ninjify</title>
    <link rel="icon" type="image/png" href="{{ asset('image/shuriken.png') }}">
</head>
<body>
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div id="center-box">
            <div class="row">
                <div class="ninjify-box" class="col-lg-6 offset-lg-3 col-10 offset-1 align-self-center">
                    <div class="row">
                        <div class="col-12">
                            <h2>Welcome to JS-Ninjify!</h2>
                            <p class="instruction">Enter technology buzzwords to Ninjify them and generate you own personnal ninja name!</p>
                        </div>
                        <div class="col-lg-8 col-12">
                            <input id="buzzwords" name="buzzwords" type="text" placeholder="Enter buzzwords here (Ex: html,css)" />
                        </div>
                        <div class="col-lg-4 col-12">
                            <input class="ninjifybtn" type="button" value="Ninjify"/>
                        </div>
                        <div class="col-12 errorbox">
                            <label class="errorlbl">An error has occured:</label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-1"></div>
            </div>
            <div class="row">
                <div id="ninjanamebox" class="ninjify-box hidden" class="col-lg-6 offset-lg-3 col-10 offset-1 align-self-center">
                    <div class="row">
                        <div class="col-2 shurikenimgbox imgbox"><img class="shuriken" src="{{ asset('image/shuriken.png') }}"/></div>
                        <div class="col-2 imgbox"><img class="kunai" style="transform: rotate(-125deg);" src="{{ asset('image/kunai.png') }}"/></div>
                        <div class="col-4 imgbox"><img src="{{ asset('image/joyeux-ninja.png') }}"/></div>
                        <div class="col-2 imgbox"><img class="kunai" src="{{ asset('image/kunai.png') }}"/></div>
                        <div class="col-2 shurikenimgbox imgbox"><img class="shuriken" src="{{ asset('image/shuriken.png') }}"/></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3>Here's your ninja name !</h3>
                            <h2 id="ninjaname"></h2>
                        </div>
                        <div class="col-lg-6 col-12">
                            <input class="ninjifybtn" type="button" value="Re-ninjify"/>
                        </div>
                        <div class="col-lg-6 col-12">
                            <input id="resetbtn" type="button" value="Reset"/>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-1"></div>
            </div>
        </div>
    </div>
</body>
</html>
