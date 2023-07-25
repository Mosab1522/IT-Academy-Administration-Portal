import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// $(document).ready(function() {
//     // Nastaviť default hodnoty pre selecty
    
//     if (!oldInput['coursetype_id']) {
//          setSubOptions('Rock');
//       }
         
// });
// const academySelect = document.querySelector("#genre");
// const coursetypeSelect = document.querySelector("#subgenre");
// const subOptions = coursetypeSelect.querySelectorAll("option");

// const setSubOptions = (newValue) => {
//     coursetypeSelect.innerText = null;
//     for (let i = 0; i < subOptions.length; i++) {
//         if (subOptions[i].dataset.option === newValue) {
//             coursetypeSelect.appendChild(subOptions[i].cloneNode(true));
//         }
//     }
// };

// // pridaj udalost 'change' na academySelect
// academySelect.addEventListener('change', (event) => {
//     const newValue = event.target.value;
//     console.log(newValue);
//     setSubOptions(newValue);
// });

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



const selectsContainer = document.querySelector('#selects-container');
const addSelectsBtn = document.querySelector('#add-selects-btn');

let pairsCount = 1;

function addSelectsPair() {
    const pairWrapper = document.createElement('div');
    pairWrapper.classList.add('selects-pair');
    pairWrapper.dataset.pairId = ++pairsCount;

    const academySelect = document.createElement('select');
    academySelect.name = 'academy_id[]';
    academySelect.classList.add('academy-select');
    academySelect.dataset.pairId = pairsCount;
    // academySelect.addEventListener('change', select);


    const firstAcademySelect = selectsContainer.querySelector('.academy-select');
    if (firstAcademySelect) {
        academySelect.innerHTML = firstAcademySelect.innerHTML;
        academySelect.value = "";
        // firstAcademySelect.addEventListener('change', select);
    }

    const coursetypeSelect = document.createElement('select');
    coursetypeSelect.name = 'coursetypes_id[]';
    coursetypeSelect.classList.add('coursetype-select');
    coursetypeSelect.dataset.pairId = pairsCount;

    const firstCoursetypeSelect = selectsContainer.querySelector('.coursetype-select');
    if (firstCoursetypeSelect) {
        coursetypeSelect.innerHTML = '<option value="">Typ kurzu</option>';
        coursetypeSelect.value = "";
    }
    const removeBtn = document.createElement('button');
    removeBtn.classList.add('remove-selects-btn');
    removeBtn.setAttribute('type', 'button');
    removeBtn.textContent = 'Remove';
    removeBtn.setAttribute('data-pair-id', pairsCount);
    removeBtn.addEventListener('click', removeSelectPair);

    pairWrapper.appendChild(academySelect);
    pairWrapper.appendChild(coursetypeSelect);
    pairWrapper.appendChild(removeBtn);
    selectsContainer.appendChild(pairWrapper);
}




function removeSelectPair(event) {
    const pairId = event.target.getAttribute('data-pair-id');
    const selectPair = document.querySelector(`.selects-pair[data-pair-id="${pairId}"]`);
    selectPair.remove();
}

addSelectsBtn.addEventListener('click', addSelectsPair);
selectsContainer.addEventListener('change', event => {
    const target = event.target;
    if (target.classList.contains('academy-select')) {
        const coursetypeSelect = target.parentNode.querySelector('.coursetype-select');
        if (coursetypeSelect) {
            const academyId = target.value;
            // Repopulate coursetype options based on selected academy
        }
    }
});

// function select(event) {
//     const pairId = event.target.getAttribute('data-pair-id');
  
//     const academy = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
//     const coursetype =  document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
  
//     const setValue = (newValue) => {
//       coursetype.innerText = null;
//       const subOptions = coursetype.querySelectorAll("option"); // moved inside the function
//       for (let i = 0; i < subOptions.length; i++) {
//         subOptions[i].dataset.option === newValue &&
//         coursetype.appendChild(subOptions[i]);
//       }
//     };
  
//     setValue(academy.value);
//   }
  
//   const selectsContainers = document.querySelectorAll('.selects-pair');
//   selectsContainers.forEach(container => {
//     container.addEventListener('change', select);
//   });

// selectsContainer.addEventListener('change', function(event) {
//     const target = event.target;
//     if (target && target.matches('.academy-select')) {
//       const pairId = target.closest('.selects-pair').getAttribute('data-pair-id');
//       const academyValue = target.value;
//       const coursetype = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
//       const subOptions = coursetype.querySelectorAll('option');
  
//       coursetype.innerText = null;
//       for (let i = 0; i < subOptions.length; i++) {
//         if (subOptions[i].dataset.option === academyValue) {
//           coursetype.appendChild(subOptions[i].cloneNode(true));
//         }
//       }
//     }
//   });

// function select(event){
// const pairId = event.target.getAttribute('data-pair-id');

// // const academy = document.querySelector("#academy");
// const academy = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
// // const coursetype = document.querySelector("#coursetype");
// const coursetype =  document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
// const subOptions = coursetype.querySelectorAll("option");

// const setValue = (newValue) => {
//     coursetype.innerText = null;
//     for (let i = 0; i < subOptions.length; i++)
//         subOptions[i].dataset.option === newValue &&
//         coursetype.appendChild(subOptions[i]);
// };

// // academy.addEventListener('change', function() {
// //     setValue(academy.value);
// //   });

// return setValue(academy.value);

// }

// $('#selects-container').on('change', '.academy-select', function (event) {
//         const pairId = event.target.getAttribute('data-pair-id');
//         const academySelect = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
//         const coursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
//         // const coursetypeOptions = coursetypeSelect.querySelectorAll("option");
        
//         console.log(coursetypeSelect);
//         const setValue = function (newValue) {
//             coursetypeSelect.innerHTML = null;
//             for (let i = 0; i < coursetypeOptions.length; i++) {
//                 coursetypeOptions[i].dataset.option === newValue && coursetypeSelect.appendChild(coursetypeOptions[i]);
//             }
//         };

//          setValue(academySelect.value);
//     });
const coursetype = document.querySelector("#coursetype");
const coursetypeOptions = coursetype.querySelectorAll("option");

$(document).ready(function() {
    // Nastaviť default hodnoty pre selecty
   
    const academySelects = document.querySelectorAll('.academy-select');
    academySelects.forEach(function(select) {
      select.value = '';
    });
    const coursetypeSelects = document.querySelectorAll('.coursetype-select');
    coursetypeSelects.forEach(function(select) {
      select.innerHTML = '<option value="">Typ kurzu</option>';
    });

    const academies = document.querySelectorAll('.academy-select');
    academies.forEach(function(academySelect) {
      const pairId = academySelect.getAttribute('data-pair-id');
      const coursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);
      const coursetypeOptions = coursetypeSelect.querySelectorAll("option");
  
      const setValue = function (newValue) {
        coursetypeSelect.innerHTML = '<option value="">Typ kurzu</option>';
        for (let i = 0; i < coursetypeOptions.length; i++) {
          if (coursetypeOptions[i].dataset.option === newValue) {
            coursetypeSelect.appendChild(coursetypeOptions[i].cloneNode(true));
          }
        }
      };
      setValue(academySelect.value);
    });
     
  
    // Vypočítať zodpovedajúce typy kurzov pre default hodnoty

  });
//   const coursetype = document.querySelector("#coursetype");
// const coursetypeOptions = coursetype.querySelectorAll("option");

$('#selects-container').on('change', '.academy-select', function (event) {
    const pairId = event.target.getAttribute('data-pair-id');
    const academySelect = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
    const coursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);

    const setValue = function (newValue) {
        coursetypeSelect.innerHTML = null;
        for (let i = 0; i < coursetypeOptions.length; i++) {
            if (coursetypeOptions[i].dataset.option === newValue) {
                coursetypeSelect.appendChild(coursetypeOptions[i].cloneNode(true));
            }
        }
    };
  
    setValue(academySelect.value);
    const allAcademySelects = document.querySelectorAll('.academy-select');
    for (let i = 0; i < allAcademySelects.length; i++) {
        const otherPairId = allAcademySelects[i].getAttribute('data-pair-id');
        if (otherPairId !== pairId && allAcademySelects[i].value === academySelect.value) {
            const otherCoursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${otherPairId}"]`);
            if (academySelect.value === otherAcademySelect.value) {
                // akadémie sú zhodné, tak nezmeniť prvý select
                continue;
            }
            otherCoursetypeSelect.innerHTML = null;
            for (let j = 0; j < coursetypeOptions.length; j++) {
                if (coursetypeOptions[j].dataset.option === academySelect.value) {
                    otherCoursetypeSelect.appendChild(coursetypeOptions[j].cloneNode(true));
                }
            }
        }
    }
});




