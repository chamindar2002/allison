<script type='text/javascript'>

    $('#btn-target-search').click(function() {
        
        var text_target_search = $('#text-target-search').val();
        var limit_results = $('#limit_results').val()

        arr_group = [];//clear data from previous search events

        if(text_target_search != ''){

            $.ajax({
                type: "get",
                async: true,
                
                url: "<?php echo URL::to('ad/ajx-request-target-interest/') ?>/"+text_target_search,
                data: {limit:limit_results},
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

   
    $('#geo_location').select2();
    
    
    $("#target-place-holder").change (function () { 
    
       var selected_text = $('#target-place-holder option:selected').text();
       
       $("#selected_target_name").val(selected_text);
       
       //console.log(selected_text);
    
    });
    
    
    $('#sandbox-container_1 input').datepicker({
        format: "<?php echo \Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities::get_dtPicker_dateFormat(); ?>"
    });
    
    $('#sandbox-container_2 input').datepicker({
        format: "<?php echo \Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities::get_dtPicker_dateFormat(); ?>"
    });

//below code has been shifted to allison-scripts.js file

  var arr_group = [];

  console.log(JSON.stringify(arr_group));

  //on edit append previous values from table to the arr_group array
  if($("#selected_target_groups").val() !== ''){
      var arr_group = jQuery.parseJSON($("#selected_target_groups").val());
      dump(arr_group);
  }


  $(document).on("click", "input[class=chk_interests]", function(e) {
      var group_id = $(this).val();

      if($(this).is(':checked')){
          push(arr_group, group_id);
      }else{
          pop(arr_group, group_id);
      }

      console.log(JSON.stringify(arr_group));

      $("#selected_target_groups").val(JSON.stringify(arr_group));

      dump(arr_group);

  });

  function push(arr_group, item){
      arr_group.push(item);

  }

  function pop(arr_group, item){
      arr_group.pop(item);
  }

  function dump(arr_group){
      $.each(arr_group, function(index, val) {
            console.log(index+'=>'+val);
      });
  }

  $("input[name=targeting_search_types]:radio").change(function () {

      var selected = $(this).val();
      if(selected == 'GEOLOCATION'){
          $("#text-target-search").attr('disabled','disabled');
          $("#target-place-holder").html('');
      }else{
          $("#text-target-search").removeAttr('disabled');
          $("#btn-target-search").trigger("click");
      }

  });
</script>
