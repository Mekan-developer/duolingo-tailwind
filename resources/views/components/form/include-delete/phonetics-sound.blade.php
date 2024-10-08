<div>
    @props([
        'uniqueId', 'name'
    ])
    <div class="relative w-full flex box-border h-[43px] text-blue-900 hover:text-[var(--bg-color-active)]">
        <label title="Click to upload" for="input_{{ $uniqueId }}" class="flex items-center gap-4 px-6 cursor-pointer before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-sm before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
            <div class="relative w-max">
                <i class='bx bx-user-voice text-[32px]'></i>
            </div>
            <div class="relative">
                <span class="block text-[14px] font-semibold relative">
                    {{ $title ?? 'Upload sound' }} 
                </span>
                <span id="message_{{ $uniqueId }}" class="-mt-1 block text-sm h-[20px]"></span>
            </div>
        </label>
        <input hidden type="file" class="myHiddenInput" name="{{ $name }}" id="input_{{ $uniqueId }}">
    </div>    
</div>

<script>
    function initializeFileInput(uniqueId) {
        const inputElement = document.getElementById('input_' + uniqueId);
        const messageElement = document.getElementById('message_' + uniqueId);

        if (inputElement) {
            inputElement.addEventListener('change', function(event) {
                const file = this.files[0];
                if (!file) {
                    messageElement.textContent = 'No file chosen.';
                } else if (file.size === 0) {
                    messageElement.textContent = 'The chosen file is empty.';
                } else {
                    messageElement.textContent = 'File chosen!';
                }
            });
        }
    }

    // Initialize inputs on initial load
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.myHiddenInput').forEach(function (input) {
            const uniqueId = input.id.split('_')[1]; // Extract the uniqueId from the input ID
            initializeFileInput(uniqueId);
        });
    });

    // Reinitialize inputs when Livewire components are updated
    Livewire.hook('message.processed', (message, component) => {
        document.querySelectorAll('.myHiddenInput').forEach(function (input) {
            const uniqueId = input.id.split('_')[1]; // Extract the uniqueId from the input ID
            initializeFileInput(uniqueId);
        });
    });
</script>