/**
 * [description]
 * @param  {[type]} ) {            if ($('#gl-table').length [description]
 * @return {[type]}   [description]
 * Required :
 * @package custom jvm apek
 * @author iwan firmawan<iwan.firmawan@jagokompter.com>
 * @required http://easyautocomplete.com
 * @required https://datatables.net
 */
$(document).ready(function () { 

    $.ajaxSetup({
        headers: { 'X-API-KEY': 'W1th0utLo993d1n' }
    });

    $(document).on('change','select[name="modul"]',function(){
        $('#select-aksi').html('loading . . .');
        var site_url    = $('p.site_url').text();
        var controller  = $(this).val();
        $.ajax({
            url: site_url+'json/get_class_methods/'+controller,
            type:"GET",
            dataType:'json',
            success: function(data){
                var html ='<select name="aksi" class="form-control">';
                $.each(data,function(key,item){
                    //console.log(item);
                    html +='<option ="'+item+'">'+item+'</option>';
                });
                html +='</select>';
                $('#select-aksi').html(html);
            }
        });

    });
    
        
}); 

