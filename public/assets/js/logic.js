$('document').ready(function()
    {
        var $hash = window.location.hash.substring();
        
        if(!window.location.hash)
        {
            $hash = '#albumlist';
        }
            
        switch ($hash)
        {
            case '#list':
                view_list();
                break;
            case '#albumlist':
                view_albumlist();
                break;
            case '#grid':
                view_grid();
                break;
        }
        
        $('.movie_head_item.content.' + $orderby + ' a').css('background','#D6DAE0');
           
        // Hover effect of Add/Remove Button
        $('.img_wrapper').hover(function(){
            $('#' + this.id +' .movie_btn').css('display','block')
        }, function(){
            $('#' + this.id +' .movie_btn').css('display','none')
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
                    
            $('.movie_item#' + this.id).animate({
                height:0, 
                width:0, 
                opacity: .5
            }, 100, "linear", function(){
                $('.movie_item#' + this.id).css('display','none')
            } );
                                    
        });
        
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
                height:0, 
                width:0, 
                opacity: .5
            }, 100, "linear", function(){
                $('.movie_item#' + this.id).css('display','none')
            } );
                                    
        });
                
        $('a.view_btn').click(function(e){
            //            e.preventDefault();
                    
                    
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
            $('div#movie_info_box').css('display','block');
            $('span.header').css('display','none');
            $('div.movie_item').css('padding','5px 5px 5px 50px');
                            
            $('.movie_item').css('height','50px').css('margin-bottom','0px');
                            
            $('div.content').css('float', 'left');
            $('div#movie_head').css('display', 'block');
            $('div.movie_item.odd').css('background', '#F3F6FA');
                            
                            
            $('.img_wrapper').css('height', '50px').css('width','40px');
            $('.movie_head_item.image').css('width', '40px').css('height','37px').css('background','#F3F6FA').css('text-indent','-9999');
                        
                        
            $('.content.title').css('width', '50%');
            $('.content.runtime').css('width', '10%').css('text-align','right');
            $('.content.year').css('width', '10%').css('text-align','right');
            $('.content.m_rating').css('width', '10%').css('text-align','right');
            $('.content.our_rating').css('width', '10%').css('text-align','right');
        }
                
        function view_albumlist()
        {
            $('div#movie_info_box').css('display','block');
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
            $('div#movie_info_box').css('display','block');
            $('.img_wrapper').css('display','block').css('height', '200px').css('width','145px');
            $('span.header').css('display','inline');
            $('.movie_item').css('margin-bottom','0px');
            $('div.content').css('display','none');
            $('div.movie_item').css('width','145px').css('height','202px').css('padding','0px').css('float','left');
            $('div#movie_head').css('display', 'none');
        }
    });