<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>

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
                
                $('.button_link').click(function(e)
                {
                    // Prevent from navigating away from page
                    e.preventDefault();
                                    
                    // Use Ajax call to interact with database
                    $.ajax({
                        url: this,
                        success: function(){
                            
                        }
                    })
                                    
                });
                
                $('.view_btn').click(function(e){
                    e.preventDefault();
                    
                    switch(this.id)
                    {
                        case 'list':
                            $('tr.tr_image').css('display','none');
                            $('td.title').css('display','none');
                            
                            break;
                        case 'albumlist':
                            $('tr.tr_image').css('display','table-row');
                            $('td.title').css('display','table-row');
                            break;
                        case 'grid':
                            $('tr.tr_image').css('display','table-row');
                            $('td.title').css('display','table-row');
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

            <div id="movie_info_box">
                <?php
                if ($movie != null && 1)
                {
                    foreach ($movie as $m)
                    {
                        ?>
                        <div id="<?= $m['ID']; ?>">
                            <table class="movie_table">
                                <tr class="tr_image">
                                    <td rowspan="7">
                                        <div class="img_wrapper">
                                            <img height="200" width="145" src="<?= $m['image']; ?>"/>
                                            <div class="movie_btn">
                                                <a class="button_link" id="<?= $m['ID']; ?>" href="remove_movie/<?= $m['ID']; ?>">Remove</a>
                                            </div>
                                        </div>
                                    </td>
                                <tr class="tr_item"><td class="header title">Title</td><td class="content"><?= $m['title']; ?></td></tr>
                                <tr class="tr_item"><td class="header runtime">Runtime</td><td class="content"><?= (floor($m['runtime'] / 60) > 1 ? floor($m['runtime'] / 60) . ' hours' : floor($m['runtime'] / 60) . ' hour'); ?> and <?= $m['runtime'] % 60; ?> minutes</td></tr>
                                <tr class="tr_item"><td class="header year">Year</td><td class="content"><?= $m['year']; ?></td></tr>
                                <tr class="tr_item"><td class="header m_rating">MPAA Rating</td><td class="content"><?= $m['m_rating']; ?></td></tr>
                                </tr>
                            </table>
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