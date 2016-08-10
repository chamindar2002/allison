<script type='text/javascript'>


    $(document).on("click", "input[class=chk_media]", function(e) {


        if($(this).is(':checked')){
            var media_file_id = $(this).val();
            $('#media_id_hidden').val(media_file_id);
        }

    });
</script>
