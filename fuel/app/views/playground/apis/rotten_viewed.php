<html>
    <head>
        <?= Asset::CSS('rotten.css'); ?>

        <title><?= $title; ?></title>

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

    </head>
    <body>
        <div id="wrapper">
            <div id="movie_info_box">
                <div id="movie_info_box">

                    <?= Form::open(array('action' => 'playground/apis/rotten/search/', 'method' => 'get')); ?>
                    <?= Form::label('Movie Title'); ?>
                    <?= Form::input('title'); ?>
                    <?= Form::submit(); ?>
                    <?= Form::close(); ?>
                </div>
                <table>
                    <?php
                    if ($movie != null && 1)
                    {
                        foreach ($movie as $m)
                        {
                            ?>
                            <tr>
                                <td>
                                    <div class="img_wrapper">
                                        <img height="200" width="145" src="<?= $m['image']; ?>"/>
                                    </div>
                                </td>
                                <td>
                                    <ul>
                                        <li>Title: <?= $m['title']; ?></li>
                                        <li>Year: <?= $m['year']; ?></li>
                                        <li>MPAA Rating: <?= $m['m_rating']; ?></li>
                                        <li><a href="remove_movie/<?= $m['ID']; ?>">Remove from List</a></li>
                                    </ul>
                                </td></tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>



            <div class="clearer"></div>
        </div>

    </body>
</html>