@extends('layouts.main')
@section('content')
<div>
    <div class="flex flex-col w-full">
        <div class="flex flex-row justify-between w-full">
            <div class="m-4 text-[var(--bg-color-active)] font-bold text-[22px]">
                Listening audio
            </div>
            <div>
                <div class="flex flex-row-reverse">
                    <a href="{{route('listening.create')}}" class="text-white bg-[var(--bg-color-active)] hover:bg-[#46b8c0] focus:ring-4 font-medium rounded-sm px-4 py-2 me-2 mb-2">+</a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex gap-4">
        <div class="overflow-x-auto flex-1" >
            <table class="min-w-full divide-y-2 divide-gray-200 bg-white text-sm">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">id</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">audio</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">chapter</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">lesson</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">exercise</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">order</th>
                        <th class="whitespace-nowrap px-4 py-2 font-medium text-gray-900">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($listenings as $listening)
                        <tr>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->id}}</td>
                            <td  class="px-6 py-4 ">
                                <div data-audio-src="{{ $listening->getAudio() }}" class="p-1 text-white rounded-lg shadow-lg audio-player w-[200px]" >
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
                            </td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->Chapter->translate('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->Lesson->translate('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->Exercise->translate('title',$locales[0]['locale'])}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->order}}</td>
                            <td class="text-center whitespace-nowrap px-4 py-2 text-gray-700">{{$listening->status}}</td>
                            <td class="gap-2 text-center whitespace-nowrap px-4 py-2 h-full ">
                                <div class="h-full flex flex-row justify-center gap-2">
                                    <a href="{{route('listening.edit',['listening'=>$listening->id])}}">
                                        <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-[text-color-active] ">
                                            <i class='bx bx-edit-alt text-[22px]'></i>
                                        </button>
                                    </a>
                                    </form>
                                    @if(auth()->user()->role == 1)
                                    <form action="{{ route('listening.delete', ['listening' => $listening->id])}}" 
                                        method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="flex p-2.5 rounded-xl transition-all duration-300 text-red-600">
                                            <i class='text-[24px] bx bx-trash'></i>
                                        </button>
                                    </form>
                                @endif  
                                </div>                                                               
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

<script>
    const audioPlayersRunning = [];
    document.addEventListener("DOMContentLoaded", function() {
    const audioPlayers = document.querySelectorAll('.audio-player');

    audioPlayers.forEach(player => {
        const playPauseBtn = player.querySelector('.playPauseBtn');
        const playIcon = player.querySelector('.playIcon');
        const pauseIcon = player.querySelector('.pauseIcon');
        const progressBar = player.querySelector('.progressBar');
        const currentTimeElement = player.querySelector('.currentTime');
        const durationElement = player.querySelector('.duration');
        let audio = null;

        playPauseBtn.addEventListener('click', function() {
            if (!audio) {
                // Create a new Audio object and load the source
                const audioSrc = player.getAttribute('data-audio-src');
                audio = new Audio(audioSrc);
                audioPlayersRunning.push(audio);

                // Update the duration when metadata is loaded
                audio.addEventListener('loadedmetadata', function() {
                    durationElement.textContent = formatTime(audio.duration);
                    progressBar.max = Math.floor(audio.duration);
                });

                // Update the progress bar and current time while playing
                audio.addEventListener('timeupdate', function() {
                    progressBar.value = Math.floor(audio.currentTime);
                    currentTimeElement.textContent = formatTime(audio.currentTime);
                });

                // Reset icons when the audio ends
                audio.addEventListener('ended', function() {
                    playIcon.classList.remove('hidden');
                    pauseIcon.classList.add('hidden');
                });
            }

            // Toggle play/pause
            if (audio.paused) {
                // Pause all other audios before playing the new one
                audioPlayersRunning.forEach(otherAudio => {
                    if (otherAudio !== audio) {
                        otherAudio.pause();
                        // Update the icons for all other players to show the play button
                        const otherPlayer = document.querySelector(`.audio-player[data-audio-src="${otherAudio.src}"]`);
                        if (otherPlayer) {
                            otherPlayer.querySelector('.playIcon').classList.remove('hidden');
                            otherPlayer.querySelector('.pauseIcon').classList.add('hidden');
                        }
                    }
                });
                audio.play();
                playIcon.classList.add('hidden');
                pauseIcon.classList.remove('hidden');
            } else {
                audio.pause();
                playIcon.classList.remove('hidden');
                pauseIcon.classList.add('hidden');
            }
        });

        // Helper function to format time in mm:ss
            function formatTime(seconds) {
                const minutes = Math.floor(seconds / 60);
                const secs = Math.floor(seconds % 60);
                return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
            }
        });
    });

</script>
@endsection