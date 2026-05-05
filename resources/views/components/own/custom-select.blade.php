@props([
    'name' => '',
    'options' => [],
    'selected' => null,
    'placeholder' => 'Seleccionar',
    'formAction' => null,
    'formMethod' => 'GET',
])

<style>
.custom-select-container {
  position: relative;
  display: inline-block;
  width: 100%;
}

.custom-select-button {
  cursor: pointer;
  background-image: url('/storage/texturas/selectBackground2.png');
  /* background-color: white; */
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background-position: center;
  background-blend-mode: overlay;
  color: #1f2937;
  padding: 0.75rem;
  padding-right: 30px;
  /* border: 1px solid #e5e7eb; */
  border-radius: 0.5rem;
  display: flex;
  justify-content: space-between;
  align-items: center;
  user-select: none;
  transition: all 0.2s ease;
}

.custom-select-button:hover {
  background-color: rgba(0,0,0,0.1);
}

.custom-select-button.active {
  border-radius: 0.5rem 0.5rem 0 0;
  /* background-color: #f8f9fa; */
  background-color: rgba(0,0,0,0.2);
}

.custom-select-dropdown {
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  /* background-color: white; */
  /* border: 1px solid #e5e7eb; bordes derecho e izquierdo del select desplegable */
  /* border-top: none; */
  /* border-bottom: none; */
  border-radius: 0 0 0.5rem 0.5rem;
  max-height: 0;
  overflow:hidden;
  transition: max-height 0.3s ease;
  z-index: 10;
  /* box-shadow: 0 4px 6px rgba(250, 242, 10, 0.5); */
}

  .custom-select-dropdown.show {
    /* padding-bottom: 20px; */
    max-height: 370px;
    overflow-y: auto;
  }

  .custom-select-dropdown.show::-webkit-scrollbar {
    /* background-color: rgb(125, 125, 0); */
    display: none;
  }
  
  .custom-select-dropdown-bg {
  padding-bottom: 100px;
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-image: url('/storage/texturas/desplegableBackground.png');
  background-size: 270px 490px;
  /* background-size:cover; */
  background-repeat: no-repeat;
  background-position: center;
  /* background-attachment: scroll; */
  z-index: -1;
  pointer-events: none;
}

.custom-select-option {
  padding: 0.75rem;
  box-shadow: inset 0 2px 0 0 gray;
  cursor: pointer;
  transition: background-color 0.15s ease;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.custom-select-option:last-child {
  margin-bottom: 60px; 
}

.custom-select-option:hover {
  background: linear-gradient(to top, rgba(255, 251, 235, 0), rgba(255, 251, 235, 1));
}

.custom-select-option.selected {
  background-color: #fef3c7;
  font-weight: 500;
  color: #92400e;
}

.dark .custom-select-button {
  background-color: #374151;
  color: #f3f4f6;
  border-color: #4b5563;
}

.dark .custom-select-button:hover {
  background-color: #4b5563;
}

.dark .custom-select-dropdown {
  background-color: #374151;
  border-color: #4b5563;
}

.dark .custom-select-option:hover {
  background-color: #1e3a8a;
}

.dark .custom-select-option.selected {
  background-color: #1e3a8a;
  color: #bfdbfe;
}

.select-arrow {
  transition: transform 0.2s ease;
  font-size: 16px;
}

.select-arrow.rotated {
  transform: rotate(180deg);
}
</style>

<div class="custom-select-container" data-select-name="{{ $name }}">
  <button 
    type="button" 
    class="custom-select-button w-full shadow-inner"
    onclick="toggleDropdown(event)"
  >
    <span class="selected-text">
      @if($selected && isset($options[$selected]))
        {{ $options[$selected] }}
      @else
        {{ $placeholder }}
      @endif
    </span>
    <span class="select-arrow">▼</span>
  </button>

  <div class="custom-select-dropdown">
    <div class="custom-select-dropdown-bg"></div>
    @foreach($options as $value => $label)
      <div 
        class="custom-select-option @if($value == $selected) selected @endif"
        onclick="selectOption('{{ $value }}', '{{ $name }}')"
        data-value="{{ $value }}"
      >
        <span>{{ $label }}</span>
        @if($value == $selected)
          <span>✓</span>
        @endif
      </div>
    @endforeach
  </div>

  <!-- Input oculto para enviar el valor -->
  <input type="hidden" name="{{ $name }}" value="{{ $selected ?? '' }}">
</div>

<script>
  function toggleDropdown(event) {
    event.preventDefault();
    const container = event.target.closest('.custom-select-container');
    const dropdown = container.querySelector('.custom-select-dropdown');
    const button = container.querySelector('.custom-select-button');
    const arrow = button.querySelector('.select-arrow');

    dropdown.classList.toggle('show');
    button.classList.toggle('active');
    arrow.classList.toggle('rotated');
  }

  function selectOption(value, selectName) {
    const container = document.querySelector(`[data-select-name="${selectName}"]`);
    const hiddenInput = container.querySelector(`input[name="${selectName}"]`);
    const selectedText = container.querySelector('.selected-text');
    const options = container.querySelectorAll('.custom-select-option');
    const dropdown = container.querySelector('.custom-select-dropdown');
    const button = container.querySelector('.custom-select-button');
    const arrow = button.querySelector('.select-arrow');

    // Actualizar valor oculto
    hiddenInput.value = value;

    // Actualizar UI
    options.forEach(opt => {
      opt.classList.remove('selected');
      const checkmark = opt.querySelector('span:last-child');
      if (checkmark && checkmark.textContent === '✓') {
        checkmark.remove();
      }
    });

    const selectedOpt = container.querySelector(`.custom-select-option[data-value="${value}"]`);
    selectedOpt.classList.add('selected');
    const checkmark = document.createElement('span');
    checkmark.textContent = '✓';
    selectedOpt.appendChild(checkmark);

    // Actualizar texto visible
    selectedText.textContent = selectedOpt.querySelector('span:first-child').textContent;

    // Cerrar dropdown
    dropdown.classList.remove('show');
    button.classList.remove('active');
    arrow.classList.remove('rotated');

    // Enviar formulario
    const form = container.closest('form');
    if (form) {
      form.submit();
    }
  }

  // Cerrar dropdown al hacer clic fuera
  document.addEventListener('click', function(event) {
    const containers = document.querySelectorAll('.custom-select-container');
    containers.forEach(container => {
      if (!container.contains(event.target)) {
        const dropdown = container.querySelector('.custom-select-dropdown');
        const button = container.querySelector('.custom-select-button');
        const arrow = button.querySelector('.select-arrow');
        dropdown.classList.remove('show');
        button.classList.remove('active');
        arrow.classList.remove('rotated');
      }
    });
  });
</script>
