<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>

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
                
                $('a').click(function(e)
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
            });
            
    
        </script>

        <title><?= $title; ?></title>
    </head>
    <body>
        <div id="wrapper">
            <div id="movie_info_box">
                <div id="movie_info_box">

                    <?= Form::open(array('action' => 'playground/apis/rotten/search', 'method' => 'get')); ?>
                    <?= Form::label('Movie Title'); ?>
                    <?= Form::input('title'); ?>
                    <?= Form::submit(); ?>
                    <?= Form::close(); ?>
                </div>

                <?php
                if ($movie != null)
                {
                    foreach ($movie as $m)
                    {
                        if(isset($m->r_c_rating))
                        $temp_r_c_rating = $m->r_c_rating;
                        else
                            $temp_r_c_rating = 'None';
                        
                        if(isset($m->r_a_rating))
                            $temp_r_a_rating = $m->r_a_rating;
                        else
                            $temp_r_a_rating = 'None';
                        
                        $add_link = '../rotten/add_movie/' . $m->id . '/?title=' . urlencode($m->title) . '&year=' . $m->year . '&img=' . urlencode($m->img) . '&m_rating=' . $m->m_rating . '&viewed=1&r_a_rating=' . $temp_r_a_rating . '&r_c_rating='.$temp_r_c_rating. '&r_a_score=' . $m->r_a_score . '&r_c_score=' . $m->r_c_score;
                        ?>
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <div class="img_wrapper">
                                            <img height="200" width="145" src="<?= $m->img; ?>"/>
                                            <div class="movie_btn">
                                                <a class="button_link" id="<?= $m->id; ?>" href="<?= $add_link; ?>">Add</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="movie_info">
                                        <ul>
                                            <li>Title: <?= $m->title; ?></li>
                                            <li>Year: <?= $m->year; ?></li>
                                            <li>MPAA Rating: <?= $m->m_rating; ?></li>
                                            <li><a id="<?= $m->id; ?>" href="<?= $add_link;?>">Add To Viewed List</a></li>
                                            <li><a href="<?=$add_link;?>">Add to Wish List!</a></li>
                                        </ul>
                                    </td>
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