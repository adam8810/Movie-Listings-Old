$('document').ready(function()
    {
        var $hash = window.location.hash.substring();
               
        $.get('get_view', function(view){
            
            if(window.location.hash)
            {   
                switch ($hash)
                {
                    case '#list':
                        $.ajax({
                            url: 'set_view/list'
                        });
                        view_list();              
                    
                        break;
                    case '#albumlist':
                        $.ajax({
                            url: 'set_view/albumlist'
                        });
                        view_albumlist();
                    
                        break;
                    case '#grid':
                        $.ajax({
                            url: 'set_view/grid'
                        });
                        view_grid();
                        break;
                }
            }
            else if(view != '') // If the view session variable isn't set, default to albumlist()'
            {
                switch (view[0])
                {
                    case 'l':
                        view_list();              
                    
                        break;
                    case 'a':
                        view_albumlist();
                    
                        break;
                    case 'g':
                        view_grid();
                        break;
                }
            }
            else
            {
                view_albumlist();
            }
        });
                
        $('.movie_head_item.content.' + $orderby + ' a').css('background','#D6DAE0');
           
        // Hover effect of Add/Remove Button
        $('.img_wrapper').hover(function(){ // Hover on
            var value_id = this.id;
            
//            setTimeout(function() {
                $('#' + value_id + ' .movie_info').slideDown('fast').css('display','block');
                $('#' + value_id + ' .movie_btn').slideDown(200).css('display','block');
//            }, 300, value_id);
            
        }, function(){ // Off
            $('#' + this.id + ' .movie_info').slideUp(90)
            $('#' + this.id + ' .movie_btn').slideUp(190)
            
        })
                
        $('.transition_out').click(function(e)
        {
            $('.movie_item#' + this.id).animate({
                width:0,
                height:0
            }, 300, "linear", function(){
                $('.movie_item#' + this.id).css('display','none')
            } );                   
        });
                
        $('a.view_btn').click(function(e){
            e.preventDefault();                    
                    
            switch(this.id)
            {
                case 'list':
                    $.ajax({
                        url: 'set_view/list'
                    });
                    view_list();
                    break;
                            
                case 'albumlist':
                    $.ajax({
                        url: 'set_view/albumlist'
                    });
                    view_albumlist();
                            
                    break;
                case 'grid':
                    $.ajax({
                        url: 'set_view/grid'
                    });
                    view_grid();
                    break;
            }
        });
        
        $('a.background_link').click(function(e)
        {
            e.preventDefault();
            
            $.ajax({
                url: this,
                success: function(){
                            
                }
            });            
        });
        
        // Stars
        $('.5star').hover(function(){
            $('a#'+ this.id + '.background_link.1star').css('display', 'none');
            $('a#'+ this.id + '.1star').addClass('full_star');
        }, function(){
            $('#1star').removeClass('full_star');
        })
        
                
        function view_list()
        {
            $('div#movie_info_box').css('display','block');
            $('span.header').css('display','none');
            $('div.movie_item').css('padding','5px 5px 5px 50px');
                            
            $('div#movie_head').css('display', 'block');
            $('.movie_item').css('height','50px').css('width','100%').css('margin-bottom','0px');
                            
            $('div.content').css('float', 'left');
            $('div#movie_head').css('display', 'block');
            $('div.movie_item.odd').css('background', '#F3F6FA');
                            
                            
            $('.img_wrapper').css('height', '50px').css('width','40px');
            $('.movie_head_item.image').css('width', '40px').css('height','37px').css('background','#F3F6FA').css('text-indent','-9999');
                        
                        
            $('.content.title').css('width', '50%').css('display','inline');
            $('.content.runtime').css('width', '10%').css('text-align','right').css('display','block');
            $('.content.year').css('width', '10%').css('text-align','right').css('display','block');
            $('.content.m_rating').css('width', '10%').css('text-align','right').css('display','block');
            $('.content.our_rating').css('width', '10%').css('text-align','right').css('display','block');
        }
                
        function view_albumlist()
        {
            $('div#movie_info_box').css('display','block');
            $('.img_wrapper').css('display','block').css('height', '200px').css('width','145px');
            $('span.header').css('display','inline');
            $('div.movie_item').css('padding','5px 10px 10px 150px').css('float','none').css('width','100%').css('height','187px');
            $('.content').css('width', '100%');
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
            $('div#movie_info_box').css('display','block');
            $('.img_wrapper').css('display','block').css('height', '200px').css('width','145px');
            $('span.header').css('display','inline');
            $('.movie_item').css('margin-bottom','0px');
            $('div.content').css('display','none');
            $('div.movie_item').css('width','145px').css('height','199px').css('padding','0px').css('float','left');
            $('div#movie_head').css('display', 'none');
        }
    });