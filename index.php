<!DOCTYPE html>
<html>
<head>
	<title>YouTube Videos</title>
	<style>
		.video-wrapper {
			display: inline-block;
			width: 200px;
			height: 200px;
			margin-right: 10px;
			margin-bottom: 10px;
		}
		iframe {
			display: block;
			margin: 0;
			padding: 0;
			border: none;
			width: 100%;
			height: 100%;
		}
	</style>
</head>
<body>
	<h1>YouTube Videos</h1>
	<form>
		<label for="videoLink">Enter a YouTube video link:</label>
		<input type="text" id="videoLink" name="videoLink">
		<label for="numVideos">Enter the number of videos:</label>
		<input type="number" id="numVideos" name="numVideos" value="5">
		<button type="button" id="playBtn">Play Videos</button>
	</form>

	<div id="videoContainer"></div>

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

	<!-- Include LazyLoad library -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.1.0/lazyload.min.js"></script>
</body>
</html>
