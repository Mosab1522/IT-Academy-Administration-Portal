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
    if (switchFormLink) {
      switchFormLink.addEventListener("click", function (event) {
        event.preventDefault();

        loginForm.style.display = "block";
        registerForm.style.display = "none";
        switchFormLink.style.color = "rgb(59, 130, 246)";
        switchFormLink2.style.color = "rgb(55 65 81)";

      });
    }
    if (switchFormLink2) {
      switchFormLink2.addEventListener("click", function (event) {
        event.preventDefault();


        loginForm.style.display = "none";
        registerForm.style.display = "block";
        switchFormLink2.style.color = "rgb(59, 130, 246)";
        switchFormLink.style.color = "rgb(55 65 81)";
      });
    }

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
document.addEventListener('DOMContentLoaded', function () {
  const sectionButtons = document.querySelectorAll('.section-button');
  const sections = document.querySelectorAll('.section');
  const editButtons = document.querySelectorAll('.edit-button');
  const addButtons = document.querySelectorAll('.add-button');
  

  // Function to toggle sections
  function resetEditingAndAddingStates() {
    // Reset editing state for all forms within sections
    document.querySelectorAll('.section form').forEach(form => {
      form.querySelectorAll('input:not([type="hidden"])').forEach(input => {
        input.disabled = true; // Disable editing
      });
      form.querySelectorAll('select').forEach(select => {
        select.disabled = true;
    });
    });
    
    document.querySelectorAll('.section button[type="submit"]:not(.delete-button),.section button[type="reset"]').forEach(button => {
      button.style.display = 'none';
  });

    // Reset button texts to defaults
    if (editButtons) {
      editButtons.forEach(button => {
        const editSpan = button.querySelector('span:first-child');
        const stopEditSpan = button.querySelector('span:last-child');
        editSpan.style.display = 'inline';
        stopEditSpan.style.display = 'none';
      });
    }

    if (addButtons) {
      addButtons.forEach(button => {
        const addSpan = button.querySelector('span:first-child');
        const stopAddingSpan = button.querySelector('span:last-child');
        addSpan.style.display = 'inline';
        stopAddingSpan.style.display = 'none';
      });
    }

    // Hide all add sections
    document.querySelectorAll('.add-section').forEach(section => {
      section.style.display = 'none';
    });
  }

  // Function to toggle sections
  function toggleSection(button) {
    resetEditingAndAddingStates(); // Reset states when switching sections

    sections.forEach(section => {
      if (section.id === button.dataset.target) {
        section.style.display = 'block';
        // Show relevant buttons for the active section
        showRelevantButtons(button.dataset.target);
      } else {
        section.style.display = 'none';
      }
    });

    // Update visibility of section buttons
    updateSectionButtonsVisibility(button.dataset.target);
  }

  // Function to show relevant buttons for the active section
  function showRelevantButtons(activeSectionId) {
    // Hide all buttons initially
    editButtons.forEach(button => { button.style.display = 'none'; button.parentNode.style.display = 'none'; button.parentNode.parentNode.style.display = 'none';});
    addButtons.forEach(button => { button.style.display = 'none'; button.parentNode.style.display = 'none'; button.parentNode.parentNode.style.display = 'none';} );

    // Show edit and add buttons that are relevant to the active section
    document.querySelectorAll(`.edit-button[data-target="${activeSectionId}"], .add-button[data-target="${activeSectionId}Add"]`).forEach(button => {
      button.style.display = 'block';  // Display as block-level elements
      button.style.flex = '1';         // Ensure the button takes equal space
      button.parentNode.style.display = 'flex';// Adjust display as needed
      button.parentNode.parentNode.style.display = 'flex';
    });
  }

  // Function to update the visibility of section buttons based on the active section
  function updateSectionButtonsVisibility(activeSectionId) {
    let firstTarget = null;
    let firstParent = null;
    sectionButtons.forEach(button => {
      if (button.dataset.target != firstTarget && button.parentNode != firstParent) {
        if (button.dataset.target === activeSectionId) {
          button.style.display = 'none'

        } else {
          button.style.display = 'inline-block';
          firstTarget = button.dataset.target;
          firstParent = button.parentNode;
        }
      } else {
        button.style.display = 'none'
      }
      // if (button.dataset.target === activeSectionId) {
      //     // Hide the button for the active section
      //     button.style.display = 'none';
      // } else {
      //     // Show the button for all other sections
      //     button.style.display = 'inline-block';
      // }
    });
  }
  let isEditing = false;
  const vytvaranie = document.getElementById('vytvaranie')
  if(vytvaranie)
  {
     if(vytvaranie.style.display === 'none') {
    isEditing = true;
    console.log('haha');
  }
  }
 
  function enableEditing(button) {
    const targetForm = document.querySelector(`#${button.dataset.target}`);
    console.log('tu');
    if (targetForm) {
        const form = targetForm.querySelector('form');
        console.log('tu');
        // const isEditing = Array.from(targetForm.querySelectorAll('input:not([type="hidden"])')).some(input => input.disabled);
        isEditing = !isEditing;
        // Toggle the disabled state of input elements based on the current editing state
        targetForm.querySelectorAll('input:not([type="hidden"]):not(.hidden)').forEach(input => {
          input.disabled = !isEditing;
      });
        targetForm.querySelectorAll('select').forEach(select => {
          select.disabled = !isEditing;
      });
        console.log('tu');
        const buttons = targetForm.querySelectorAll('button');

        // Toggle the visibility of span elements based on the editing state
        const editSpan = button.querySelector('span:first-child');
        const stopEditSpan = button.querySelector('span:last-child');
        console.log('tu');
        if (isEditing) {
            // Hide edit span and show stop edit span
            console.log('tue');
            editSpan.style.display = 'none';
            stopEditSpan.style.display = 'inline';
            buttons.forEach(button => {
                button.style.display = 'inline-block';
            });
        } else {
            // Show edit span and hide stop edit span
            console.log('tus');
            editSpan.style.display = 'inline';
            stopEditSpan.style.display = 'none';
            buttons.forEach(button => {
                button.style.display = 'none';
            });
            form.reset(); // Reset the form when ending editing
        }
    }
}


  // Function to show add forms or sections
  function showAddForm(button) {
    const targetSection = document.querySelector(`#${button.dataset.target}`);
    if (targetSection) {
      const isVisible = targetSection.style.display === 'block';
      targetSection.style.display = isVisible ? 'none' : 'block';

      // Toggle the visibility of span elements based on the section's visibility
      const addSpan = button.querySelector('span:first-child');
      const stopAddingSpan = button.querySelector('span:last-child');

      if (isVisible) {
        addSpan.style.display = 'inline';
        stopAddingSpan.style.display = 'none';
      } else {
        addSpan.style.display = 'none';
        stopAddingSpan.style.display = 'inline';
      }
    }
  }

  // Event listener for section buttons
  sectionButtons.forEach(button => {
    button.addEventListener('click', function () {
      toggleSection(button);
    });
  });

  // Event listeners for edit buttons
  editButtons.forEach(button => {
    button.addEventListener('click', function () {
      enableEditing(button);
    });
  });

  // Event listeners for add buttons
  addButtons.forEach(button => {
    button.addEventListener('click', function () {
      showAddForm(button);
    });
  });
});


// const tretie = document.querySelector('#tr');
function handleTypeRadio() {
  const favTypeRadios = document.querySelectorAll('input[name="type"]');
  const student = document.getElementById('stud');
  const instruktor = document.getElementById('inst');
  const favTypeRadios2 = document.querySelectorAll('input[name="type2"]');
  const student2 = document.getElementById('stud2');
  const instruktor2 = document.getElementById('inst2');


  favTypeRadios.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === '0' && radio.checked) {
        student.style.display = 'flex';
        instruktor.style.display = 'none';

      } else {
        instruktor.style.display = 'flex';
        student.style.display = 'none';

      }
    });
  });
  favTypeRadios2.forEach(radio => {
    radio.addEventListener('change', () => {
      if (radio.value === '0' && radio.checked) {
        student2.style.display = 'flex';
        instruktor2.style.display = 'none';

      } else {
        instruktor2.style.display = 'flex';
        student2.style.display = 'none';

      }
    });
  });
}
handleTypeRadio();



document.addEventListener('DOMContentLoaded', function () {
  setupRadioControls();

  const form = document.getElementById('formm');
  if (!form) return; // Exit if the form wasn't found

  // Attach the reset event listener to the form
  form.addEventListener('reset', function () {
   // setTimeout(() => {
      applyVisibilityRulesBasedOnStudentData(radioMappings, studentData);
   // }, 1000); // Increase delay to 100 milliseconds
  });
  

  function setupRadioControls() {
    const radioMappings = [
      {
        name: 'status',
        mappings: [
          {
            value: 'student',
            elementsToShow: ['ucm'],
            elementsToHide: ['ucmkari', 'ucmkari2', 'ina', 'iny','nu', 'ny'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: [],
            elementsToDisable: [],
            radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
          },
          {
            value: 'nestudent',
            elementsToShow: [],
            elementsToHide: ['ucm', 'ucmkari', 'ucmkari2', 'ina', 'iny','nu', 'ny'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: [],
            elementsToDisable: ['nu', 'ny'],
            radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
          }
        ]
      },
      {
        name: 'skola',
        mappings: [
          {
            value: 'ucm',
            elementsToShow: ['ucmkari', 'ucmkari2'],
            elementsToHide: ['ina', 'iny','nu', 'ny'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: [],
            elementsToDisable: ['nu'],
            radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
          },
          {
            value: 'ina',
            elementsToShow: ['ina', 'nu'],
            elementsToHide: ['ucmkari', 'ucmkari2', 'iny', 'ny'],
            elementsToReset: ['ny'],
            elementsToEnable: ['nu'],
            elementsToDisable: [],// Add this line to enable 'nu' when 'ina' is selected
            radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
          }
        ]
      },
      {
        name: 'program',
        mappings: [
          {
            value: 'iny',
            elementsToShow: ['iny', 'ny'],
            elementsToHide: [],
            elementsToReset: [],
            elementsToEnable: ['ny'],
            elementsToDisable: [], // Add this line to enable 'ny' when 'iny' is selected
            radiosToUncheck: []
          },
          {
            value: 'apin',
            elementsToShow: [],
            elementsToHide: ['iny', 'ny'],
            elementsToReset: ['ny'],
            elementsToEnable: [],
            elementsToDisable: ['ny'],
            radiosToUncheck: []
          }
        ]
      }
    ];

    radioMappings.forEach(mapping => {
      const radios = document.querySelectorAll(`input[name="${mapping.name}"]`);
      radios.forEach(radio => {
        radio.addEventListener('change', function () {
          mapping.mappings.forEach(map => {
            if (radio.value === map.value && radio.checked) {
              map.elementsToShow.forEach(id => document.getElementById(id).style.display = 'block');
              map.elementsToHide.forEach(id => document.getElementById(id).style.display = 'none');
              map.elementsToReset.forEach(id => {
                document.getElementById(id).value = "";
                document.getElementById(id).disabled = true;
              });
              map.elementsToEnable.forEach(id => document.getElementById(id).disabled = false);
              map.elementsToDisable.forEach(id => document.getElementById(id).disabled = true);
              map.radiosToUncheck.forEach(id => document.getElementById(id).checked = false);
            }
          });
        });
      });
    });
  }
});

const radioMappings = [
  {
    name: 'status',
    mappings: [
      {
        value: 'student',
        elementsToShow: ['ucm'],
        elementsToHide: ['ucmkari', 'ucmkari2', 'ina', 'iny','nu', 'ny'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: [],
        elementsToDisable: [],
        radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
      },
      {
        value: 'nestudent',
        elementsToShow: [],
        elementsToHide: ['ucm', 'ucmkari', 'ucmkari2', 'ina', 'iny','nu', 'ny'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: [],
        elementsToDisable: ['nu', 'ny'],
        radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
      }
    ]
  },
  {
    name: 'skola',
    mappings: [
      {
        value: 'ucm',
        elementsToShow: ['ucmkari', 'ucmkari2'],
        elementsToHide: ['ina', 'iny','nu', 'ny'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: [],
        elementsToDisable: ['nu'],
        radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
      },
      {
        value: 'ina',
        elementsToShow: ['ina', 'nu'],
        elementsToHide: ['ucmkari', 'ucmkari2', 'iny', 'ny'],
        elementsToReset: ['ny'],
        elementsToEnable: ['nu'],
        elementsToDisable: [],// Add this line to enable 'nu' when 'ina' is selected
        radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
      }
    ]
  },
  {
    name: 'program',
    mappings: [
      {
        value: 'iny',
        elementsToShow: ['iny', 'ny'],
        elementsToHide: [],
        elementsToReset: [],
        elementsToEnable: ['ny'],
        elementsToDisable: [], // Add this line to enable 'ny' when 'iny' is selected
        radiosToUncheck: []
      },
      {
        value: 'apin',
        elementsToShow: [],
        elementsToHide: ['iny', 'ny'],
        elementsToReset: ['ny'],
        elementsToEnable: [],
        elementsToDisable: ['ny'],
        radiosToUncheck: []
      }
    ]
  }
];

function applyVisibilityRulesBasedOnStudentData(radioMappings, studentData) {
  console.log(studentData);
  radioMappings.forEach(mapping => {
    if (studentData.hasOwnProperty(mapping.name)) {
      const value = studentData[mapping.name];
      console.log(mapping.name);
      const mappingToApply = mapping.mappings.find(m => m.value === value);
      if (mappingToApply) {
        applyVisibilityRules(mapping, value,studentData);
      }
    }
  });
}

function applyVisibilityRules(mapping, value,studentData) {
  console.log('Applying visibility rules for:', mapping.name, 'with value:', value);
  console.log(studentData);
  const selectedMapping = mapping.mappings.find(m => m.value === value);
  if (!selectedMapping) return;

  // Show elements
  selectedMapping.elementsToShow.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.style.display = 'block';
    }
  });
  console.log('1');
  // Hide elements
  selectedMapping.elementsToHide.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.style.display = 'none';
    }
  });
  console.log('2');
  // Reset elements
  selectedMapping.elementsToReset.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.value = '';
      // Decide if you want to disable these elements as well
      // elem.disabled = true;
    }
  });

   selectedMapping.elementsToEnable.forEach(id => {
    const elem = document.getElementById(id);
    const resetbutton = document.getElementById('resetbutton');
    if (elem){ 
      if(resetbutton.style.display == 'none')
      {
        elem.disabled = false;
      }
      
      if(id == 'nu')
      {
        elem.value = studentData['skola_r']; 
      }
      if(id =='ny')
      {
        elem.value = studentData['program_r']; 
      }
      
    }
  });
  
  // selectedMapping.elementsToHave.forEach(id => {
  //   const elem = document.getElementById(id);
  //   if (elem && id == 'ina') {
  //     elem.value = studentData.skola_r;
  //     // Decide if you want to disable these elements as well
  //     // elem.disabled = true;
  //   }
  //   if (elem && id == 'iny') {
  //     console.log('som tu');
  //     elem.value = 'this';
  //     console.log('som tu');
  //     // Decide if you want to disable these elements as well
  //     // elem.disabled = true;
  //   }
  // });
  console.log('3');
  // Enable elements
 
  console.log('4');
  // Disable elements
  selectedMapping.elementsToDisable.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {elem.disabled = true; }
  });
  console.log('5');
  // Uncheck radios
  // selectedMapping.radiosToUncheck.forEach(id => {
  //   const radio = document.getElementById(id);
  //   if (radio){ radio.checked = false; }
  // });
  console.log('6');
}






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

// $('#setDefaults').click(function () {
//   // Získajte hodnoty predvolených hodnôt
//   var defaultOption1 = ''; // Nahraďte hodnotou zo svojho modelu alebo iného zdroja
//   var defaultOption2 = ''; // Nahraďte hodnotou zo svojho modelu alebo iného zdroja

//   // Nastavte predvolené hodnoty pre oba selecty
//   $('#academy').val(defaultOption1);
//   $('#coursetype_id').val(defaultOption2);
//   $('#coursetype_id').prop('disabled', true);

//   // Spustite funkciu jq_ChainCombo na prvom selecte, ak chcete, aby sa reťazové selecty aktualizovali
//   // jq_ChainCombo($('#academy'));
// });

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
    // Assuming 'students' is an array of student objects and 'searchResults' is the tbody element of your table
students.forEach(student => {
  let option = document.createElement('tr');
  option.className = "bg-white hover:bg-gray-50";

  // Name cell
  let nameCell = document.createElement('td');
  nameCell.className = 'px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900';
  nameCell.textContent = student.name;
  option.appendChild(nameCell);

  // Lastname cell
  let lastnameCell = document.createElement('td');
  lastnameCell.className = 'px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900';
  lastnameCell.textContent = student.lastname;
  option.appendChild(lastnameCell);

  // Email cell
  let emailCell = document.createElement('td');
  emailCell.className = 'text-sm px-6 py-3 whitespace-nowrap text-gray-500';
  emailCell.textContent = student.email;
  option.appendChild(emailCell);

  // More Info cell
  let moreInfoIndicatorCell = document.createElement('td');
    moreInfoIndicatorCell.className = 'text-sm px-6 py-3 whitespace-nowrap text-gray-500 cursor-pointer more-info-column';
    moreInfoIndicatorCell.textContent = "Viac info...";
    moreInfoIndicatorCell.setAttribute('data-info-visible', 'false');
    option.appendChild(moreInfoIndicatorCell);

  // Append the first row to the table body
  searchResults.appendChild(option);

  // Additional info row for detailed information
  let subOption = document.createElement('tr');
  subOption.className = "bg-white hidden"; // Start hidden
  let additionalInfoCell = document.createElement('td');
  additionalInfoCell.className = 'text-xs px-4 py-2 text-gray-500';
  additionalInfoCell.setAttribute('colspan', '4');
  additionalInfoCell.innerHTML = `Additional Emails: ${student.sekemail}, Status: ${student.status}, School: ${student.skola}, Study: ${student.studium}, Program: ${student.program}`;
  subOption.appendChild(additionalInfoCell);

  // Append the second row to the table body
  searchResults.appendChild(subOption);

  // Event Listener for toggling additional information
  moreInfoIndicatorCell.addEventListener('click', function() {
    let isInfoVisible = this.getAttribute('data-info-visible') === 'true';
    this.textContent = isInfoVisible ? "Viac info..." : "Menej info...";
    subOption.style.display = isInfoVisible ? 'none' : 'table-row'; // Use 'table-row' instead of empty string for display
    this.setAttribute('data-info-visible', String(!isInfoVisible));
});

  // Click event for the whole row, excluding the More/Less info cell
  option.addEventListener('click', function(event) {
      if (event.target !== moreInfoIndicatorCell) {
          document.querySelector('input[name="name"]').value = student.name;
          document.querySelector('input[name="lastname"]').value = student.lastname;
          document.querySelector('input[name="email"]').value = student.email;
          // Clear the table or perform any other required actions
          searchResults.innerHTML = '';
      }
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
  pairWrapper.classList.add('selects-pair', 'flex', 'items-center', 'justify-between', 'mb-6'); // Tailwind classes for flex layout
  pairWrapper.dataset.pairId = ++pairsCount;

  const academySelect = document.createElement('select');
  academySelect.name = 'academy_id[]';
  academySelect.classList.add('academy-select', 'bg-white', 'border', 'border-gray-300', 'rounded-md', 'text-gray-700', 'p-2', 'flex-1', 'mr-2'); // Tailwind classes for the select
  academySelect.dataset.pairId = pairsCount;

  const firstAcademySelect = selectsContainer.querySelector('.academy-select');
  if (firstAcademySelect) {
      academySelect.innerHTML = firstAcademySelect.innerHTML;
      academySelect.value = "";
  }

  const coursetypeSelect = document.createElement('select');
  coursetypeSelect.name = 'coursetypes_id[]';
  coursetypeSelect.classList.add('coursetype-select', 'bg-white', 'border', 'border-gray-300', 'rounded-md', 'text-gray-700', 'p-2', 'flex-1', 'mx-2'); // Tailwind classes for the select
  coursetypeSelect.dataset.pairId = pairsCount;

  const removeBtn = document.createElement('button');
  removeBtn.classList.add('remove-selects-btn', 'text-white', 'bg-red-500', 'hover:bg-red-700', 'p-2', 'rounded' ,'ml-4'); // Tailwind classes for button
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






