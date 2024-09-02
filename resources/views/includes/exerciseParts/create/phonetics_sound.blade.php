
<div class="relative w-full flex">
    <label title="Click to upload" for="{{$label}}" class="cursor-pointer flex items-center gap-4 px-6  before:border-gray-400/60 hover:before:border-gray-300 group before:bg-gray-100 before:absolute before:inset-0 before:rounded-md before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-100 active:duration-75 active:before:scale-95">
        <div class="w-max relative">
            <img class="w-12" src="https://www.svgrepo.com/show/485545/upload-cicle.svg" alt="file upload icon" width="512" height="212">
        </div>
        <div class="relative">
            <span class="block text-base font-semibold relative text-blue-900 group-hover:text-blue-500">
                {{ $title ?? 'Upload sound' }}
            </span>
            <span id="{{$message}}" class="mt-0.5 block text-sm text-blue-900 h-[20px]"></span>
        </div>
        </label>
    <input hidden="" type="file" name="{{$name}}" id="{{$label}}" wire:ignore>
</div>

<script>

    for(let i=1; i<=5; i++){
        document.getElementById(`label${i}`).addEventListener('change', function(event) {
        const file = this.files[0];
        if (!file) {
            document.getElementById(`message${i}`).textContent = 'No file chosen.';
        } else if (file.size === 0) {
            document.getElementById(`message${i}`).textContent = 'The chosen file is empty.';
        } else {
            document.getElementById(`message${i}`).textContent = 'File choosen!';
        }
    });
    }
    
    
    
</script>