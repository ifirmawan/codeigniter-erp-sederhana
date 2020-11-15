/**
 * [description]
 * @param  {[type]} ) {                    if ($('#gl-table').length [description]
 * @return {[type]}   [description]
 * Required :
 * @package custom jvm apek
 * @author iwan firmawan<iwan.firmawan@jagokompter.com>
 * @required http://easyautocomplete.com
 * @required https://datatables.net
 */
$(document).ready(function () { 

	$(document).on('change', ':file', function() {
        var input   = $(this),
        numFiles    = input.get(0).files ? input.get(0).files.length : 1,
        label       = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [numFiles, label]);
        if (typeof input.get(0).files[0] !== "undefined" ) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log($('.img-responsive').length);
                $('.img-responsive').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.get(0).files[0]);
            $('.btn-file').after(label);
        }
        
    });
    
	$(document).on('click','.btn-confirm-link',function(){
        if(confirm('Anda sudah yakin? tindakan ini tidak dapat mengembalikan keadaan sebelumnya')){
            return true;
        }
        return false;
    });
    
    $('textarea[name="url_post"]').on('paste', function () {
        var element = this;
        setTimeout(function () {
            var text     = $(element).val();
            var pecah    = text.split('/');
            console.log(pecah);
            var base_url = pecah[2];
            $('input[name="alamat_website"]').val(base_url);
            
        }, 100);
    });

    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd'
    });
    
    
    if ($('#gl-table').length == 1) {
        $('#gl-table').DataTable();
        $('input[type="search"]').css('width','500px');
    }
    
    if ($('input[name="nominal_bersifat"]').length > 0) {
        $(document).on('click','input[name="nominal_bersifat"]',function(){
            if ($('input[name="nominal_parameter"]').length == 1) {
                var value = $(this).val();
                if (value == 'kondisional') {
                    $('input[name="nominal_parameter"]').prev().css('display','none');
                    $('input[name="nominal_parameter"]').css('display','none');
                }else{
                    $('input[name="nominal_parameter"]').prev().css('display','block');
                    $('input[name="nominal_parameter"]').css('display','block');
                }
            }
        });
    }
    

}); 

