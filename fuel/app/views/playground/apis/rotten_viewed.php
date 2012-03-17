<html>
    <head>
        <?= Asset::CSS('reset.css'); ?>
        <?= Asset::CSS('rotten.css'); ?>
        <?= Asset::js('uservoice.js', array(), null, true); ?>

        <title><?= $title; ?></title>

        <?= Asset::js('jquery.js'); ?>   
        <script type="text/javascript">
            $('document').ready(function()
            {                 
                // Highlight the movie_head_item that is currently being sorted
                $orderby = <?= Input::get('orderby') != '' ? "'" . Input::get('orderby') . "'" : "'title'"; ?>;
            });
        </script>
        <?= Asset::js('logic.js', array(), null, true); ?>
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
                        <li><a href="search">S</a></li>
                        <li><a href="viewed">V</a></li>
                        <li><a href="wishlist">W</a></li>
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
                    <div class="title movie_head_item content"><a href="viewed?orderby=title&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>">Title</a></div>
                    <div class="runtime movie_head_item content"><a href="viewed?orderby=runtime&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>">Runtime</a></div>
                    <div class="year movie_head_item content"><a href="viewed?orderby=year&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>">Year</a></div>
                    <div class="m_rating movie_head_item content"><a href="viewed?orderby=m_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>">Rating</a></div>
                    <div class="our_rating movie_head_item content"><a href="viewed?orderby=our_rating&method=<?= Input::get('method') == 'ASC' ? 'DESC' : 'ASC'; ?>">Our Rating</a></div>
                </div>
            </div>
            <div id="movie_info_box">
                <?php
                if ($movie != null)
                {
                    $odd = 'true';
                    foreach ($movie as $m)
                    {
                        ?>
                        <div class="movie_item <?= $odd == 'true' ? 'odd' : 'even'; ?>" id="<?= $m['ID']; ?>">
                            <div id="<?= $m['ID']; ?>" class="img_wrapper">
                                <img id="<?= $m['ID']; ?>" height="100%" width="100%" src="<?= $m['image']; ?>"/>
                                <div id="<?= $m['ID']; ?>" class="movie_btn">
                                    <a id="<?= $m['ID'];?>" class="button_link background_link" href="hide_movie/<?= $m['ID']; ?>">Remove</a>
                                </div>
                            </div>
                            <div class="content title"><span class="header title">Title: </span><?= $m['title']; ?></div>
                            <div class="content runtime"><span class="header runtime">Runtime: </span><?= (floor($m['runtime'] / 60) > 1 ? floor($m['runtime'] / 60) . ' hrs' : floor($m['runtime'] / 60) . ' hr'); ?> and <?= $m['runtime'] % 60; ?> min</div>
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
        <div class="clearer" style="display:block"></div>
    </body>
</html>