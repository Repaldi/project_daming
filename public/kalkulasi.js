$('#provinsi').change(function(){
    var provinsi_id = $(this).val();   
    console.log(provinsi_id)
    if(provinsi_id){
        $.ajax({
           type:"GET",
           url:"/getkabupaten?provinsi_id="+provinsi_id,
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
           url:"/getkecamatan?kabupaten_id="+kabupaten_id,
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
           url:"/gettipebangunan?kecamatan_id="+kecamatan_id,
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

   $('#kecamatan').change(function(){
    var kecamatan_id = $(this).val();    
    if(kecamatan_id){
        $.ajax({
           type:"GET",
           url:"/getmaterial?kecamatan_id="+kecamatan_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $("#material").empty();
                $('[name="harga_material"]').empty();
                $('[name="satuan_material"]').empty();
                $("#material").append('<option>Pilih Material</option>');
                $.each(res,function(nama_material,id){
                    $("#material").append('<option value="'+id+'">'+nama_material+'</option>');
                });
            }else{
               $("#material").empty();
               $('[name="harga_material"]').empty();
               $('[name="satuan_material"]').empty();
            }
           }
        });
    }else{
      
        $("#material").empty();
        $('[name="harga_material"]').empty();
        $('[name="satuan_material"]').empty();
    }      
   });

   $('#material').change(function(){
    if($(this).val() == '') reset()
    var material_id = $(this).val();
        
    if(material_id){
        $.ajax({
           type:"GET",
           url:"/gethargamaterial?material_id="+material_id,
           dataType: 'JSON',
           success:function(res){               
            if(res){
                $('[name="sub_harga"]').val(0)
                $('[name="banyak_material"]').val(0)
                $('[name="banyak_material"]').prop('readonly', false)
                $('button#tambah').prop('disabled', false)
                $.each(res,function(harga_material,satuan_material){
                    $('[name="harga_material"]').val(harga_material);
                    $('[name="satuan_material"]').val(satuan_material);
                });                               
            }else{
                $('[name="harga_material"]').empty();
                $('[name="satuan_material"]').empty();
            }
           }
        });
    }else{
        $('[name="harga_material"]').empty();
        $('[name="satuan_material"]').empty();
    }      
   });

   $('#material').change(function(){
    if($(this).val() == '') reset()
    var material_id = $(this).val();
    if(material_id){
        $.ajax({
           type:"GET",
           url:"/getnamamaterial?material_id="+material_id,
           dataType: 'JSON',
           success:function(res){               
                $.each(res,function(nama_material){
                    $('[name="nama_material"]').val(nama_material);
                });                               
           }
        });
    }else{
        $('[name="nama_material"]').empty();
    }      
   });
  
   $(document).ready(function(){
   $("#banyak_material").on('keyup mouseup',function () {
    var qty = $(this).val();
    var harga_material =  document.getElementById("harga_material").value;
    var sub_harga = harga_material * qty;
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
       
        // const data_keranjang = {
        //     material_id: $('select[name="material_id"]').val(),
        //     harga_material: $('input[name="harga_material"]').val(),
        //     banyak_material: $('input[name="banyak_material"]').val(),
        //     satuan_material: $('input[name="satuan_material"]').val(),
        //     sub_harga: $('input[name="sub_harga"]').val(),
        // }

        var data_material_id = $('select[name="material_id"]').val();
        var data_nama_material = $('input[name="nama_material"]').val();
        var data_harga_material= $('input[name="harga_material"]').val();
        var data_banyak_material= $('input[name="banyak_material"]').val();
        var data_satuan_material= $('input[name="satuan_material"]').val();
        var data_sub_harga= $('input[name="sub_harga"]').val();
        var newRow = 
        '<tr class="row-keranjang"><td>'+ data_nama_material +'<input type="hidden" name="material_id_hidden[]" value='+data_material_id+'></td><td>'+data_harga_material+'<input type="hidden" name="harga_material_hidden[]" value='+data_harga_material+'></td><td>'+data_banyak_material+'<input type="hidden" class="bnyk_material" name="banyak_material_hidden[]" value='+data_banyak_material+'></td><td>'+data_satuan_material+'<input type="hidden" name="satuan_material_hidden[]" value='+data_satuan_material+'></td><td>'+data_sub_harga+' <input type="hidden" class="subharga" name="sub_harga_hidden[]" value='+data_sub_harga+'> </td><td><button type="button" class="btn btn-danger btn-sm" id="tombol-hapus" data-data_material_id='+data_material_id+'><i class="fa fa-trash"></i></button></td></tr>';
        if($('select[name="material_id"]').val() == data_material_id) $('option[value="' + data_material_id + '"]').hide()
        reset()
       
       

        $(newRow).appendTo($("table#keranjang tbody"));
        $('tfoot').show()
        $('input[name="kode_kalkulasi_hidden"]').val($('input[name="kode_kalkulasi"]').val())
        $('input[name="provinsi_id_hidden"]').val($('select[name="provinsi_id"]').val())
        $('input[name="kabupaten_id_hidden"]').val($('select[name="kabupaten_id"]').val())
        $('input[name="kecamatan_id_hidden"]').val($('select[name="kecamatan_id"]').val())
        $('input[name="tipe_bangunan_id_hidden"]').val($('select[name="tipe_bangunan_id"]').val())
        $('#total').html('<strong>' + hitung_total() + '</strong>')
        $('input[name="total_hidden"]').val(hitung_total())
        $('input[name="total_material_hidden"]').val(hitung_total_material())
       
       
          function hitung_total_material(){
				let total_material= 0;
				$('.bnyk_material').each(function(){
					total_material += parseInt($(this).val())
				})

				return 	total_material ;
			}
          function hitung_total(){
				let total = 0;
				$('.subharga').each(function(){
					total += parseInt($(this).val())
				})

				return total;
			}

        function reset(){
            $('select[name="material_id"]').val('Pilih Material')
            $('input[name="harga_material"]').val('')
            $('input[name="banyak_material"]').val('')
            $('input[name="satuan_material"]').val('')
            $('[name="sub_harga"]').val(0)
            $('[name="banyak_material"]').val(0)
            $('[name="banyak_material"]').prop('readonly', true)
            $('button#tambah').prop('disabled', true)
        }
    });


			$(document).on('click', '#tombol-hapus', function(){
				$(this).closest('.row-keranjang').remove()

				$('option[value="' + $(this).data('data_material_id') + '"]').show()

				if($('tbody').children().length == 0) $('tfoot').hide()
			})

          
        // {/* $.ajaxSetup({
        //     headers : {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // }); */}
        
      
    // $.ajax({
    //     url:"/keranjang",
    //     type: 'POST',
    //     data: data_keranjang,
    //     dataType: 'JSON',
    //     success:function(data){  
       
        // if($('select[name="material_id"]').val() == data_keranjang.material_id) $('option[value="' + data_keranjang.nama_material + '"]').hide()
        // reset()
        
//             $('table#keranjang tbody').append(data)
//             $('tfoot').show()
//             $('tbody').show()

//             $('#total').html('<strong>' + hitung_total() + '</strong>')
//             $('input[name="total_hidden"]').val(hitung_total())
//          }
//     })
				
//     });
//    });


//    $(document).ready(function(){
//     $("#addRow").click(function () {
//         var kecamatan_id = document.getElementById("kecamatan").value;
//         // console.log(kecamatan_id);
//         if(kecamatan_id){
//         $.ajax({
//             type:"GET",
//             url:"getmaterial?kecamatan_id="+kecamatan_id,
//             dataType: 'JSON',
//             success:function(res){               
//              if(res){
//                 var html = '';
//                 html += '<div id="inputFormRow">';
//                 html += '<div class="row">';
//                 html += '<div class="col-lg-10">';
//                 html += '<label class="form-control-label" for="input-material">Pilih Material</label>';
//                 html += '<select class="form-control data-material" name="material_id[]" >';
//                 html += '<option selected>Pilih Material</option>';
//                 html += '</select>';
//                 html += '</div>';
//                 html += '<div class="col-lg-2">';
//                 html += '<label class="form-control-label" for="input-material">Qty</label>';
//                 html += '<input type="number"  class="form-control" name="banyak_material[]" >';
//                 html += '</div>';
//                 html += '<div class="input-group-append">';
//                 html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
//                 html += '</div>';    
//                 html += '</div>';   
//                 $('#newRow').append(html); //Add field html
//                 $.each(res,function(nama_material,id){
//                     $(".data-material").append('<option value="'+id+'">'+nama_material+'</option>');
//                 });
    
//                 // remove row
//                 $(document).on('click', '#removeRow', function () {
//                     $(this).closest('#inputFormRow').remove();
//                 });
//                 }else{
//                     $(".data-material").empty();
//                  }
//                 }
//              });
//         }else{
//          $(".data-material").empty();
//         }      
//     });
        
});