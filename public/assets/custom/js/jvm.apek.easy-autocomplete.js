$(document).ready(function () { 

    var url_dept        = $('p.url-dept').text();
    var url_jobt        = $('p.url-jobt').text();
    var url_jobp        = $('p.url-jobp').text();
    var url_emp_names   = $('p.url-emp-names').text();
    var url_prov        = $('p.url-prov').text();
    var url_city        = $('p.url-city').text();
    var url_distic      = $('p.url-distric').text();
    var url_vill        = $('p.url-vill').text();

    var id_dept     ='';
    if ($('input[name="id_departement"]').length == 1) {
        $('input[name="id_departement"]').on("change paste keyup", function() {
            id_dept = $(this).val();
            url_jobt +=id_dept;
        });
        // $('input[name="id_departement"]').val();
        //
    }

    //console.log(url_jobt);

    //auto complete for fungsional 
    set_input_autocomplete(url_dept,'input[name="job_departement"]','name','id_departement','input[name="id_departement"]');

    set_input_autocomplete(url_jobt,'input[name="job_title"]','name','id','input[name="id_group"]');

    set_autocomplete_tpl(url_emp_names,'input[name="nama_pegawai"]','nama_depan','kontak_email','id_pegawai','input[name="id_pegawai"]');

    set_autocomplete_tpl(url_emp_names,'input[name="direktur_instansi"]','nama_depan','kontak_email','id_pegawai','input[name="id_direktur"]');
    

    set_basic_autocomplete('input[name="desa"]',url_vill);
    
    set_basic_autocomplete('input[name="kecamatan"]',url_distic);
    
    set_basic_autocomplete('input[name="kota_kabupaten"]',url_city);

    set_basic_autocomplete('input[name="provinsi"]',url_prov);

    set_basic_autocomplete('input[name="kriteria"]',url_jobp);
    
}); 
function set_input_autocomplete(action_url,selector,field,primary_key,selector_handler) {
    var options = {

    url: function(phrase) {
      return action_url;
    },
    getValue: function(element) {
        return element[field];
    },
    template: {
        fields: {
            description: field
        }
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
            dataType: "json"
        }
    },  
    preparePostData: function(data) {
        data['X-API-KEY'] = 'W1th0utLo993d1n';
        return data;
    },
    requestDelay: 400,
    list: {
        match: {
            enabled: true
        },
        onSelectItemEvent: function() {
            var data = $(selector).getSelectedItemData();
            var id  = data[primary_key];
            if ($(selector_handler).length == 1) {
                $(selector_handler).val(id).trigger("change");
            }
        }
    },
    theme: "square"
    };

    if ($(selector).length == 1) {
        $(selector).easyAutocomplete(options); 
    } 
}

function set_autocomplete_tpl(action_url,selector,field,field_tpl,primary_key,selector_handler) {
    var options = {

    url: function(phrase) {
      return action_url;
    },
    getValue: function(element) {
        return element[field];
    },
    template: {
        type: "description",
        fields: {
            description: field_tpl
        }
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
            dataType: "json"
        }
    },  
    preparePostData: function(data) {
        data['X-API-KEY'] = 'W1th0utLo993d1n';
        return data;
    },
    requestDelay: 400,
    list: {
        match: {
            enabled: true
        },
        onSelectItemEvent: function() {
            var data = $(selector).getSelectedItemData();
            var id  = data[primary_key];
            if ($(selector_handler).length == 1) {
                $(selector_handler).val(id).trigger("change");
            }
        }
    },
    theme: "square"
    };

    if ($(selector).length == 1) {
        $(selector).easyAutocomplete(options); 
    } 
}

function set_basic_autocomplete(selector,source_url){
    var options = {
        url: function(phrase) {
            return source_url;
        },
        ajaxSettings: {
            dataType: "json",
            method: "POST",
            data: {
                dataType: "json"
            }
        },  
        preparePostData: function(data) {
            data['X-API-KEY'] = 'W1th0utLo993d1n';
            return data;
        },
        list: {
            match: {
                enabled: true
            }
        },
        theme: "square"
    };

    
    if ($(selector).length == 1) {
        $(selector).easyAutocomplete(options);
    }
}
