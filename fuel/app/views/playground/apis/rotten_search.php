<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>

        <?= Asset::js('jquery.js'); ?>       
        <script type="text/javascript">
            $('document').ready(function()
            {
                
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
                        ?>
                        <div>
                            <table>
                                <tr>
                                    <td>
                                        <div class="img_wrapper">
                                            <img height="200" width="145" src="<?= $m->img; ?>"/>
                                            <div class="movie_add_btn">
                                                <a class="add_link" id="<?= $m->id; ?>" href="../rotten/add_movie/<?= $m->id; ?>/?title=<?= urlencode($m->title); ?>&year=<?= $m->year; ?>&img=<?= urlencode($m->img); ?>&m_rating=<?= $m->m_rating; ?>&viewed=1">Add</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="movie_info">
                                        <ul>
                                            <li>Title: <?= $m->title; ?></li>
                                            <li>Year: <?= $m->year; ?></li>
                                            <li>MPAA Rating: <?= $m->m_rating; ?></li>
                                            <li><a id="<?= $m->id; ?>" href="../rotten/add_movie/<?= $m->id; ?>/?title=<?= urlencode($m->title); ?>&year=<?= $m->year; ?>&img=<?= urlencode($m->img); ?>&m_rating=<?= $m->m_rating; ?>&viewed=1">Add To Viewed List</a></li>
                                            <li><a href="../rotten/add_movie/<?= $m->id; ?>/?title=<?= urlencode($m->title); ?>&year=<?= $m->year; ?>&img=<?= urlencode($m->img); ?>&m_rating=<?= $m->m_rating; ?>&viewed=0">Add to Wish List!</a></li>
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