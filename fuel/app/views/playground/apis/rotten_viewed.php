<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>
        <? //= Asset::JS('uservoice.js'); ?>

        <title><?= $title; ?></title>

        <?= Asset::js('jquery.js'); ?>       
        <script type="text/javascript">
            $('document').ready(function()
            {
                switch (<?= Input::get('view') != '' ? "'" . Input::get('view') . "'" : "'albumlist'"; ?>)
                {
                    case 'list':
                       
                        view_list();
                        break;
                    case 'albumlist':
                        view_albumlist()
                        break;
                    case 'grid':
                        view_grid();
                        break;
                    }
                    
                    // Highlight the movie_head_item that is currently being sorted
                    $orderby = <?= Input::get('orderby') != '' ? "'" . Input::get('orderby') . "'" : "'title'"; ?>;
                                        
                    $('.movie_head_item.content.' + $orderby + ' a').css('background','#D6DAE0');
                    
                
                
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
                                view_list();
                                break;
                            
                            case 'albumlist':
                                view_albumlist();
                            
                                break;
                            case 'grid':
                                view_grid();
                                break;
                        }
                    })
                
                    function view_list()
                    {
//                        $('div#movie_info_box').css('border-top','0');
                        $('span.header').css('display','none');
                        $('div.movie_item').css('padding','5px 5px 5px 60px');
                            
                        $('.movie_item').css('height','50px').css('margin-bottom','0px');
                            
                            
                        $('div.content').css('float', 'left');
                        $('div#movie_head').css('display', 'block');
                        $('div.movie_item.odd').css('background', '#F3F6FA');
                            
                            
                        $('.img_wrapper').css('height', '50px').css('width','40px');
                        $('.content.title').css('width', '50%');
                        $('.content.runtime').css('width', '10%').css('text-align','right');
                        $('.content.year').css('width', '10%').css('text-align','right');
                        $('.content.m_rating').css('width', '10%').css('text-align','right');
                        $('.content.our_rating').css('width', '10%').css('text-align','right');
                    }
                
                    function view_albumlist()
                    {
                        $('.img_wrapper').css('display','block').css('height', '200px').css('width','145px');
                        $('span.header').css('display','inline');
                        $('div.movie_item').css('padding','5px 10px 10px 150px');
                        $('div.movie_item').css('width','100%');
                        $('div.movie_item').css('float','none');
                        $('.content').css('width', '100%');
                        $('.movie_item').css('height','187px');
                        $('div.content').css('display', 'block');
                        $('div#movie_head').css('display', 'none');
                        
                        $('.content.title').css('width', '100%').css('display','inline');
                        $('.content.runtime').css('width', '100%').css('text-align','left').css('padding-right','0px');
                        $('.content.year').css('width', '100%').css('text-align','left').css('padding-right','0px');
                        $('.content.m_rating').css('width', '100%').css('text-align','left').css('padding-right','0px');
                        $('.content.our_rating').css('width', '100%').css('text-align','left').css('padding-right','0px');
                    }
                
                    function view_grid()
                    {
                        $('.img_wrapper').css('display','block').css('height', '200px').css('width','145px');
                        $('span.header').css('display','inline');
                        $('.movie_item').css('margin-bottom','0px');
                        $('div.content').css('display','none');
                        $('div.movie_item').css('width','145px').css('height','202px').css('padding','0px').css('float','left');
                        $('div#movie_head').css('display', 'none');
                    }
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
                <div class="title movie_head_item content"><a href="viewed?orderby=title&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Title</a></div>
                <div class="runtime movie_head_item content"><a href="viewed?orderby=runtime&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Runtime</a></div>
                <div class="year movie_head_item content"><a href="viewed?orderby=year&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Year</a></div>
                <div class="m_rating movie_head_item content"><a href="viewed?orderby=m_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Rating</a></div>
                <div class="our_rating movie_head_item content"><a href="viewed?orderby=our_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Our Rating</a></div>
            </div>
            <div id="movie_info_box">
                <?php
                if ($movie != null && 1)
                {
                    $odd = 'true';
                    foreach ($movie as $m)
                    {
                        ?>
                        <div class="movie_item <?= $odd == 'true' ? 'odd' : 'even'; ?>" id="<?= $m['ID']; ?>">

                            <div class="img_wrapper">
                                <img height="100%" width="100%" src="<?= $m['image']; ?>"/>
                                <div class="movie_btn">
                                    <a class="button_link remove" id="<?= $m['ID']; ?>" href="hide_movie/<?= $m['ID']; ?>">Remove</a>
                                </div>
                            </div>
                            <div class="content title"><span class="header title">Title: </span><?= $m['title']; ?></div>
                            <div class="content runtime"><span class="header runtime">Runtime: </span><?= (floor($m['runtime'] / 60) > 1 ? floor($m['runtime'] / 60) . ' hours' : floor($m['runtime'] / 60) . ' hour'); ?> and <?= $m['runtime'] % 60; ?> minutes</div>
                            <div class="content year"><span class="header year">Year: </span><?= $m['year']; ?></div>
                            <div class="content m_rating"><span class="header m_rating">Rating: </span><?= $m['m_rating']; ?></div>
                            <div class="clearer"></div>

                        </div>
                        <?php
                        // Toggle even/odd
                        if ($odd == 'true')
                            $odd = 'false';
                        else
                            $odd = 'true';
                    }
                }
                ?>

            </div>



            <div class="clearer"></div>
        </div>

    </body>
</html>