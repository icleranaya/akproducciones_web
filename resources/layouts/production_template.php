<?php 
/**
 * Template to show Production area.
 *
 * @author Icler Anaya <contacto@lordblaster.com.ve>
 * @link https://prismaagencia.com/
 * @author URI: https://gitlab.com/prisma_web
 * @since 1.0.0
 *
 * @package akproducciones_web_v2_dev
 */
?>

<?php global $contentPost, $header; ?>

<?php $header->MenuExpanded();?>

<main class="main-<?= $production_name; ?> not-hover-main">
    <section class="scroll-sec layout-center">

        <div class="center-container">

            <!-- ------ stroke ------- -->
            <div class="stroke-right">
                <h2 class="stroke-txt">
                    <?= __( 'Portafolio', 'onepage-theme' );?>
                </h2>
            </div>
            <!-- ----- **stroke** ------ -->
            
            <!---------- main container ------------>
            <div class="audio-player">

                <!-- Reproductor -->
                <div class="player-container">

                    <!-- Background Header -->
                    <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/ak_img_2.png" class="player-image" alt="Ak producciones">


                    <!-- html5 audio player -->
                    <div class="player-controls">
                        <div class="top-player">
                            <div class="play"></div>
                            <div class="pause hidden"></div>

                            <div class="music-title">
                                <!-- <div class="artist"></div> -->
                                <div class="title"></div>
                            </div>
                        </div>

                        <div class="bottom-player">
                            <div class="prev"></div>
                            <div class="next"></div>

                            <!-- <div id="player"></div> -->
                            <div class="tracker">
                                <div class="progressBar"></div>
                            </div>
                            <!-- <audio id="player" controls="controls"></audio> -->
                            
                            <div class="timer">
                                <span class="currentTime">0:00</span> / <span class="fullTime">0:00</span>
                            </div>

                            <div class="volumeContainer">
                                <div class="volume"></div>
                                <div class="volumeTracker">
                                    <div class="volumeCurrent"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- **html5 audio player** -->

                </div>
                <!-- **Reproductor** -->

                <!---------- Play List ------------>
                <div class="playlist-container">
                    <ul class="playlist">

                        <?php
                            $content_section = new WP_Query( array(
                                'order' => 'DES',
                                'posts_per_page' => '10',
                                'post_type' => 'lb_projects'
                            ));
                        ?>

                        <?php if ( $content_section->have_posts() ): ?>

                            <?php
                            
                                $wow = 3.5;
                                $id_proyect = 1;
                            
                            ?>

                            <?php while( $content_section->have_posts() ): ?>

                                <?php $content_section->the_post(); ?>

                                <?php

                                    $custom_fields = get_post_custom( get_the_ID() );
                                    $file = isset( $custom_fields["lb_projects_project_information_file"] ) ? unserialize( $custom_fields["lb_projects_project_information_file"][0] ) : " ";
                                ?>

                                <?php if( !empty($file) && $file != " " ):?>
                                    <li audiourl="<?= $file['url'] ?>">
                                        <?php the_title( "<span class=\"number-id\">{$id_proyect}</span> ", " - {$file['name']}" ); ?>
                                    </li>
                                <?php endif; ?>

                                <?php

                                    $wow += 0.5;
                                    $id_proyect;
                                ?>

                            <?php endwhile; ?>

                        <?php endif; ?>

                    </ul>
                    
                    <!-- ----- spliters ------ -->
                    <div class="spliter-down-right">
                        <img src="<?= get_template_directory_uri(); ?>/public/images/backgrounds/spliter.png" alt="spliter">
                    </div>
                    <!-- ----- *spliters* ------ -->

                </div>
                <!---------- **Play List** ------------>
            </div>
            <!---------- **main container** ----------->
            
            <?php wp_reset_postdata(); ?>

        </div>

    </section>
</main>

<!--unique javascript of the page-->
<script>

    /* audio player code */
    var song;
    var tracker = $(".tracker");
    var volume = $(".volume");
    var durat = $(".fullTime");
    var currentTime = $(".currentTime");
    var trackMin;
    var trackSeg;
    var curMin;
    var curSeg;
    var barSize = $('.tracker').width();
    var volumeSize = $('.volumeTracker').width();
    // initialization - first element in playlist
    initAudio($('.playlist li:first-child'));

    function initAudio(elem) {
        var url = elem.attr('audiourl');
        var title = elem.clone().find('span').remove().end().text();
        // var artist = 'Ak Producciones ' + elem.attr('artist');
        $('.music-title .title').text(title);
        // $('.music-title .artist').text(artist);
        song = new Audio(url);
        song.volume = 1;
        $('.volumeCurrent').css("width", "100%");

        // timeupdate event listener
        song.addEventListener('timeupdate',function (){
            //min track
            trackMin = parseInt(song.duration / 60);
            trackSeg = parseInt(song.duration % 60);

            (trackSeg < 10) ? trackSeg = '0' + trackSeg : trackSeg

            if(isNaN(trackMin) && isNaN(trackSeg)){
                trackMin = '00';
                trackSeg = "00";
            }else{
                durat.text(trackMin + ':' + trackSeg);    
            }

            curMin = parseInt(song.currentTime / 60);
            curSeg = parseInt(song.currentTime % 60);

            (curSeg < 10) ? curSeg = '0' + curSeg : curSeg

            currentTime.text(curMin + ':' + curSeg);

            //audio tracker
            var size = parseInt(song.currentTime * barSize / song.duration);

            $('.progressBar').css("width", size + "px");
            
            if(song.ended){
                nextSong();
            }
        });

        $('.playlist li').removeClass('active');
        elem.addClass('active');
    }

    function playAudio() {
        song.play();
        $('.play').addClass('hidden');
        $('.pause').addClass('visible');

        ($('.volume').hasClass('muted')) ? muteAudio() : false ;
    }

    function stopAudio() {
        song.pause();
        $('.play').removeClass('hidden');
        $('.pause').removeClass('visible');
    }

    function nextSong(){
        stopAudio();
        var next = $('.playlist li.active').next();

        if (next.length == 0) {
            next = $('.playlist li:first-child');
        }
        initAudio(next);
        playAudio();
    }

    function prevSong(){
        stopAudio();
        var prev = $('.playlist li.active').prev();
        
        if (prev.length == 0) {
            prev = $('.playlist li:last-child');
        }
        initAudio(prev);
        playAudio();
    }

    function muteAudio() {
        if(song.muted == true){
            song.muted = false;
        }else{
            song.muted = true;
        }
    }

    function touchBar(e){
        if(!song.ended){
            var mouseX = e.pageX - $(".tracker").offset().left;
            var newTime = mouseX * song.duration / barSize;
            song.currentTime = newTime;

            $('.progressBar').css("width", mouseX + "px");
        }
    }

    function touchVolumeBar(e){
        var mouseX = e.pageX - $(".volumeTracker").offset().left;
        var newVol = mouseX / 100;

        if(newVol < 0.09){
            newVol = 0.0;
            $('.volumeCurrent').css("width", "0px");
        }else{
            if(newVol > 0.95){
                newVol = 1.0;
                $('.volumeCurrent').css("width", "100%");
            }else{
                $('.volumeCurrent').css("width", mouseX + "px");
            }
        }

        song.volume = newVol;
    }

    // play click
    $('.play').click(function (e) {
        e.preventDefault();
        playAudio();
    });

    // pause click
    $('.pause').click(function (e) {
        e.preventDefault();
        stopAudio();
    });

    //mute click
    $('.volume').click(function (e){
        e.preventDefault;
        muteAudio();
        $(this).toggleClass('muted');
    })

    //click on tracker bar
    $('.tracker').click(function (e){
        e.preventDefault;
        touchBar(e);
    });

    //click on Volume tracker bar
    $('.volumeTracker').click(function (e){
        e.preventDefault;
        touchVolumeBar(e);
    });

    // forward click
    $('.next').click(function (e) {
        e.preventDefault();
        nextSong();
    });

    // rewind click
    $('.prev').click(function (e) {
        e.preventDefault();
        prevSong();
    });

    //element playlist
    $('.playlist li').click(function () {
        stopAudio();
        initAudio($(this));
        playAudio();
    });

        /* --end audio code-- */

    $(window).scroll(function () {
        if ($(this).scrollTop() > 50) {
            $('.ind-up-link').addClass('link-active');
        } else {
            if ($('.ind-up-link').hasClass('link-active')) {
                $('.ind-up-link').removeClass('link-active');
            }
        }
    });

    $('.ind-up-link').on('click', function (e) {
        $('body,html').animate({
            scrollTop: 0
        }, 1100, "easeInOutExpo");
    });


    /* on responsive the principal screens will have a minified menu */
    $(window).resize(function () {
        if ($(window).width() <= 1100) {
            if ($("header").hasClass("header-collapsed") && $("main").hasClass("not-hover-main")) {
                $("header").removeClass("header-collapsed");
                $("main").removeClass("not-hover-main");
                $("main").addClass("hoverable-main");
            }
        } else {
            if (!$("header").hasClass("header-collapsed") && !$("main").hasClass("not-hover-main")) {
                $("header").addClass("header-collapsed");
                $("main").removeClass("hoverable-main");
                $("main").addClass("not-hover-main");
            }
        }
    });

    $(document).ready(function () {
        if ($(window).width() <= 1100) {
            if ($("header").hasClass("header-collapsed") && $("main").hasClass("not-hover-main")) {
                $("header").removeClass("header-collapsed");
                $("main").removeClass("not-hover-main");
                $("main").addClass("hoverable-main");
            }
        } else {
            if (!$("header").hasClass("header-collapsed") && !$("main").hasClass("not-hover-main")) {
                $("header").addClass("header-collapsed");
                $("main").removeClass("hoverable-main");
                $("main").addClass("not-hover-main");
            }
        }
    });
</script>
