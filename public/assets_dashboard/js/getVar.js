$('#jenis_surat').change(function(){
    var jenis_surat_id = $(this).val();  
    if(jenis_surat_id){
        $.ajax({
           type:"GET",
           url:"list-surat/getvariable?jenis_surat_id="+jenis_surat_id,
           dataType: 'JSON',
           success:function(res){     
                     
            if(res){
                // var html = '';
                // html += '<div id="inputFormRow">';
                // html += '<div class="input-group mb-3">';
                // html += '<label for="nama" class="col-form-label"> '+value+' </label>'
                // html += '<input type="text" name="data[]" class="form-control m-input" value="'+value+'" placeholder="Enter title"  autocomplete="off">';
                // html += '</div>';    
                $.each(res,function(index, value){
                    console.log(value);
                    //  $("#wadah").append('<div class="form-group col-lg-6">');
                     $("#new_inputan").append('<label for="nama" class="col-form-label"> '+value+' </label>');
                     $("#new_inputan").append('<input type="text" name="data[]" class="form-control m-input" placeholder="Masukkan '+value+'"  autocomplete="off">');
                });
            }else{
               $("#new_inputan").empty();
            }
           }
        });
    }else{
        $("#new_inputan").empty();
    }      
   });
