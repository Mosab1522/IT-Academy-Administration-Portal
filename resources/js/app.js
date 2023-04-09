import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

function jq_ChainCombo(el) {
    var selected = $(el).find(':selected').data('id');
    var next_combo = $(el).data('nextcombo');

    if(!$(next_combo).data('store')) {
        $(next_combo).data('store', $(next_combo).find('option'));
    }

    var options2 = $(next_combo).data('store');
    $(next_combo).empty().append(
        options2.filter(function(){
            return $(this).data('option') === selected;
        })
    );
    $(next_combo).prop('disabled', false);

    // get default value
    var defaultValue = $(next_combo).data('default');
    if (defaultValue) {
        $(next_combo).val(defaultValue); // set default value as selected
    }

    if($(next_combo).data('nextcombo') !== undefined ) {
        jq_ChainCombo(next_combo);
    }
}



// quick little jquery plugin to apply jq_ChainCombo to all selects with a data-nextcombo on them
jQuery.fn.chainCombo = function() {
// find all divs with a data-nextcombo attribute
$('[data-nextcombo]').each(function(i, obj) {
    $(this).change(function (){
        jq_ChainCombo(this);
    });
});
}();
