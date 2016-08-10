<script type='text/javascript'>

$('#geo_location').select2();

$('#sandbox-container_1 input').datepicker({
    format: "<?php echo \Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities::get_dtPicker_dateFormat(); ?>"
});

$('#sandbox-container_2 input').datepicker({
    format: "<?php echo \Allison\AllisonFbApiHelpers\helpers\Fb_AdUtilities::get_dtPicker_dateFormat(); ?>"
});

$("input[name=targeting_search_types]:radio").change(function () {

    var selected = $(this).val();
    if(selected == 'GEOLOCATION'){
        $("#text-target-search").attr('disabled','disabled');
        $("#target-place-holder").css("display", "none");;
    }else{
        $("#text-target-search").removeAttr('disabled');
        $("#btn-target-search").trigger("click");
        $("#target-place-holder").css("display", "block");;
    }

});

$("#btn_upload").click(function(e){

//    $('#btn_trigger').click();
//    alert('ok');
//    return;
//    alert('ok3');

    var data = new FormData();
    $.each($('#media_file')[0].files, function(i, file) {
        data.append('media_file', file);
    });

    $('#msg-modal').modal('show');
    showProgress();

    $.ajax({
        url: 'ad/ad-media',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',
        success: function(data){
            $('#btn_trigger').click();
            var res = appendSuccessMessage(data,'add-set-modal');
            console.log(data);
            hideProgress();
        }
    });
    //alert('ok');
});

$("#btn_upload_video").click(function(e){

    var data = new FormData();
    $.each($('#media_file_video')[0].files, function(i, file) {
        data.append('media_file', file);
        data.append('media_type','video');

    });


    $('#msg-modal').modal('show');
    showProgress();

    $.ajax({
        url: 'ad/ad-media-video',
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        type: 'POST',
        success: function(data){
            $('#btn_trigger').click();
            var res = appendSuccessMessage(data,'add-set-modal');
            console.log(data);
            hideProgress();
        }
    });
    //alert('ok');
})


$('.ad-creative-selector-link').click(function(event){

    event.preventDefault();

    var panel = $(this).attr('data-target');
    var htm = '';


    if(panel == '#adcreative-link-ad-modal'){

       toggleCreativeForms("#adcreative-linkad-placeholder");


       return;

    }else if(panel == '#adcreative-link-ad-conpage-modal'){

        toggleCreativeForms("#adcreative-linkad-conpage-placeholder");


        return;

    }else if(panel == '#adcreative-call-to-action-modal'){

        toggleCreativeForms("#adcreative_call_to_action_placeholder");

        return;

    }else if(panel == '#adcreative-video-page-modal'){

        toggleCreativeForms("#adcreative_video_page_placeholder");


        return;

    }else if(panel == '#adcreative-page-post-modal'){

        toggleCreativeForms("#adcreative-page-post-placeholder");


        return;

    }else if(panel == '#adcreative-carousel-ad-modal'){

        toggleCreativeForms("#adcreative_carousel_ad_placeholder");


        return;
    }






    //console.log(htm);
    //$('#adcreative-form-placeholder').html(htm);


})

function toggleCreativeForms(panel){

    $("#adcreative-linkad-conpage-placeholder").css('display', 'none');
    $("#adcreative-linkad-placeholder").css('display', 'none');
    $("#adcreative_call_to_action_placeholder").css('display', 'none');
    $("#adcreative_video_page_placeholder").css('display', 'none');
    $("#adcreative-page-post-placeholder").css('display', 'none');
    $("#adcreative_carousel_ad_placeholder").css('display', 'none');
    $(panel).css('display', 'block');





}
</script>
