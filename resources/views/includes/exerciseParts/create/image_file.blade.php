<div class="relative w-full">
    <label title="Click to upload" for="{{ $label ?? 'fileImage'}}" class="flex items-center gap-4 px-6 py-2 cursor-pointer before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
        <div class="relative w-max">
            <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
        </div>
        <div class="relative">
            <span class="relative block text-base font-semibold text-blue-900 group-hover:text-blue-500">
                {{  $title ?? 'Upload image' }}
            </span>
            <span id="{{ $message ?? 'imageMessage' }}" class="mt-0.5 block text-sm text-blue-900 h-[20px]"></span>
        </div>
        </label>
    <input hidden="" type="file" name="{{ $name ?? 'image'}}" id="{{ $label ?? 'fileImage'}}">
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