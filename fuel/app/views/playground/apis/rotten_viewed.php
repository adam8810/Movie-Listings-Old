<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>
        <? //= Asset::JS('uservoice.js'); ?>

        <title><?= $title; ?></title>

        <?= Asset::js('jquery.js'); ?>       
        <script type="text/javascript">
            $('document').ready(function()
            {
                // Hover effect of Add/Remove Button
                $('.img_wrapper').hover(function(){
                    $('.movie_btn').css('display','block')
                }, function(){
                    $('.movie_btn').css('display','none')
                })
                
                $('.button_link.remove').click(function(e)
                {
                    // Prevent from navigating away from page
                    e.preventDefault();
                                    
                    // Use Ajax call to interact with database
                    $.ajax({
                        url: this,
                        success: function(){
                            
                        }
                    })
                    
                    $('.movie_item#' + this.id).animate({
                        height:0, width:0, opacity: .5
                    }, 100, "linear", function(){
                        $('.movie_item#' + this.id).css('display','none')
                    } );
                                    
                });
                
                
                $('a.view_btn').click(function(e){
                    e.preventDefault();
                    
                    
                    switch(this.id)
                    {
                        case 'list':
//                            $('div#movie_info_box').css('height','100%');
                            $('.img_wrapper').css('display','none');
                            $('span.header').css('display','none');
                            $('div.movie_item').css('padding','5px');
                            $('.content.title').css('width', 400);
                            $('.movie_item').css('height','50px');
                            $('.movie_item').css('margin-bottom','0px');
                            $('.content.runtime').css('width', 100);
                            $('.content.year').css('width', 50);
                            $('.content.m_rating').css('width', 70);
                            $('div.content').css('float', 'left');
                            $('div#movie_head').css('display', 'block');
                            $('div#movie_info_box').css('width','800px');
                            break;
                            
                        case 'albumlist':
                            $('.img_wrapper').css('display','block');
                            $('span.header').css('display','inline');
                            $('div.movie_item').css('padding','5px 10px 10px 150px');
                            $('div.movie_item').css('width','100%');
                            $('div.movie_item').css('float','none');
                            $('.content').css('width', '100%');
                            $('.movie_item').css('height','187px');
                            $('.movie_item').css('margin-bottom','10px');
                            $('div.content').css('display', 'block');
                            $('div#movie_head').css('display', 'none');
                            $('div#movie_info_box').css('width','800px');
                            
                            break;
                        case 'grid':
                            $('.img_wrapper').css('display','block');
                            $('span.header').css('display','inline');
                            $('.movie_item').css('margin-bottom','0px');
                            $('span.header').css('display','inline');
                            $('div.content').css('display','none');
                            $('div.movie_item').css('width','145px');
                            $('div.movie_item').css('height','202px');
                            $('div.movie_item').css('padding','0px');
                            $('div.movie_item').css('float','left');
                            $('div#movie_info_box').css('width','1015px');
                            $('div#movie_head').css('display', 'none');
                            break;
                    }
                })
            });
            
    
        </script>

    </head>
    <body>
        <div id="wrapper">

            <div id="movie_form_box">

                <?= Form::open(array('action' => 'playground/apis/rotten/search/', 'method' => 'get')); ?>
                <?= Form::label('Movie Title'); ?>
                <?= Form::input('title'); ?>
                <?= Form::submit(); ?>
                <?= Form::close(); ?>
                <div id="view_controls">
                    <ul>
                        <li><a class="view_btn" id="list" href="#List">List</a></li>
                        <li><a class="view_btn" id="albumlist" href="#AlbumList">Album List</a></li>
                        <li><a class="view_btn" id="grid" href="#Grid">Grid</a></li>
                    </ul>
                </div>
            </div>
            <div class="clearer"></div>
            <div id="movie_head">
                <div class="title movie_head_item content">Title</div>
                <div class="runtime movie_head_item content">Runtime</div>
                <div class="year movie_head_item content">Year</div>
                <div class="m_rating movie_head_item content">MPAA Rating</div>
            </div>
            <div id="movie_info_box">
                <?php
                if ($movie != null && 1)
                {
                    foreach ($movie as $m)
                    {
                        ?>
                        <div class="movie_item" id="<?= $m['ID']; ?>">

                            <div class="img_wrapper">
                                <img height="200" width="145" src="<?= $m['image']; ?>"/>
                                <div class="movie_btn">
                                    <a class="button_link remove" id="<?= $m['ID']; ?>" href="hide_movie/<?= $m['ID']; ?>">Remove</a>
                                </div>
                            </div>
                            <div class="content title"><span class="header title">Title: </span><?= $m['title']; ?></div>
                            <div class="content runtime"><span class="header runtime">Runtime: </span><?= (floor($m['runtime'] / 60) > 1 ? floor($m['runtime'] / 60) . ' hours' : floor($m['runtime'] / 60) . ' hour'); ?> and <?= $m['runtime'] % 60; ?> minutes</div>
                            <div class="content year"><span class="header year">Year: </span><?= $m['year']; ?></div>
                            <div class="content m_rating"><span class="header m_rating">MPAA Rating: </span><?= $m['m_rating']; ?></div>
                            <div class="clearer"></div>

                        </div>
                        <?php
                    }
                }
                ?>

            </div>



            <div class="clearer"></div>
        </div>

    </body>
</html>