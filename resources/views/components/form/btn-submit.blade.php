<div class="flex-1">
    <style>
        #submitBtn:active {
            transform: scale(0.95); /* Reduce size when pressed */
        }
    </style>
    @props(['name'])
    <button type="submit" 
    {{ $attributes->merge(['class' => 'w-full py-[14px] bg-[var(--bg-color-active)] rounded-sm text-white text-[18px] ']) }}
    id="submitBtn"> @if(isset($name)){{$name}} @else save @endif </button>
</div>

<script>
    function disableButton() {
        document.getElementById('submitBtn').disabled = true;
    }
</script>