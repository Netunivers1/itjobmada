jQuery(function(){
    jQuery('.rubrique_list_value').addClass("table100 ver5 m-b-110");
    jQuery('.rubrique_list_value thead tr').addClass("row100 head");

    jQuery('.rubrique_list_value tbody tr').addClass("row100");

    jQuery('span[class*="ti-settings"]').click(function(){
        jQuery(this).find('#ti-close-menu').toggle();
    });
});
