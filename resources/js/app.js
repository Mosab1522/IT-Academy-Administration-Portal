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

function debounce(fn, delay) {
    let timer = null;
    return function () {
        let context = this;
        let args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function () {
            fn.apply(context, args);
        }, delay);
    };
}

function searchStudents() {
    let name = document.querySelector('input[name="name"]').value;
    let lastname = document.querySelector('input[name="lastname"]').value;
    let email = document.querySelector('input[name="email"]').value;
    let searchResults = document.getElementById('search-results');

    axios.get('/search-students', {
        params: {
            name: name,
            lastname: lastname,
            email: email
        }
    }).then(response => {
        searchResults.innerHTML = '';
        let students = response.data;
        students.forEach(student => {
            let option = document.createElement('tr');
            option.innerHTML =  '<td px-6 py-4 whitespace-nowrap>' + student.name + '</td><td  px-6 py-4 whitespace-nowrap>' + student.lastname + '</td> <td  px-6 py-4 whitespace-nowrap>' + student.email + '</td></tr>';
            option.addEventListener('click', function () {
                document.querySelector('input[name="name"]').value = student.name;
                document.querySelector('input[name="lastname"]').value = student.lastname;
                document.querySelector('input[name="email"]').value = student.email;
                searchResults.innerHTML = '';
            });
            searchResults.appendChild(option);
        });
    }).catch(error => {
        console.error(error);
    });
}

document.querySelector('input[name="name"]').addEventListener('input', debounce(searchStudents, 100));
document.querySelector('input[name="lastname"]').addEventListener('input', debounce(searchStudents, 100));
document.querySelector('input[name="email"]').addEventListener('input', debounce(searchStudents, 100));



