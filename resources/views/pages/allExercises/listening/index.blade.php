@extends('layouts.main')
@section('content')
<div>
    <div class="flex flex-col w-full relative">
        <x-form.success/>
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
    @include('includes.exerciseParts.index.orderAllExercise',['route' => 'listening.index','title' => ' Listening audio'])
    <div class="flex gap-4 relative">
        <div class="flex-1 overflow-x-auto overflow-hidden overflow-y-auto">
            <table class="min-w-full text-sm bg-white divide-y-2 divide-gray-200">
                <thead class="ltr:text-left rtl:text-right">
                    <tr>                        
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">id</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">audio</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">chapter</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">lesson</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">exercise</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">order</th>
                        <th class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap">status</th>
                        <th class="px-4 py-2">actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($listenings as $listening)
                        <tr>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$listening->id}}</td>
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
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$listening->Chapter->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$listening->Lesson->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$listening->Exercise->name}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">{{$listening->order}}</td>
                            <td class="px-4 py-2 text-center text-gray-700 whitespace-nowrap">
                                <x-form.status route="listening.active" modelName="listening" :id="$listening->id" :currentStatus="$listening->status"/>
                            </td>
                            <td class="h-full gap-2 px-4 py-2 text-center whitespace-nowrap ">
                                <x-form.edit-delete-exercises :editRoute="route('listening.edit',['listening'=>$listening->id])" :deleteRoute="route('listening.delete', ['listening' => $listening->id])" />                                                              
                            </td>
                        </tr> 
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full absolute top-full mt-2">
            {{$listenings->links()}}
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