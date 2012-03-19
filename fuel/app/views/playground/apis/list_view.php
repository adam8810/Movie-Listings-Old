<html>
    <head>
        <?= Asset::CSS('reset.css'); ?>
        <?= Asset::CSS('rotten.css'); ?>
        <?= Asset::js('uservoice.js', array(), null, true); ?>

        <?= Asset::js('jquery.js'); ?>   
        <script type="text/javascript">
            $('document').ready(function()
            {                 
                // Highlight the movie_head_item that is currently being sorted
                $orderby = <?= Input::get('orderby') != '' ? "'" . Input::get('orderby') . "'" : "'title'"; ?>;
            });
        </script>
        <?= Asset::js('logic.js', array(), null, true); ?>
        <title><?= $title; ?></title>
    </head>
    <body>
        <div id="wrapper">
            <div id="top_box">
                <div id="movie_form_box">

                    <?= Form::open(array('action' => 'playground/apis/rotten/search', 'method' => 'get')); ?>
                    <?= Form::label('Movie Title'); ?>
                    <?= Form::input('title'); ?>
                    <?= Form::submit(); ?>
                    <?= Form::close(); ?>
                </div>
                <div id="page_controls">
                    <ul>
                        <li><a href="search">Search</a></li>
                        <li><a href="viewed">Viewed</a></li>
                        <li><a href="wishlist">Wishlist</a></li>
                    </ul>
                </div>
                <div id="view_controls">
                    <ul>
                        <li><a class="view_btn" id="list" href="#list">List</a></li>
                        <li><a class="view_btn" id="albumlist" href="#albumlist">Album List</a></li>
                        <li><a class="view_btn" id="grid" href="#grid">Grid</a></li>
                    </ul>
                </div>
                <div class="clearer"></div>
                <div id="movie_head">
                    <div class="image movie_head_item content">Image</div>
                    <div class="title movie_head_item content"><a href="viewed?orderby=title&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Title</a></div>
                    <div class="runtime movie_head_item content"><a href="viewed?orderby=runtime&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Runtime</a></div>
                    <div class="year movie_head_item content"><a href="viewed?orderby=year&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Year</a></div>
                    <div class="m_rating movie_head_item content"><a href="viewed?orderby=m_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Rating</a></div>
                    <div class="our_rating movie_head_item content"><a href="viewed?orderby=our_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>&view=<?= Input::get('view'); ?>">Our Rating</a></div>
                </div>
            </div>
            <div id="movie_info_box">


                <?php
                if ($movie != null)
                {
                    foreach ($movie as $m)
                    {
                        $odd = 'true';

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

                        $add_link_1 = $control_action . '_movie/' . $m->id . '/?title=' . urlencode($m->title) . '&year=' . $m->year . '&img=' . urlencode($m->img) . '&m_rating=' . $m->m_rating . '&viewed=';
                        $add_link_2 = '&r_a_rating=' . $temp_r_a_rating . '&r_c_rating=' . $temp_r_c_rating . '&r_a_score=' . $m->r_a_score . '&r_c_score=' . $m->r_c_score . '&runtime=' . $m->runtime . '&release_dvd=' . $temp_release_dvd . '&release_theater=' . $temp_release_theater;

                        $add_link_wishlist = $add_link_1 . 0 . $add_link_2;
                        $add_link_viewed = $add_link_1 . 1 . $add_link_2;
                        ?>
                        <div class="movie_item <?= $odd == 'true' ? 'odd' : 'even'; ?>" id="<?= $m->id; ?>">

                            <div id="<?= $m->id; ?>" class="img_wrapper">
                                <img id="<?= $m->id; ?>" height="100%" width="100%" src="<?= $m->img; ?>"/>
                                <div id="<?= $m->id; ?>" class="movie_btn">
                                    <a id="<?= $m->id; ?>" class="button_link background_link" id="<?= $m->id; ?>" href="<?= $add_link_viewed; ?>"><?= $control_action; ?></a>
                                </div>
                            </div>    

                            <div class="content title"><span class="header title">Title: </span><?= $m->title; ?></div>
                            <div class="content runtime"><span class="header runtime">Runtime: </span><?= (floor($m->runtime / 60) > 1 ? floor($m->runtime / 60) . ' hrs' : floor($m->runtime / 60) . ' hr'); ?> and <?= $m->runtime % 60; ?> min</div>
                            <div class="content year"><span class="header year">Year: </span><?= $m->year; ?></div>
                            <div class="content m_rating"><span class="header m_rating">Rating: </span><?= $m->m_rating; ?></div>
                            <?php
                            if (isset($m->our_rating))
                            {
                                ?>
                            <div class="content our_rating"><span class="header our_rating">Our Rating: </span><?= $m->our_rating; ?></div>
                            <?php
                            }
                            
                            if ($control_action == 'add')
                            {
                                ?>
                                <div class="content wishlist"><a class="background_link" href="<?= $add_link_wishlist; ?>">Add to Wish List!</a></div>
                                <?php
                            }
                            ?>
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