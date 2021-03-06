@extends('layouts.app2')

@section('content')
<?php
    // Start the session
    session_start();
    use App\Search;
    use App\MainPage;
?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

        <script>jQuery(document).ready(function($) {
            $(".clickable-row").click(function() {
                window.location = $(this).data("href");
            });
        });</script>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Player</title>
        <!-- Styles -->

        <!-- <link href="css/style.css" rel="stylesheet">
        <link href="css/style2.css" rel="stylesheet">
        <link href="css/utilities.css" rel="stylesheet"> -->
    </head>

    <body>

        <section class="showcase">
            <div class="container grid">
                <div class="showcase-text">
                    <h1>Witaj na Songerr!</h1>
                    <p>
                        Songerr to nowa platforma do słuchania muzyki
                        i dzielenia się nią z innymi. Śledź ulubionych artystów
                        i zapisuj najnowsze wydania w swojej bibliotece.
                        A wszystko to w zasięgu kilku kliknięć!
                    </p>
                </div>

                <div class="showcase-card card">
                    <i class="fas fa-music fa-8x"></i>
                </div>
            </div>
        </section>

        <div id="mainPage" class="container">
            <?php
                $main = new MainPage();
                $search = new Search();
                if(isset($songs)&&$songs!=[]) {
                    $search->showSongs($songs);
                }
                if(isset($users)&&$users!=[]) {
                    $search->showUsers($users);
                }
                if(isset($albums)&&$albums!=[]) {
                    $search->showAlbums($albums);
                }
                if(isset($playlists)&&$playlists!=[]){
                    $search->showPlaylists($playlists);
                }
            ?>
            @guest
                <h2>Najnowsze utwory</h2>
                <?php
                    $main->fetch_newest_songs();
                ?>
                <h2>Najnowsze albumy</h2>
                <?php
                    $main->fetch_newest_albums();
                ?>
            @else
                <h2>Najnowsze albumy obserwowanych</h2>
                <?php
                    $main->fetch_followers_songs();
                ?>
                <h2>Najnowsze utwory</h2>
                <?php
                    $main->fetch_newest_songs();
                ?>
                <h2>Najnowsze albumy</h2>
                <?php
                    $main->fetch_newest_albums();
                ?>
            @endguest
        </div>
    </body>
    <script>
        $(document).ready(function(){
            //$('#wyszukaj').hide();
            $('#albums').hide();
        });
        function showsearch(){
            $('#wyszukaj').slideToggle(500);
        }
    </script>
</html>
@endsection
