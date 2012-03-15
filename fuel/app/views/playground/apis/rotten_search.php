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
                        if (isset($m->r_c_rating))
                            $temp_r_c_rating = $m->r_c_rating;
                        else
                            $temp_r_c_rating = 'None';

                        if (isset($m->r_a_rating))
                            $temp_r_a_rating = $m->r_a_rating;
                        else
                            $temp_r_a_rating = 'None';

                        if (isset($m->release_dvd))
                            $temp_release_dvd = $m->release_dvd;
                        else
                            $temp_release_dvd = 'NA';


                        if (isset($m->release_theater))
                            $temp_release_theater = $m->release_theater;
                        else
                            $temp_release_theater = 'NA';
                        
                         $add_link_1 = '../rotten/add_movie/' . $m->id . '/?title=' . urlencode($m->title) . '&year=' . $m->year . '&img=' . urlencode($m->img) . '&m_rating=' . $m->m_rating . '&viewed=';
                         $add_link_2 = '&r_a_rating=' . $temp_r_a_rating . '&r_c_rating=' . $temp_r_c_rating . '&r_a_score=' . $m->r_a_score . '&r_c_score=' . $m->r_c_score . '&runtime=' . $m->runtime . '&release_dvd=' . $temp_release_dvd . '&release_theater=' . $temp_release_theater;
                         
                         $add_link_wishlist = $add_link_1 . 0 . $add_link_2;
                         $add_link_viewed = $add_link_1 . 1 . $add_link_2;
                        ?>
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <div class="img_wrapper">
                                            <img height="200" width="145" src="<?= $m->img; ?>"/>
                                            <div class="movie_btn">
                                                <a class="button_link" id="<?= $m->id; ?>" href="<?= $add_link_viewed; ?>">Add</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="movie_info">
                                        <ul>
                                            <li>Title: <?= $m->title; ?></li>
                                            <li>Runtime: <?= (floor($m->runtime / 60) > 1 ? floor($m->runtime / 60) . ' hours' : floor($m->runtime / 60) . ' hour'); ?> and <?= $m->runtime % 60; ?> minutes</li>
                                            <li>Year: <?= $m->year; ?></li>
                                            <li>MPAA Rating: <?= $m->m_rating; ?></li>
                                            <li><a id="<?= $m->id; ?>" href="<?= $add_link_viewed; ?>">Add To Viewed List</a></li>
                                            <li><a href="<?= $add_link_wishlist; ?>">Add to Wish List!</a></li>
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