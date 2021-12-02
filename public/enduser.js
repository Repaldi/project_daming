    $('#provinsi').change(function(){
    var provinsi_id = $(this).val();   
    if(provinsi_id){
        $.ajax({
           type:"GET",
           url:"/getkabupatenuser?provinsi_id="+provinsi_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#kabupaten").empty();
                $("#kecamatan").empty();
                $("#tipebangunan").empty();
                $("#kabupaten").append('<option>Pilih Kabupaten</option>');
                $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                $("#tipebangunan").append('<option>Pilih Tipe Bangunan</option>');
                $.each(res,function(nama_kabupaten, id){
                    $("#kabupaten").append('<option value="'+id+'">'+nama_kabupaten+'</option>');
                });
            }else{
               $("#kabupaten").empty();
               $("#kecamatan").empty();
               $("#tipebangunan").empty();
            }
           }
        });
    }else{
        $("#kabupaten").empty();
        $("#kecamatan").empty();
        $("#tipebangunan").empty();
    }      
   });

   $('#kabupaten').change(function(){
    var kabupaten_id = $(this).val();    
    if(kabupaten_id){
        $.ajax({
           type:"GET",
           url:"/getkecamatanuser?kabupaten_id="+kabupaten_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#kecamatan").empty();
                $("#tipebangunan").empty();
                $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                $("#tipebangunan").append('<option>Pilih Tipe Bangunan</option>');
                $.each(res,function(nama_kecamatan,id){
                    $("#kecamatan").append('<option value="'+id+'">'+nama_kecamatan+'</option>');
                });
            }else{
               $("#kecamatan").empty();
            }
           }
        });
    }else{
        $("#kecamatan").empty();
    }      
   });

   $('#kecamatan').change(function(){
    var kecamatan_id = $(this).val();    
    if(kecamatan_id){
        $.ajax({
           type:"GET",
           url:"/gettipebangunanuser?kecamatan_id="+kecamatan_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#tipebangunan").empty();
                $("#tipebangunan").append('<option>Pilih Tipe Bangunan</option>');
                $.each(res,function(nama_tipe_bangunan,id){
                    console.log(nama_tipe_bangunan);
                    $("#tipebangunan").append('<option value="'+id+'">'+nama_tipe_bangunan+'</option>');
                });
            }else{
               $("#tipebangunan").empty();
            }
           }
        });
    }else{
        $("#tipebangunan").empty();
    }      
   });

   $('#tipebangunan').change(function(){
        $('button#searchData').prop('disabled', false)           
   });


   
$(document).ready(function(){
    $('#totalHarga').hide()
    $('#formTambahan').hide()
    $(document).keypress(function(event){
        if (event.which == '13') {
              event.preventDefault();
           }
    })
    $(document).on('click', '#searchData', function(e){
        $('#totalHarga').show()
        $('#formTambahan').show()
       
        var provinsi_id = document.getElementById("provinsi").value;
        var kabupaten_id = document.getElementById("kabupaten").value;
        var kecamatan_id = document.getElementById("kecamatan").value;
        var tipebangunan_id = document.getElementById("tipebangunan").value;
        $.ajax({
            url: "/search-data-kalkulasi",
            type: "GET",
            dataType: 'json',
            data: {
                provinsi_id: provinsi_id,
                kabupaten_id: kabupaten_id,
                kecamatan_id: kecamatan_id,
                tipebangunan_id: tipebangunan_id    
            },
            success: function(data) {
                var total_harga = $.parseJSON(data);
                 $('#total_harga_bangunan').html('<strong> Harga Bangunan Standar di Daerah Anda adalah : Rp.' + total_harga + ' !</strong> , Harga Bangunan belum termasuk harga tukang dan waktu pengerjaan')
                  
            }
        });

        $.ajax({
            url: "/search-data-nama-jasa",
            type: "GET",
            dataType: 'json',
            data: {
                provinsi_id: provinsi_id,
                kabupaten_id: kabupaten_id,
                kecamatan_id: kecamatan_id,  
            },
            success: function(res) {
                if(res){
                    $("#jasa_id").empty();
                    $("#jasa_id").append('<option> Pilih Jasa </option>');
                    $.each(res,function(nama_jasa,id){
                        $("#jasa_id").append('<option value="'+id+'">'+nama_jasa+'</option>');
                    });
                }else{
                   $("#jasa_id").empty();
                }
                  
            }
        });
    });

    $('#jasa_id').change(function(){
        if($(this).val() == '') reset()
       
        var jasa_id = $(this).val();
        console.log(jasa_id)
        if(jasa_id){
            $.ajax({
               type:"GET",
               url:"/getnamajasa?jasa_id="+jasa_id,
               dataType: 'JSON',
               success:function(res){               
                if(res){
                    $('[name="sub_harga"]').val(0)
                    $('[name="sub_harga"]').prop('readonly', false)
                    $('[name="jumlah_jasa"]').val(0)
                    $('[name="jumlah_jasa"]').prop('readonly', false)
                    $('button#Add').prop('disabled', false)
                    $.each(res,function(harga_jasa,nama_jasa){
                        $('[name="nama_jasa"]').val(nama_jasa);
                        $('[name="harga_jasa"]').val(harga_jasa);
                    });                               
                }else{
                    $('[name="nama_jasa"]').empty();
                    $('[name="harga_jasa"]').empty();
                }
               }
            });
        }else{
            $('[name="nama_jasa"]').empty();
            $('[name="harga_jasa"]').empty();
        }      
       });
    
});




