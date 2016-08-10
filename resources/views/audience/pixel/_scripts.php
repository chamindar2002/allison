<script type='text/javascript'>

    $('#btn-copy-content').click(function() {
      
        var embed_code = document.getElementById('embed_code').innerHTML; 

        if(embed_code != ''){

            window.clipboardData.setData('Text',embed_code); 
            console.log(embed_code);
            
        }

    });

   

</script>
