<div class="w-full mt-4" wire:ignore>
    <div class="relative w-full text-blue-900 hover:text-[var(--bg-color-active)]">
        <label title="Click to upload" for="{{ $label ?? 'fileImage'}}" class="flex items-center gap-4 px-6 py-2 cursor-pointer before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-sm before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
            <div class="relative w-max">
                <i class='bx bx-image-add text-[32px]' ></i>
            </div>
            <div class="relative">
                <span class="relative block text-base font-semibold ">
                    {{  $title ?? 'Upload image' }}
                </span>
                <span id="{{ $message ?? 'imageMessage' }}" class="mt-0.5 block text-sm h-[20px]"></span>
            </div>
            </label>
        <input accept="image/png, image/jpeg, image/webp, image/jpg" hidden="" type="file" name="{{ $name ?? 'image'}}" id="{{ $label ?? 'fileImage'}}" >
    </div>
    <div>
        @error($name ?? 'image')
            <span class="text-xs text-red-600">{{ $message }}</span>
        @enderror
    </div>
</div>

<script>
      // Ensure this script runs after the DOM is fully loaded
      document.addEventListener('DOMContentLoaded', function() {
        const labelId = '{{ $label ?? 'fileImage' }}';
        const messageId = '{{ $message ?? 'imageMessage' }}';

        const fileInput = document.getElementById(labelId);
        const messageElement = document.getElementById(messageId);

        if (fileInput && messageElement) {
            fileInput.addEventListener('change', function(event) {
                const file = this.files[0];
                if (!file) {
                    messageElement.textContent = 'No file chosen.';
                } else if (file.size === 0) {
                    messageElement.textContent = 'The chosen file is empty.';
                } else {
                    messageElement.textContent = 'File chosen!';
                }
            });
        } else {
            console.error(`Element with ID ${labelId} or ${messageId} not found.`);
        }
    });
</script>