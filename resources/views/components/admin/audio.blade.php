<div class="flex justify-center items-center">
    @props([
        "getAudio"
        ])
    @if($getAudio)
        <div data-audio-src="{{ $getAudio }}" class=" p-1 text-white rounded-lg shadow-lg audio-player w-[200px]" >
            <div class="flex flex-row items-center justify-between pl-1">
                    <div class="flex items-center justify-center p-3 text-gray-800 bg-cover rounded-sm playPauseBtn hover:text-[var(--bg-color-active)] focus:outline-none">
                        <span class="hidden pauseIcon">
                            <i class='bx bx-pause text-[28px]'></i>
                        </span> 
                        <span class="playIcon">
                            <i class='bx bx-play-circle text-[28px] opacity-60'></i>
                        </span>
                    </div>
                <div class="items-start flex-1 pl-4">
                    <p class="text-sm text-gray-400 text-nowrap">test</p>
                    <div class="relative text-gray-400">
                        <input type="range" min="0" max="100" value="0" class="w-full h-2 bg-gray-400 rounded-lg appearance-none cursor-pointer progressBar">
                        <span class="currentTime">00:00</span> / <span class="duration">00:00</span> 
                    </div>
                </div>
            </div>
        </div>
    @else  
        <span class="flex justify-center text-[24px] text-bold">-----</span>
    @endif
</div>