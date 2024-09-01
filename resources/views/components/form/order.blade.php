@props([
        'request',
        'currentOrder'
    ])

<div>
    <div class="flex justify-end w-full mb-2">
        <div class="flex gap-2 items-center w-[100px]">
            <span>order</span>
            <select id="small" name="order" class="block w-full p-2 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
                @foreach($request as  $table)
                    <option value="{{$table->order}}" @if($currentOrder->order ==  $table->order) selected @endif>{{ $table->order}}</option>
                @endforeach
            </select>                    
        </div>
    </div>
</div>