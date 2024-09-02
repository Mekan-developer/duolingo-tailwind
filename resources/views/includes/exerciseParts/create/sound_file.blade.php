<div class="relative w-full">
    <label title="Click to upload" for="sound" class="cursor-pointer flex items-center gap-4 px-6 py-2 before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
        <div class="w-max relative">
            <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
        </div>
        <div class="relative">
            <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                {{ $title ?? 'Upload sound' }}
            </span>
            <span id="sound_message" class="mt-0.5 block text-sm text-blue-900 h-[20px]"></span>
        </div>
        </label>
    <input hidden="" type="file" name="audio" id="sound" wire:ignore>
</div>

<script>
    document.getElementById('sound').addEventListener('change', function(event) {
        const file = this.files[0];
        if (!file) {
            document.getElementById('sound_message').textContent = 'No file chosen.';
        } else if (file.size === 0) {
            document.getElementById('sound_message').textContent = 'The chosen file is empty.';
        } else {
            document.getElementById('sound_message').textContent = 'File choosen!';
        }
    });
</script>