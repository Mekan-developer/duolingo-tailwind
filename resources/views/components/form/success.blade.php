<div>
    @if(session('success'))
        <div id="myDiv" class="w-full h-auto absolute top-2 right-0">
            <div class="w-full bg-[#639e6bd8] text-white font-bold py-4 px-4 rounded-sm text-center">{{ session('success') }}</div>
        </div>
    @endif

    <script>
    
        function showDiv() {
            var div = document.getElementById("myDiv");
            div.style.display = "block";  // Show the div
            setTimeout(function() {
                div.style.display = "none";  // Hide the div after 5 seconds
            }, 5000);  // 5000 milliseconds = 5 seconds
        }
        window.onload = showDiv;
    </script>
</div>