<div class="relative w-full flex box-border h-[43px] text-blue-900 hover:text-[var(--bg-color-active)]">
    <label title="Click to upload" for="{{ $uniqueId }}" class="cursor-pointer flex items-center gap-4 px-6 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-sm before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
        <div class="w-max relative">
            {{-- <img class="w-8" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212"> --}}
            <i class='bx bx-user-voice text-[32px] '></i>
        </div>
        <div class="relative">
            <span class="block text-[14px] pt-2 font-semibold relative">
                {{ $title ?? 'Upload sound' }}
            </span>
            <span id="message_{{ $uniqueId }}" class="mt-0.5 block text-sm h-[20px]"></span>
        </div>
    </label>
    <input hidden type="file" name="{{ $name }}" id="{{ $uniqueId }}" wire:ignore>
</div>

<script>
    
document.getElementById('{{ $uniqueId }}').addEventListener('change', function(event) {
    const file = this.files[0];
    const messageElement = document.getElementById('message_{{ $uniqueId }}');
    if (!file) {
        messageElement.textContent = 'No file chosen.';
    } else if (file.size === 0) {
        messageElement.textContent = 'The chosen file is empty.';
    } else {
        messageElement.textContent = 'File chosen!';
    }
});
</script>