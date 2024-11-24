<?php
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YouTube Video Player</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>YouTube Video Player</h1>
            <p class="subtitle">Play multiple instances of your favorite videos</p>
        </header>

        <div class="card">
            <form>
                <div class="input-form">
                    <div class="input-group">
                        <label for="videoLink">YouTube Video Link</label>
                        <input type="text" id="videoLink" name="videoLink" placeholder="Paste YouTube URL here">
                    </div>
                    
                    <div class="input-group">
                        <label for="numVideos">Number of Players</label>
                        <input type="number" id="numVideos" name="numVideos" value="5" min="1" max="12">
                    </div>

                    <button type="button" id="playBtn" class="play-button">
                        <span class="button-icon">▶</span>
                        Play Videos
                    </button>
                </div>
            </form>
        </div>

        <div id="videoContainer" class="video-grid"></div>
    </div>

    <!-- Include LazyLoad library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.1.0/lazyload.min.js"></script>
    
    <script>
        function playVideos() {
            var videoLink = document.getElementById("videoLink").value;
            var videoId = getVideoIdFromLink(videoLink);
            var numVideos = document.getElementById("numVideos").value;

            if (videoId) {
                var container = document.getElementById("videoContainer");
                container.innerHTML = "";

                for (var i = 0; i < numVideos; i++) {
                    var wrapper = document.createElement("div");
                    wrapper.className = "video-wrapper";
                    var iframe = document.createElement("iframe");
                    iframe.setAttribute("data-src", "https://www.youtube.com/embed/" + videoId + "?autoplay=1&mute=1&vq=small&quality=small&controls=1&showinfo=0&modestbranding=1");
                    iframe.setAttribute("frameborder", "0");
                    iframe.setAttribute("allow", "autoplay; encrypted-media");
                    iframe.setAttribute("allowfullscreen", "");

                    wrapper.appendChild(iframe);
                    container.appendChild(wrapper);
                }

                // Initialize LazyLoad for the iframes
                new LazyLoad({
                    elements_selector: "iframe",
                    threshold: 0,
                    callback_loaded: function(el) {
                        el.parentNode.classList.remove('is-loading');
                    }
                });

            } else {
                alert("Invalid YouTube video link");
            }
        }

        // Add event listener to Play Videos button
        var playBtn = document.getElementById("playBtn");
        playBtn.addEventListener("click", playVideos);

        function getVideoIdFromLink(link) {
            var videoId = "";
            var match = link.match(/(?:\?v=|\/embed\/)([\w-]{11})(?:\&\S+)?/);
            if (match) {
                videoId = match[1];
            }
            return videoId;
        }
    </script>
</body>
</html> 