<script type='text/javascript'>

    $('#url_key_words').keyup(function (e) {

        var str = $('#url_key_words').val();
        var regex = new RegExp("^[a-zA-Z0-9]+$");

        //if space bar is pressed replace with comman
        if (e.keyCode == 32) {
            console.log('space bar');

            str = str.replace(" ", ",");
            str = str.replace(",,", ",");//if space bar presed twice remove double comman and replace with one

        }
        //if comma is pressed remove it
        if (e.keyCode == 188) {
            str = str.slice(0, -1);

        }

        $('#url_key_words').val(str);
        //console.log('key code : ' + e.keyCode);
    });

    $('#website_traffic').change(function (e) {
         var website_traffic = $('#website_traffic').val();
         if(website_traffic == 'specific_pages'){
             
             $('#url_key_words').removeAttr("disabled"); 
             $('#rule_definer').removeAttr("disabled"); 
         }else if(website_traffic == 'anyone_who_visits'){
          
             $('#url_key_words').attr("disabled", "disabled"); 
             $('#rule_definer').attr("disabled", "disabled"); 
         }
    });



</script>
