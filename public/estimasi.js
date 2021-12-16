$('#provinsi').change(function(){
    var provinsi_id = $(this).val();   
    if(provinsi_id){
        $.ajax({
           type:"GET",
           url:"/getkabupaten?provinsi_id="+provinsi_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#kabupaten").empty();
                $("#kecamatan").empty();
                $("#jasa").empty();
                $("#kabupaten").append('<option>Pilih Kabupaten</option>');
                $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                $("#jasa").append('<option>Pilih Jasa</option>');
                $.each(res,function(nama_kabupaten, id){
                    $("#kabupaten").append('<option value="'+id+'">'+nama_kabupaten+'</option>');
                });
            }else{
               $("#kabupaten").empty();
               $("#kecamatan").empty();
               $("#jasa").empty();
            }
           }
        });
    }else{
        $("#kabupaten").empty();
        $("#kecamatan").empty();
        $("#jasa").empty();
    }      
   });

   $('#kabupaten').change(function(){
    var kabupaten_id = $(this).val();    
    if(kabupaten_id){
        $.ajax({
           type:"GET",
           url:"/getkecamatan?kabupaten_id="+kabupaten_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#kecamatan").empty();
                $("#jasa").empty();
                $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                $("#jasa").append('<option> Pilih Jasa</option>');
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
           url:"/getjasa?kecamatan_id="+kecamatan_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#jasa").empty();
                $("#jasa").append('<option>Pilih Jasa</option>');
                $.each(res,function(nama_jasa,id){
                    $("#jasa").append('<option value="'+id+'">'+nama_jasa+'</option>');
                });
            }else{
               $("#jasa").empty();
            }
           }
        });
    }else{
        $("#jasa").empty();
    }      
   });

   $('#jasa').change(function(){
    if($(this).val() == '') reset()
   
    var jasa_id = $(this).val();
    if(jasa_id){
        $.ajax({
           type:"GET",
           url:"/getdatajasa?jasa_id="+jasa_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $('[name="sub_harga"]').val(0)
                $('[name="jumlah_jasa"]').val(0)
                $('[name="jumlah_jasa"]').prop('readonly', false)
                $('button#tambah').prop('disabled', false)
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

   $(document).ready(function(){
    $("#jumlah_jasa").on('keyup mouseup',function () {
     var jumlah_jasa = $(this).val();
     var harga_jasa =  document.getElementById("harga_jasa").value;
     var sub_harga = harga_jasa * jumlah_jasa;
     $('[name="sub_harga"]').val(sub_harga);
 
     });
    });

    $(document).ready(function(){
        $('tfoot').hide()
        $(document).keypress(function(event){
            if (event.which == '13') {
                  event.preventDefault();
               }
        })
    
        $(document).on('click', '#tambah', function(e){
    
            var data_waktu_pengerjaan = $('select[name="waktu_pengerjaan"]').val();
            var data_jasa_id = $('select[name="jasa_id"]').val();
            var data_nama_jasa = $('input[name="nama_jasa"]').val();
            var data_harga_jasa= $('input[name="harga_jasa"]').val();
            var data_jumlah_jasa= $('input[name="jumlah_jasa"]').val();
            var data_sub_harga= $('input[name="sub_harga"]').val();
            var newRow = 
            '<tr class="row-keranjang"><td>'+ data_nama_jasa +'<input type="hidden" name="jasa_id_hidden[]" value='+data_jasa_id+'></td><td>'+data_harga_jasa+'<input type="hidden" name="harga_jasa_hidden[]" value='+data_harga_jasa+'></td><td>'+data_jumlah_jasa+'<input type="hidden" class="bnyk_jasa" name="jumlah_jasa_hidden[]" value='+data_jumlah_jasa+'></td><td>'+data_sub_harga+' <input type="hidden" class="subharga" name="sub_harga_hidden[]" value='+data_sub_harga+'> </td><td><button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-data_jasa_id='+data_jasa_id+'><i class="fa fa-trash"></i></button></td></tr>';
            if($('select[name="jasa_id"]').val() == data_jasa_id) $('option[value="' + data_jasa_id + '"]').hide()
            reset()
           
           
    
            $(newRow).appendTo($("table#keranjang tbody"));
            $('tfoot').show()
            $('input[name="waktu_pengerjaan_hidden"]').val($('select[name="waktu_pengerjaan"]').val())
            $('input[name="provinsi_id_hidden"]').val($('select[name="provinsi_id"]').val())
            $('input[name="kabupaten_id_hidden"]').val($('select[name="kabupaten_id"]').val())
            $('input[name="kecamatan_id_hidden"]').val($('select[name="kecamatan_id"]').val())
            $('#waktu').html('<strong> <center>' + data_waktu_pengerjaan + ' Minggu </center></strong>')
            $('#total').html('<strong>' + hitung_total() + '</strong>')
            $('input[name="total_hidden"]').val(hitung_total())
            $('input[name="total_jasa_hidden"]').val(hitung_total_jasa())
           
           
              function hitung_total_jasa(){
                    let total_jasa= 0;
                    $('.bnyk_jasa').each(function(){
                        total_jasa += parseInt($(this).val())
                    })
    
                    return 	total_jasa ;
                }
              function hitung_total(){
                    let total = 0;
                    $('.subharga').each(function(){
                        total += parseInt($(this).val())
                    })
    
                    return total;
                }
    
            function reset(){
                $('select[name="provinsi_id"]').attr("disabled", true);
                $('select[name="kabupaten_id"]').attr("disabled", true);
                $('select[name="kecamatan_id"]').attr("disabled", true);
                $('select[name="waktu_pengerjaan"]').attr("disabled", true);
                $('select[name="jasa_id"]').val('Pilih Jasa')
                $('input[name="harga_jasa"]').val('')
                $('input[name="jumlah_jasa"]').val('')
                $('[name="sub_harga"]').val(0)
                $('[name="jumlah_jasa"]').val(0)
                $('[name="jumlah_jasa"]').prop('readonly', true)
                $('button#tambah').prop('disabled', true)
            }
        });
    });
    
    $(document).on('click', '#tombol-hapus', function(){
        $(this).closest('.row-keranjang').remove()

        $('option[value="' + $(this).data('data_jasa_id') + '"]').show()

        if($('tbody').children().length == 0) $('tfoot').hide() 
        $('select[name="provinsi_id"]').attr("disabled", false);
        $('select[name="kabupaten_id"]').attr("disabled", false);
        $('select[name="kecamatan_id"]').attr("disabled", false);
        $('select[name="waktu_pengerjaan"]').attr("disabled", false);
    })

    
    
    
    
    