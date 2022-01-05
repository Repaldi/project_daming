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
    $('#btnResetEstimasiWaktu').hide()
    $('#download-rincian').hide()
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
            url: "/search-data-waktu-pengerjaan",
            type: "GET",
            dataType: 'json',
            data: {
                provinsi_id: provinsi_id,
                kabupaten_id: kabupaten_id,
                kecamatan_id: kecamatan_id,  
            },
            success: function(res) {
                if(res){
                    $("#estimasi_waktu_id").empty();
                    $("#estimasi_waktu_id").append('<option> Pilih Waktu Pengerjaan  </option>');
                    $.each(res,function(waktu_pengerjaan,id){
                        $("#estimasi_waktu_id").append('<option value="'+id+'">'+waktu_pengerjaan+ ' Minggu </option>');
                    });
                }else{
                   $("#estimasi_waktu_id").empty();
                }
                  
            }
        });
    });

    $('#estimasi_waktu_id').change(function(){
        $('tfoot').hide()
        $('#btnResetEstimasiWaktu').hide()
        $('#download-rincian').hide()
        if($(this).val() == '') reset()
        var estimasi_waktu_id = $(this).val();
        if(estimasi_waktu_id){
            $.ajax({
               type:"GET",
               url:"/getestimasiwaktuuser?estimasi_waktu_id="+estimasi_waktu_id,
               dataType: 'JSON',
               success:function(res){               
                if(res){
               console.log(res.estimasi_waktu[0])
               var detail_estimasi_waktu = res.detail_estimasi_waktu
               console.log(detail_estimasi_waktu)
              
                    $.each(detail_estimasi_waktu,function(i){
                    var newRow = 
                    '<tr class="row-keranjang"><td>'+ detail_estimasi_waktu[i].nama_jasa +'<input type="hidden" name="jasa_id_hidden[]" value='+ detail_estimasi_waktu[i].jasa_id +'></td><td>'+ detail_estimasi_waktu[i].harga_jasa +'<input type="hidden" name="harga_jasa_hidden[]" value='+detail_estimasi_waktu[i].harga_jasa+'></td><td>'+detail_estimasi_waktu[i].jumlah_jasa+'<input type="hidden" class="bnyk_jasa" name="jumlah_jasa_hidden[]" value='+detail_estimasi_waktu[i].jumlah_jasa+'></td><td>'+detail_estimasi_waktu[i].sub_harga_jasa+' <input type="hidden" class="subharga" name="sub_harga_hidden[]" value='+detail_estimasi_waktu[i].sub_harga_jasa+'> </td><td><button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-data_jasa_id='+detail_estimasi_waktu[i].jasa_id+'><i class="fa fa-trash"></i></button></td></tr>';

                    $(newRow).appendTo($("table#keranjang tbody"));
               
                    });   
                    $('tfoot').show()
                    $('#btnResetEstimasiWaktu').show()
                    $('#download-rincian').show()
                    $('select[name="estimasi_waktu_id"]').attr("disabled", true);
                    // $.each(detail_estimasi_waktu,function(i){
                    // var newDiv =
                    // '<div class="col-lg-4 inputForm" ><div class="form-group"><label class="form-control-label" for="input-jasa">Nama Jasa</label><input type="text" class="form-control" id="jasa" name="jasa_id" value="'+ detail_estimasi_waktu[i].nama_jasa +'" readonly></div></div><div class="col-lg-3 inputForm"><div class="form-group"><label class="form-control-label" for="input-harga-jasa">Harga</label><input type="text" class="form-control"  name="harga_jasa" id="harga_jasa" value="'+ detail_estimasi_waktu[i].harga_jasa +'" readonly></div></div><div class="col-lg-2 inputForm"><div class="form-group"><label class="form-control-label" for="input-jumlah">Jumlah</label> <input type="number" class="form-control" name="jumlah_jasa"  id="jumlah_jasa" value="'+ detail_estimasi_waktu[i].jumlah_jasa +'" ></div></div><div class="col-lg-3 inputForm"><div class="form-group"><label class="form-control-label" for="input-sub-harga">Sub Harga</label><input type="text" class="form-control" name="sub_harga" id="sub_harga" value="'+ detail_estimasi_waktu[i].sub_harga_jasa +'" readonly></div></div>'; 
                    // $(newDiv).appendTo($("#data-detail"));   
                    // });   
                    
                    // $('#btnResetEstimasiWaktu').show()
                    // $('select[name="estimasi_waktu_id"]').attr("disabled", true);

                }else{
                  
                }
               }
            });
        }else{

        }      
       });

       $(document).on('click', '#btnResetEstimasiWaktu', function(){
            $('tbody').children().empty();
            $('#btnResetEstimasiWaktu').hide()
            $('#download-rincian').hide()
            $('select[name="estimasi_waktu_id"]').attr("disabled",false);
    })

    $(document).on('click', '#tombol-hapus', function(){
        $(this).closest('.row-keranjang').remove();

        if($('tbody').children().length == 0) $('tfoot').hide() && $('select[name="estimasi_waktu_id"]').attr("disabled",false);

       
    })

    //    $(document).ready(function(){
    //     $("#jumlah_jasa").on('keyup mouseup',function () {
    //      var jumlah_jasa = $(this).val();
    //      var harga_jasa =  document.getElementById("harga_jasa").value;
    //      var sub_harga = harga_jasa * jumlah_jasa;
    //      $('[name="sub_harga"]').val(sub_harga);
     
    //      });
    // });
    
});

$(document).on('click', '#download-rincian', function(e){
   
    var provinsi_id = document.getElementById("provinsi").value;
    var kabupaten_id = document.getElementById("kabupaten").value;
    var kecamatan_id = document.getElementById("kecamatan").value;
    var tipebangunan_id = document.getElementById("tipebangunan").value;
   
    $.ajax({
        url: "/download-rincian",
        type: "GET",
        dataType: 'json',
        data: {
            provinsi_id: provinsi_id,
            kabupaten_id: kabupaten_id,
            kecamatan_id: kecamatan_id,
            tipebangunan_id: tipebangunan_id    
        },
    });
    
});