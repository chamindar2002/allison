<script type='text/javascript'>


    $(document).on("click", "input[class=chk_media]", function(e) {


        if($(this).is(':checked')){
            $('#lbl_media_file_name').html($(this).attr('prop_1'));
            $('#mediaModal').modal('toggle');
        }

    });
</script>
