$('#kabupaten').change(function(){
    var kabID = $(this).val();    
    if(kabID){
        $.ajax({
           type: "GET",
           url: "/getkecamatan",
           data: { kabID: kabID },
           dataType: 'JSON',
           success: function(res){               
            if(res){
                $("#kecamatan").empty();
                $("#desa").empty();
                $("#kecamatan").append('<option value="">--Pilih Kecamatan--</option>');
                $("#desa").append('<option value="">--Pilih Desa--</option>');
                $.each(res,function(index, kecamatan){
                    $("#kecamatan").append('<option value="'+kecamatan+'">'+kecamatan+'</option>');
                });
            } else {
               $("#kecamatan").empty();
               $("#desa").empty();
            }
           }
        });
    } else {
        $("#kecamatan").empty();
        $("#desa").empty();
    }      
});

$('#kecamatan').change(function(){
    var kecID = $(this).val();    
    if(kecID){
        $.ajax({
           type: "GET",
           url: "/getdesa",
           data: { kecID: kecID },
           dataType: 'JSON',
           success: function(res){               
            if(res){
                $("#desa").empty();
                $("#desa").append('<option value="">--Pilih Desa--</option>');
                $.each(res,function(_index, desa){
                    $("#desa").append('<option value="'+desa+'">'+desa+'</option>');
                });
            } else {
               $("#desa").empty();
            }
           }
        });
    } else {
        $("#desa").empty();
    }      
});
