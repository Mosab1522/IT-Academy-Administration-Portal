import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();



function swith() {
  document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("novy");
    const registerForm = document.getElementById("stary");
    const switchFormLink = document.getElementById("switch-form");
    const switchFormLink2 = document.getElementById("switch-form2");

    switchFormLink.addEventListener("click", function (event) {
      event.preventDefault();

      loginForm.style.display = "block";
      registerForm.style.display = "none";
      switchFormLink.style.color = "rgb(59, 130, 246)";
      switchFormLink2.style.color = "rgb(55 65 81)";

    });
    switchFormLink2.addEventListener("click", function (event) {
      event.preventDefault();


      loginForm.style.display = "none";
      registerForm.style.display = "block";
      switchFormLink2.style.color = "rgb(59, 130, 246)";
      switchFormLink.style.color = "rgb(55 65 81)";
    });
  });
};



swith();
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
function povol() {
  const inputs = document.querySelectorAll('#formm input:not([type="hidden"])');
  const inputs2 = document.querySelectorAll('#formm2 input:not([type="hidden"])');
  const text1 = document.getElementById('jj');
  const text2 = document.getElementById('zz');
  const button = document.getElementById('upd');
  const button2 = document.getElementById('res');
  const button1 = document.getElementById('upd1');
  const button21 = document.getElementById('res1');
  const form = document.getElementById('formm');
  const form2 = document.getElementById('formm2');
  const kur = document.getElementById('kurzy');
  const login = document.getElementById('login');
  const pridat = document.getElementById('pridat');
  const kk = document.getElementById('kk');
  const nkk = document.getElementById('nkk');
  // var studentId = $('#kk').data('student-id');
  // var redirectUrl = $('#kk').data('href');
  // var redirectUrl = "{{ route('applications', ['student_id' => ':studentId']) }}".replace(':studentId', studentId);
  // Získání všech inputů typu text
  const povool = document.querySelector('#pp');
// povool.addEventListener('click', povol);
 if(povool){
  povool.addEventListener('click', () => {
  if (inputs[0].disabled == true && profile.style.display != 'none') {
    inputs.forEach(function (input) {
      input.disabled = false;
    });
    text1.style.display = 'none';
    text2.style.display = 'block';
    button.style.display = 'block';
    button2.style.display = 'block';
  }
  else if (inputs[0].disabled == false && profile.style.display != 'none') {
    inputs.forEach(function (input) {
      input.disabled = true;
    });
    text2.style.display = 'none';
    text1.style.display = 'block';
    button.style.display = 'none';
    button2.style.display = 'none';
    form.reset();
  }
  else if (kur.style.display != 'none' && pridat.style.display != 'block') {
    pridat.style.display = 'block';
    nkk.style.display = 'block';
    kk.style.display = 'none';
    // Presmerovanie na URL
    // window.location.href = redirectUrl;
    // window.location = "/admin/instructors";
  }
  else if (kur.style.display != 'none' && pridat.style.display != 'none') {
    pridat.style.display = 'none';
    nkk.style.display = 'none';
    kk.style.display = 'block';
    // Presmerovanie na URL
    // window.location.href = redirectUrl;
    // window.location = "/admin/instructors";
  }
  else if (inputs2[0].disabled == true && login.style.display != 'none') {
    inputs2.forEach(function (input) {
      input.disabled = false;
    });
    text1.style.display = 'none';
    text2.style.display = 'block';
    button1.style.display = 'block';
    button21.style.display = 'block';
  }
  else if (inputs2[0].disabled == false && login.style.display != 'none') {
    inputs2.forEach(function (input) {
      input.disabled = true;
    });
    text2.style.display = 'none';
    text1.style.display = 'block';
    button1.style.display = 'none';
    button21.style.display = 'none';
    form2.reset();
  }
});
 }
  // Odstranění atributu disabled

}
povol();
// const povool = document.querySelector('#pp');
// povool.addEventListener('click', povol);

function kurzy() {
  const inputs = document.querySelectorAll('#formm input:not([type="hidden"])');
  const inputs2 = document.querySelectorAll('#formm2 input:not([type="hidden"])');
  const text1 = document.getElementById('jj');
  const text2 = document.getElementById('zz');
  // const button = document.getElementById('upd');
  // const button2 = dokurzyycument.getElementById('res');
  const form = document.getElementById('formm');
  const form2 = document.getElementById('formm2');
  const kur = document.getElementById('kurzy');
  const login = document.getElementById('login');
  const kk = document.getElementById('kk');
  const tlac1 = document.getElementById('tlac1');
  const tlac2 = document.getElementById('tlac2');
  const profile = document.getElementById('profile');
  const button = document.getElementById('upd');
  const button2 = document.getElementById('res');
  const button1 = document.getElementById('upd1');
  const button21 = document.getElementById('res1');
  const lt = document.getElementById('lt');
  const kt = document.getElementById('kt');
  const pridat = document.getElementById('pridat');
  const nkk = document.getElementById('nkk');

  // Získání všech inputů typu text
  const kurzyy = document.querySelector('#ku');
  // kurzyy.addEventListener('click', kurzy);
  if(kurzyy){
  kurzyy.addEventListener('click', () => {
  if (inputs[0].disabled == true && profile.style.display != 'none') {
    text2.style.display = 'none';
    text1.style.display = 'none';
    profile.style.display = 'none';
    kur.style.display = 'block';
    kk.style.display = 'block';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button.style.display = 'none';
    button2.style.display = 'none';
   
  }
  else if (inputs[0].disabled == false && profile.style.display != 'none') {
    inputs.forEach(function (input) {
      input.disabled = true;
    });
    text2.style.display = 'none';
    text1.style.display = 'none';
    form.reset();
    profile.style.display = 'none';
    kur.style.display = 'block';
    kk.style.display = 'block';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button.style.display = 'none';
    button2.style.display = 'none';
    
  }
  else if (kur.style.display != 'none') {
    // text2.style.display='none';
    text1.style.display = 'block';
    //  form.reset(); 
    profile.style.display = 'block';
    kur.style.display = 'none';
    kk.style.display = 'none';
    tlac1.style.display = 'block';
    tlac2.style.display = 'none';
    pridat.style.display = 'none';
    nkk.style.display = 'none';
  }
  else if (inputs2[0].disabled == true && login.style.display != 'none') {
     text2.style.display='none';
    text1.style.display = 'block';
    //  form.reset(); 
    profile.style.display = 'block';
    login.style.display = 'none';
    // kk.style.display = 'none';
    tlac1.style.display = 'block';
    tlac2.style.display = 'none';
    kt.style.display = 'none';
    lt.style.display = 'block';
  }
  else if (inputs2[0].disabled == false && login.style.display != 'none') {
    inputs2.forEach(function (input) {
      input.disabled = true;
    });
   text2.style.display='none';
    text1.style.display = 'block';
    form2.reset(); 
    profile.style.display = 'block';
    login.style.display = 'none';
    // kk.style.display = 'none';
    tlac1.style.display = 'block';
    tlac2.style.display = 'none';
    kt.style.display = 'none';
    lt.style.display = 'block';
    button1.style.display = 'none';
    button21.style.display = 'none';
  }
});
  }
}
kurzy();
// const kurzyy = document.querySelector('#ku');
// kurzyy.addEventListener('click', kurzy);

function tretia() {
  const inputs = document.querySelectorAll('#formm input:not([type="hidden"])');
  const inputs2 = document.querySelectorAll('#formm2 input:not([type="hidden"])');
  const text1 = document.getElementById('jj');
  const text2 = document.getElementById('zz');
  // const button = document.getElementById('upd');
  // const button2 = dokurzyycument.getElementById('res');
  const form = document.getElementById('formm');
  const form2 = document.getElementById('formm2');
  const kur = document.getElementById('kurzy');
  const kk = document.getElementById('kk');
  const tlac1 = document.getElementById('tlac1');
  const tlac2 = document.getElementById('tlac2');
  const profile = document.getElementById('profile');
  const login = document.getElementById('login');
  const button = document.getElementById('upd');
  const button2 = document.getElementById('res');
  const button1 = document.getElementById('upd1');
  const button21 = document.getElementById('res1');
  const lt = document.getElementById('lt');
  const kt = document.getElementById('kt');
  const pridat = document.getElementById('pridat');
  const nkk = document.getElementById('nkk');
  // Získání všech inputů typu text
  const tretie = document.querySelector('#tr');
  if(tretie) {
  tretie.addEventListener('click', () => {
  if (inputs[0].disabled == true && profile.style.display != 'none') {
    text2.style.display = 'none';
    text1.style.display = 'block';
    profile.style.display = 'none';
    login.style.display = 'block';
    kur.style.display = 'none';
    kk.style.display = 'none';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button.style.display = 'none';
    button2.style.display = 'none';
    kt.style.display = 'block';
    lt.style.display = 'none';
  }
  else if (inputs[0].disabled == false && profile.style.display != 'none') {
    inputs.forEach(function (input) {
      input.disabled = true;
    });
    text2.style.display = 'none';
    text1.style.display = 'block';
    form.reset();
    profile.style.display = 'none';
    login.style.display = 'block';
    kur.style.display = 'none';
    kk.style.display = 'none';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button.style.display = 'none';
    button2.style.display = 'none';
    kt.style.display = 'block';
    lt.style.display = 'none';
  }
  else if (kur.style.display != 'none') {
    text2.style.display = 'none';
    text1.style.display = 'block';
    //  form.reset(); 
    // profile.style.display = 'block';
    login.style.display = 'block';
    kur.style.display = 'none';
    kk.style.display = 'none';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    kt.style.display = 'block';
    lt.style.display = 'none';
    
  } 
  else if (inputs2[0].disabled == true && login.style.display != 'none') {
    text2.style.display = 'none';
    text1.style.display = 'none';
    login.style.display = 'none';
    kur.style.display = 'block';
    kk.style.display = 'block';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button1.style.display = 'none';
    button21.style.display = 'none';
    kt.style.display = 'none';
    lt.style.display = 'block';
  }
  else if (inputs2[0].disabled == false && login.style.display != 'none') {
    inputs2.forEach(function (input) {
      input.disabled = true;
    });
    text2.style.display = 'none';
    text1.style.display = 'none';
    form2.reset();
    login.style.display = 'none';
    kur.style.display = 'block';
    kk.style.display = 'block';
    tlac1.style.display = 'none';
    tlac2.style.display = 'block';
    button1.style.display = 'none';
    button21.style.display = 'none';
    kt.style.display = 'none';
    lt.style.display = 'block';
  }
});
  }
  // Odstranění atributu disabled
}
tretia();
// const tretie = document.querySelector('#tr');







function handleFavLanguageRadio() {
  const favLanguageRadios = document.querySelectorAll('input[name="status"]');
  const additionalOptions = document.getElementById('ucm');
  const additionalUCM = document.getElementById('ucmkari');
  const additionalUCM2 = document.getElementById('ucmkari2');
  const ina = document.getElementById('ina');
  const nu = document.getElementById('nu');
  const iny = document.getElementById('iny');
  const ny = document.getElementById('ny');

  favLanguageRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === 'student' && radio.checked) {
        additionalOptions.style.display = 'block';
      } else {
        additionalOptions.style.display = 'none';
        additionalUCM.style.display = 'none';
        additionalUCM2.style.display = 'none';
        ina.style.display = 'none';
        nu.value = "";
        nu.disabled = true;
        iny.style.display = 'none';
        ny.disabled = true;
        ny.value = "";

        document.getElementById("ucmka").checked = false;
        document.getElementById("inam").checked = false;
        document.getElementById("option3").checked = false;
        document.getElementById("option4").checked = false;
        document.getElementById("option5").checked = false;
        document.getElementById("option6").checked = false;
      }
    });
  });
}

// Call the function to handle radio button selection
handleFavLanguageRadio();

function handleUCMradio() {
  const UCMradios = document.querySelectorAll('input[name="skola"]');
  const additionalUCM = document.getElementById('ucmkari');
  const additionalUCM2 = document.getElementById('ucmkari2');
  const ina = document.getElementById('ina');
  const nu = document.getElementById('nu');
  const iny = document.getElementById('iny');
  const ny = document.getElementById('ny');


  UCMradios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === 'ucm' && radio.checked) {
        additionalUCM.style.display = 'block';
        additionalUCM2.style.display = 'block';
        ina.style.display = 'none';
        nu.disabled = true;
        nu.value = "";
      } else {
        additionalUCM.style.display = 'none';
        additionalUCM2.style.display = 'none';
        ina.style.display = 'block';

        iny.style.display = 'none';
        ny.disabled = true;
        ny.value = "";

        nu.disabled = false;
        document.getElementById("option3").checked = false;
        document.getElementById("option4").checked = false;
        document.getElementById("option5").checked = false;
        document.getElementById("option6").checked = false;
      }
    });
  });

  const programradio = document.querySelectorAll('input[name="program"]');

  programradio.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === 'iny' && radio.checked) {
        iny.style.display = 'block';
        ny.disabled = false;
      } else {
        iny.style.display = 'none';
        ny.disabled = true;
        ny.value = "";
      }
    });
  });
}

// Call the function to handle radio button selection
handleUCMradio();

// function handleStatusCheckbox() {
//     const checkboxes = document.querySelectorAll('.status-checkbox');
//     const additionalCheckboxes = document.getElementById('additional-checkboxes');

//     checkboxes.forEach(checkbox => {
//       checkbox.addEventListener('change', () => {
//         if (checkbox.checked) {
//           // Show additional checkboxes if "student" is selected
//           if (checkbox.value === 'student') {
//             additionalCheckboxes.style.display = 'block';
//             $("#checkbox2").prop("checked", false);
//           }
//           else {
//             $("#checkbox").prop("checked", false);
//             additionalCheckboxes.style.display = 'none';
//           }
//         } else {
//           // Hide additional checkboxes if neither "student" nor "nestudent" is selected
//           additionalCheckboxes.style.display = 'none';
//         }
//       });
//     });
//   }

// Call the function to handle checkbox selection
//   handleStatusCheckbox();

function jq_ChainCombo(el) {
  var selected = $(el).find(':selected').data('id');
  var next_combo = $(el).data('nextcombo');

  if (!$(next_combo).data('store')) {
    $(next_combo).data('store', $(next_combo).find('option'));
  }

  var options2 = $(next_combo).data('store');
  $(next_combo).empty().append(
    options2.filter(function () {
      return $(this).data('option') === selected;
    })
  );
  $(next_combo).prop('disabled', false);

  // get default value
  var defaultValue = $(next_combo).data('default');
  if (defaultValue) {
    $(next_combo).val(defaultValue); // set default value as selected
  }

  if ($(next_combo).data('nextcombo') !== undefined) {
    jq_ChainCombo(next_combo);
  }
}



// quick little jquery plugin to apply jq_ChainCombo to all selects with a data-nextcombo on them
jQuery.fn.chainCombo = function () {
  // find all divs with a data-nextcombo attribute
  $('[data-nextcombo]').each(function (i, obj) {
    $(this).change(function () {
      jq_ChainCombo(this);
    });
  });
}();

$('#setDefaults').click(function () {
  // Získajte hodnoty predvolených hodnôt
  var defaultOption1 = ''; // Nahraďte hodnotou zo svojho modelu alebo iného zdroja
  var defaultOption2 = ''; // Nahraďte hodnotou zo svojho modelu alebo iného zdroja

  // Nastavte predvolené hodnoty pre oba selecty
  $('#academy').val(defaultOption1);
  $('#coursetype_id').val(defaultOption2);
  $('#coursetype_id').prop('disabled', true);

  // Spustite funkciu jq_ChainCombo na prvom selecte, ak chcete, aby sa reťazové selecty aktualizovali
  // jq_ChainCombo($('#academy'));
});

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

  if (name == '' && lastname == '' && email == '') {
    name = "/";

  }
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

      // První sloupec s rowspan="2"
      let nameCell = document.createElement('td');
      nameCell.setAttribute('rowspan', '2');
      nameCell.className = 'px-6 py-4 whitespace-nowrap';
      nameCell.textContent = student.name;
      option.appendChild(nameCell);

      // Druhý sloupec s rowspan="2"
      let lastnameCell = document.createElement('td');
      lastnameCell.setAttribute('rowspan', '2');
      lastnameCell.className = 'px-6 py-4 whitespace-nowrap';
      lastnameCell.textContent = student.lastname;
      option.appendChild(lastnameCell);

      // Třetí sloupec s rowspan="2"
      let emailCell = document.createElement('td');
      // emailCell.setAttribute('rowspan', '2');
      emailCell.className = 'text-xs font-bold px-3 py-2 whitespace-nowrap';
      emailCell.textContent = student.email;
      option.appendChild(emailCell);

      // Čtvrtý sloupec
      let ulica = document.createElement('td');
      ulica.className = 'text-xs px-3 py-2 whitespace-nowrap';
      ulica.textContent = student.ulicacislo;
      option.appendChild(ulica);

      let mesto = document.createElement('td');
      mesto.className = 'text-xs px-3 py-2 whitespace-nowrap';
      mesto.textContent = student.mestoobec;
      option.appendChild(mesto);

      let pscCell = document.createElement('td');
      pscCell.className = 'text-xs px-3 py-2 whitespace-nowrap';
      pscCell.textContent = student.psc;
      option.appendChild(pscCell);

      // Přidání prvního řádku do tabulky
      searchResults.appendChild(option);

      // Druhý řádek s dodatečným sloupcem
      let suboption = document.createElement('tr');
      let subemail = document.createElement('td');
      subemail.className = 'text-xs font-normal text-gray-600 px-3 py-2 whitespace-nowrap';
      subemail.textContent = student.sekemail;
      suboption.appendChild(subemail);

      let suboptionCell = document.createElement('td');
      suboptionCell.className = 'text-xs px-3 py-2 whitespace-nowrap';
      suboptionCell.textContent = student.status;
      suboption.appendChild(suboptionCell);

      let skola = document.createElement('td');
      skola.className = 'text-xs px-3 py-2 whitespace-nowrap';
      skola.textContent = student.skola;
      suboption.appendChild(skola);

      let studium = document.createElement('td');
      studium.className = 'text-xs px-3 py-2 whitespace-nowrap';
      studium.textContent = student.studium;
      suboption.appendChild(studium);

      let program = document.createElement('td');
      program.className = 'text-xs px-3 py-2 whitespace-nowrap';
      program.textContent = student.program;
      suboption.appendChild(program);

      // Přidání druhého řádku do tabulky
      searchResults.appendChild(suboption);

      // Události pro první řádek
      option.setAttribute('title', student.email);
      option.addEventListener('click', function () {
        document.querySelector('input[name="name"]').value = student.name;
        document.querySelector('input[name="lastname"]').value = student.lastname;
        document.querySelector('input[name="email"]').value = student.email;
        searchResults.innerHTML = '';
      });
      suboption.addEventListener('click', function () {
        document.querySelector('input[name="name"]').value = student.name;
        document.querySelector('input[name="lastname"]').value = student.lastname;
        document.querySelector('input[name="email"]').value = student.email;
        searchResults.innerHTML = '';
      });
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

$(document).ready(function () {
  // Nastaviť default hodnoty pre selecty
  if (oldInput['coursetype_id']) {
    console.log(oldInput['coursetype_id'])
  };
  const academySelects = document.querySelectorAll('.academy-select');
  academySelects.forEach(function (select) {
    select.value = '';
  });
  const coursetypeSelects = document.querySelectorAll('.coursetype-select');
  coursetypeSelects.forEach(function (select) {
    select.innerHTML = '<option value="">Typ kurzu</option>';
  });

  const academies = document.querySelectorAll('.academy-select');
  academies.forEach(function (academySelect) {
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






