<div>
    
    @if(auth()->user()->role == 1)
        @props([
            'route','modelName', 'dataId','confirmText'
        ])

        @php
            $formId = 'form-' . $dataId; // Unique form ID based on the dataId
        @endphp
        <form id="{{$formId}}" action="{{ route($route,  $dataId)}}" 
            method="post" class="flex items-center justify-center">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="confirmSave(event,'{{$formId}}')" class="flex p-2.5 rounded-xl transition-all duration-300 text-red-600">
                <i class='text-[24px] bx bx-trash'></i>
            </button>
        </form>
        <script>
            var text = @json($confirmText);
            function confirmSave(event,formId) {
                event.preventDefault();
                var result = confirm(text);
                if (result) { document.getElementById(formId).submit(); }
            }
        </script>
    @endif  
</div>