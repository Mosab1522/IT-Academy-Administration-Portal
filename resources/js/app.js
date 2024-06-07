import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

if (window.screen.width < 660) {
  const lockOrientation = screen.lockOrientation || screen.mozLockOrientation || screen.msLockOrientation || screen.orientation.lock;

  if (lockOrientation) {
    lockOrientation('portrait').catch(function (error) {
    });
  }
}

document.addEventListener('DOMContentLoaded', function () {
  const sectionButtons = document.querySelectorAll('.section-button');
  const sections = document.querySelectorAll('.section');
  const editButtons = document.querySelectorAll('.edit-button');
  const addButtons = document.querySelectorAll('.add-button');


  function resetEditingAndAddingStates() {
    document.querySelectorAll('.section form').forEach(form => {
      form.querySelectorAll('input:not([type="hidden"])').forEach(input => {
        input.disabled = true;
      });
      form.querySelectorAll('select').forEach(select => {
        select.disabled = true;
      });
    });

    document.querySelectorAll('.section button[type="submit"]:not(.delete-button),.section button[type="reset"]').forEach(button => {
      button.style.display = 'none';
    });

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

    document.querySelectorAll('.add-section').forEach(section => {
      section.style.display = 'none';
    });
  }

  function toggleSection(button) {
    resetEditingAndAddingStates();

    sections.forEach(section => {
      if (section.id === button.dataset.target) {
        section.style.display = 'block';
        showRelevantButtons(button.dataset.target);
      } else {
        section.style.display = 'none';
      }
    });

    updateSectionButtonsVisibility(button.dataset.target);
  }

  function showRelevantButtons(activeSectionId) {
    editButtons.forEach(button => { button.style.display = 'none'; button.parentNode.style.display = 'none'; button.parentNode.parentNode.style.display = 'none'; });
    addButtons.forEach(button => { button.style.display = 'none'; button.parentNode.style.display = 'none'; button.parentNode.parentNode.style.display = 'none'; });

    document.querySelectorAll(`.edit-button[data-target="${activeSectionId}"], .add-button[data-target="${activeSectionId}Add"]`).forEach(button => {
      button.style.display = 'block';
      button.style.flex = '1';
      button.parentNode.style.display = 'flex';
      button.parentNode.parentNode.style.display = 'flex';
    });
  }

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

    });
  }
  let isEditing = false;
  const vytvaranie = document.getElementById('vytvaranie')
  if (vytvaranie) {
    if (vytvaranie.style.display === 'none') {
      isEditing = true;
    }
  }

  function enableEditing(button) {
    const targetForm = document.querySelector(`#${button.dataset.target}`);
    if (targetForm) {
      const form = targetForm.querySelector('form');

      isEditing = !isEditing;
      targetForm.querySelectorAll('input:not([type="hidden"]):not(.hidden)').forEach(input => {
        input.disabled = !isEditing;
      });
      targetForm.querySelectorAll('select').forEach(select => {
        select.disabled = !isEditing;
      });

      const buttons = targetForm.querySelectorAll('button');
      const editSpan = button.querySelector('span:first-child');
      const stopEditSpan = button.querySelector('span:last-child');

      if (isEditing) {
        editSpan.style.display = 'none';
        form.querySelector('.required-info').style.display = 'block';
        stopEditSpan.style.display = 'inline';
        buttons.forEach(button => {
          button.style.display = 'inline-block';
        });
      } else {
        editSpan.style.display = 'inline';
        stopEditSpan.style.display = 'none';
        form.querySelector('.required-info').style.display = 'none';
        buttons.forEach(button => {
          button.style.display = 'none';
        });
        form.reset();
      }
    }
  }

  function showAddForm(button) {
    const targetSection = document.querySelector(`#${button.dataset.target}`);
    if (targetSection) {
      const isVisible = targetSection.style.display === 'block';
      targetSection.style.display = isVisible ? 'none' : 'block';

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

  sectionButtons.forEach(button => {
    button.addEventListener('click', function () {
      toggleSection(button);
    });
  });

  editButtons.forEach(button => {
    button.addEventListener('click', function () {
      enableEditing(button);
    });
  });

  addButtons.forEach(button => {
    button.addEventListener('click', function () {
      showAddForm(button);
    });
  });
});

function handleTypeRadio() {
  const favTypeRadios = document.querySelectorAll('input[name="type"]');
  const student = document.getElementById('stud');
  const instruktor = document.getElementById('inst');
  const favTypeRadios2 = document.querySelectorAll('input[name="type2"]');
  const student2 = document.getElementById('stud2');
  const instruktor2 = document.getElementById('inst2');

  if (student) {
    favTypeRadios.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.value === '0' && radio.checked) {
          student.style.display = 'flex';
          instruktor.style.display = 'none';

          student.querySelector('select').disabled = false;
          instruktor.querySelectorAll('select').forEach(select => select.disabled = true);
        } else {
          instruktor.style.display = 'flex';
          student.style.display = 'none';

          instruktor.querySelector('select').disabled = false;

          student.querySelectorAll('select').forEach(select => select.disabled = true);

        }
      });
    });
  }
  if (student2) {
    favTypeRadios2.forEach(radio => {
      radio.addEventListener('change', () => {
        if (radio.value === '0' && radio.checked) {
          student2.style.display = 'flex';
          instruktor2.style.display = 'none';

          student2.querySelector('select').disabled = false;
          instruktor2.querySelectorAll('select').forEach(select => select.disabled = true);
        } else {
          instruktor2.style.display = 'flex';
          student2.style.display = 'none';

          instruktor2.querySelector('select').disabled = false;
          student2.querySelectorAll('select').forEach(select => select.disabled = true);
        }
      });
    });
  }

}
handleTypeRadio();



document.addEventListener('DOMContentLoaded', function () {
  setupRadioControls();

  const form = document.getElementById('formm');
  if (!form) return;
  form.addEventListener('reset', function () {
    applyVisibilityRulesBasedOnStudentData(radioMappings, studentData);
  });


  function setupRadioControls() {
    const radioMappings = [
      {
        name: 'status',
        mappings: [
          {
            value: 'student',
            elementsToShow: ['ucm', 'ucmka', 'inam'],
            elementsToHide: ['ucmkari', 'ucmkari2', 'ina', 'iny', 'nu', 'ny'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: ['ucmka', 'inam'],
            elementsToDisable: [],
            radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
          },
          {
            value: 'nestudent',
            elementsToShow: [],
            elementsToHide: ['ucm', 'ucmkari', 'ucmkari2', 'ina', 'iny', 'nu', 'ny', 'ucmka', 'inam', 'option3', 'option4', 'option5', 'option6'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: [],
            elementsToDisable: ['nu', 'ny', 'ucmka', 'inam', 'option3', 'option4', 'option5', 'option6'],
            radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
          }
        ]
      },
      {
        name: 'skola',
        mappings: [
          {
            value: 'ucm',
            elementsToShow: ['ucmkari', 'ucmkari2', 'option3', 'option4', 'option5', 'option6'],
            elementsToHide: ['ina', 'iny', 'nu', 'ny'],
            elementsToReset: ['nu', 'ny'],
            elementsToEnable: ['option3', 'option4', 'option5', 'option6'],
            elementsToDisable: ['nu'],
            radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
          },
          {
            value: 'ina',
            elementsToShow: ['ina', 'nu'],
            elementsToHide: ['ucmkari', 'ucmkari2', 'iny', 'ny', 'option3', 'option4', 'option5', 'option6'],
            elementsToReset: ['ny'],
            elementsToEnable: ['nu'],
            elementsToDisable: ['option3', 'option4', 'option5', 'option6'],// Add this line to enable 'nu' when 'ina' is selected
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
        elementsToShow: ['ucm', 'ucmka', 'inam'],
        elementsToHide: ['ucmkari', 'ucmkari2', 'ina', 'iny', 'nu', 'ny'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: ['ucmka', 'inam'],
        elementsToDisable: [],
        radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
      },
      {
        value: 'nestudent',
        elementsToShow: [],
        elementsToHide: ['ucm', 'ucmkari', 'ucmkari2', 'ina', 'iny', 'nu', 'ny', 'ucmka', 'inam', 'option3', 'option4', 'option5', 'option6'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: [],
        elementsToDisable: ['nu', 'ny', 'ucmka', 'inam', 'option3', 'option4', 'option5', 'option6'],
        radiosToUncheck: ['ucmka', 'inam', 'option3', 'option4', 'option5', 'option6']
      }
    ]
  },
  {
    name: 'skola',
    mappings: [
      {
        value: 'ucm',
        elementsToShow: ['ucmkari', 'ucmkari2', 'option3', 'option4', 'option5', 'option6'],
        elementsToHide: ['ina', 'iny', 'nu', 'ny'],
        elementsToReset: ['nu', 'ny'],
        elementsToEnable: ['option3', 'option4', 'option5', 'option6'],
        elementsToDisable: ['nu'],
        radiosToUncheck: ['option3', 'option4', 'option5', 'option6']
      },
      {
        value: 'ina',
        elementsToShow: ['ina', 'nu'],
        elementsToHide: ['ucmkari', 'ucmkari2', 'iny', 'ny', 'option3', 'option4', 'option5', 'option6'],
        elementsToReset: ['ny'],
        elementsToEnable: ['nu'],
        elementsToDisable: ['option3', 'option4', 'option5', 'option6'],
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
        elementsToDisable: [],
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
  radioMappings.forEach(mapping => {
    if (studentData.hasOwnProperty(mapping.name)) {
      const value = studentData[mapping.name];
      const mappingToApply = mapping.mappings.find(m => m.value === value);
      if (mappingToApply) {
        applyVisibilityRules(mapping, value, studentData);
      }
    }
  });
}

function applyVisibilityRules(mapping, value, studentData) {
  const selectedMapping = mapping.mappings.find(m => m.value === value);
  if (!selectedMapping) return;

  selectedMapping.elementsToShow.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.style.display = 'block';
    }
  });
  selectedMapping.elementsToHide.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.style.display = 'none';
    }
  });

  selectedMapping.elementsToReset.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) {
      elem.value = '';

    }
  });

  selectedMapping.elementsToEnable.forEach(id => {
    const elem = document.getElementById(id);
    const resetbutton = document.getElementById('resetbutton');
    if (elem) {
      if (resetbutton.style.display == 'none') {
        elem.disabled = false;
      }

      if (id == 'nu') {
        elem.value = studentData['skola_r'];
      }
      if (id == 'ny') {
        elem.value = studentData['program_r'];
      }

    }
  });

  selectedMapping.elementsToDisable.forEach(id => {
    const elem = document.getElementById(id);
    if (elem) { elem.disabled = true; }
  });

}

function dynamicSelects_jq(el) {
  var selected = $(el).find(':selected').data('id');
  var next_combo = $(el).data('nextcombo');

  if (!$(next_combo).length || !$(next_combo).data('store')) {
    if ($(next_combo).length && !$(next_combo).data('store')) {
      $(next_combo).data('store', $(next_combo).find('option'));
    } else {
      return;
    }
  }

  var options2 = $(next_combo).data('store');

  if (options2 && options2.length > 0) {
    $(next_combo).empty().append(
      options2.filter(function () {
        return $(this).data('option') === selected;
      })
    );
    $(next_combo).prop('disabled', false);
  } else {
    $(next_combo).prop('disabled', true);
  }

  var defaultValue = $(next_combo).data('default');
  if (defaultValue) {
    $(next_combo).val(defaultValue);
  }

  if ($(next_combo).data('nextcombo')) {
    dynamicSelects_jq(next_combo);
  }
}

jQuery.fn.dynamicSelect = function () {
  $(document).on('change', '[data-nextcombo]', function () {
    dynamicSelects_jq(this);
  });
};

$(function () {
  $.fn.dynamicSelect();
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
      option.className = "bg-white hover:bg-gray-50";

      let nameCell = document.createElement('td');
      nameCell.className = 'px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900';
      nameCell.textContent = student.name;
      option.appendChild(nameCell);

      let lastnameCell = document.createElement('td');
      lastnameCell.className = 'px-6 py-3 whitespace-nowrap text-sm font-medium text-gray-900';
      lastnameCell.textContent = student.lastname;
      option.appendChild(lastnameCell);

      let emailCell = document.createElement('td');
      emailCell.className = 'text-sm px-6 py-3 whitespace-nowrap text-gray-500';
      emailCell.textContent = student.email;
      option.appendChild(emailCell);

      let moreInfoIndicatorCell = document.createElement('td');
      moreInfoIndicatorCell.className = 'text-sm px-6 py-3 whitespace-nowrap text-gray-500 cursor-pointer more-info-column';
      moreInfoIndicatorCell.textContent = "Viac info...";
      moreInfoIndicatorCell.setAttribute('data-info-visible', 'false');
      option.appendChild(moreInfoIndicatorCell);

      searchResults.appendChild(option);

      let subOption = document.createElement('tr');
      subOption.className = "bg-white hidden";
      let additionalInfoCell = document.createElement('td');
      additionalInfoCell.className = 'text-xs px-4 py-2 text-gray-500';
      additionalInfoCell.setAttribute('colspan', '4');
      additionalInfoCell.innerHTML = `Additional Emails: ${student.sekemail}, Status: ${student.status}, School: ${student.skola}, Study: ${student.studium}, Program: ${student.program}`;
      subOption.appendChild(additionalInfoCell);

      searchResults.appendChild(subOption);

      moreInfoIndicatorCell.addEventListener('click', function () {
        let isInfoVisible = this.getAttribute('data-info-visible') === 'true';
        this.textContent = isInfoVisible ? "Viac info..." : "Menej info...";
        subOption.style.display = isInfoVisible ? 'none' : 'table-row';
        this.setAttribute('data-info-visible', String(!isInfoVisible));
      });

      option.addEventListener('click', function (event) {
        if (event.target !== moreInfoIndicatorCell) {
          if (document.querySelector('input[name="student_id"]')) {
            document.querySelector('input[name="student_id"]').value = student.id;
          }

          document.querySelector('input[name="name"]').value = student.name;
          document.querySelector('input[name="lastname"]').value = student.lastname;
          document.querySelector('input[name="email"]').value = student.email;
          searchResults.innerHTML = '';
        }
      });
    });

  }).catch(error => {

  });
}

if (document.querySelector('input[name="name"]') && document.querySelector('input[name="lastname"]') && document.querySelector('input[name="email"]')) {
  document.querySelector('input[name="name"]').addEventListener('input', debounce(searchStudents, 100));
  document.querySelector('input[name="lastname"]').addEventListener('input', debounce(searchStudents, 100));
  document.querySelector('input[name="email"]').addEventListener('input', debounce(searchStudents, 100));
}

const selectsContainer = document.querySelector('#selects-container');
const addSelectsBtn = document.querySelector('#add-selects-btn');

let pairsCount = 1;

function addSelectsPair() {
  const pairWrapper = document.createElement('div');
  pairWrapper.classList.add('selects-pair', 'flex', 'items-center', 'justify-between', 'mb-4');
  pairWrapper.dataset.pairId = ++pairsCount;

  const academySelect = document.createElement('select');
  academySelect.name = 'academy_id[]';
  academySelect.classList.add('academy-select', 'mt-1', 'flex-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50', 'disabled:bg-gray-100', 'bg-white', 'text-sm', 'leading-5.6');
  academySelect.dataset.pairId = pairsCount;

  const firstAcademySelect = selectsContainer.querySelector('.academy-select');
  if (firstAcademySelect) {
    academySelect.innerHTML = firstAcademySelect.innerHTML;
    academySelect.value = "";
  }

  const coursetypeSelect = document.createElement('select');
  coursetypeSelect.name = 'coursetypes_id[]';
  coursetypeSelect.classList.add('coursetype-select', 'mt-1', 'flex-1', 'block', 'w-full', 'rounded-md', 'border-gray-300', 'shadow-sm', 'focus:border-indigo-300', 'focus:ring', 'focus:ring-indigo-200', 'focus:ring-opacity-50', 'disabled:bg-gray-100', 'bg-white', 'text-sm', 'leading-5.6');
  coursetypeSelect.dataset.pairId = pairsCount;

  const removeBtn = document.createElement('button');
  removeBtn.classList.add('remove-selects-btn', 'ml-2', 'py-2', 'px-4', 'hover:bg-red-700', 'p-2', 'border', 'border-transparent', 'shadow-sm', 'text-sm', 'font-medium', 'rounded-md', 'text-white', 'bg-red-600', 'hover:bg-red-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-red-200');
  removeBtn.setAttribute('type', 'button');
  removeBtn.textContent = 'X';
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
if (
  addSelectsBtn
) {
  addSelectsBtn.addEventListener('click', addSelectsPair);
}

if (selectsContainer) {
  selectsContainer.addEventListener('change', event => {
    const target = event.target;
    if (target.classList.contains('academy-select')) {
      const coursetypeSelect = target.parentNode.querySelector('.coursetype-select');
      if (coursetypeSelect) {
        const academyId = target.value;
      }
    }
  });
}

$(document).ready(function () {

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
    if (coursetypeSelect.disabled == true) {
      coursetypeSelect.disabled = false;
    }
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

});
if (document.querySelector("#coursetype")) {


  const coursetype = document.querySelector("#coursetype");
  const coursetypeOptions = coursetype.querySelectorAll("option");

  $('#selects-container').on('change', '.academy-select', function (event) {
    const pairId = event.target.getAttribute('data-pair-id');
    const academySelect = document.querySelector(`.academy-select[data-pair-id="${pairId}"]`);
    const coursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${pairId}"]`);

    const setValue = function (newValue, targetSelect) {
      targetSelect.innerHTML = '';
      coursetypeOptions.forEach(option => {
        if (option.dataset.option === newValue) {
          targetSelect.appendChild(option.cloneNode(true));
        }
      });
    };

    setValue(academySelect.value, coursetypeSelect);
    document.querySelectorAll('.academy-select').forEach(otherAcademySelect => {
      const otherPairId = otherAcademySelect.getAttribute('data-pair-id');
      if (otherPairId !== pairId && otherAcademySelect.value === academySelect.value) {
        const otherCoursetypeSelect = document.querySelector(`.coursetype-select[data-pair-id="${otherPairId}"]`);
        setValue(academySelect.value, otherCoursetypeSelect);
      }
    });
  });
}
