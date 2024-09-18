import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();



// tinymce for textarea
tinymce.init({
    selector: 'textarea.letter',
    plugins: "emoticons autoresize",
    toolbar: "emoticons",
    height: 300,  // Set the initial height of the editor
    max_height: 320,  // Restrict the maximum height (requires autoresize plugin)
    autoresize_min_height: 300,  // Minimum height with autoresize
    autoresize_max_height: 320,  // Maximum height with autoresize
    setup: function (editor) {
        editor.on('change', function () {
          tinymce.triggerSave(); // This will sync the editor content with the underlying textarea
        });
    }
});


// CONFIRM DELETE
function disableButton() {
    document.getElementById('submitBtn').disabled = true;
}

// for play and stop audio
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


    // side-bar scroll to view

document.addEventListener('DOMContentLoaded', function() {
    // Add click event listener to all links in the list
    const links = document.querySelectorAll('ul li a');
    links.forEach(function(link) {
        link.addEventListener('click', function(e) {
            // Save the clicked link's parent ID in localStorage
            localStorage.setItem('scrollToLink', this.parentElement.id);
        });
    });

    // Scroll to the saved link after page refresh
    const scrollToLink = localStorage.getItem('scrollToLink');
    if (scrollToLink) {
        const targetElement = document.getElementById(scrollToLink);
        if (targetElement) {
            targetElement.scrollIntoView({ behavior: 'smooth', block: 'center' });

        }
        // Clear the saved scrollToLink from localStorage
        localStorage.removeItem('scrollToLink');
    }
});