<script type='text/javascript'>
    
      
    
    $('#thumb_image_url').click(function() {
        
        var video_id = $('#video_id').val();
        
        if(video_id != ''){

            $.ajax({
                type: "get",
                async: true,
                
                url: "<?php echo URL::to('video-thumb-url') ?>",
                data: {video_id:video_id},
                beforeSend: function() {
                    $('#target-place-holder').html("<img src='{{ URL::asset('img') }}/ajax-loader.gif' id='form-ajax-loader' />").show();
                },

                success: function(html)
                {
                    $('#target-place-holder').html(html);
                }      

            })
        
        }

    });

   $(document).on("click", "input[class=opt_thumbs]", function(e) {
      var _uri = $(this).attr('uri');
           
      if($(this).is(':checked')){
          $('#thumb_image_url').val(_uri);
      }else{
          
      }
      
      //console.log(_uri);
      
      
  });
</script>
