<script type='text/javascript'>
    
      
    
    $('#post_id').click(function() {
        
        var page_id = $('#page_id').val();
        
        if(page_id != ''){

            $.ajax({
                type: "get",
                async: true,
                
                url: "<?php echo URL::to('list-page-posts') ?>",
                data: {page_id:page_id},
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

    $(document).on("click", "input[class=opt_posts]", function(e) {
      var _pid = $(this).val();

      if($(this).is(':checked')){
          $('#post_id').val(_pid);
      }else{

      }

      //console.log(_uri);

    });
</script>
