// Include LazyLoad library
<script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-lazyload/17.1.0/lazyload.min.js"></script>

class VideoPlayer {
  constructor() {
      this.playBtn = document.getElementById('playBtn');
      this.videoContainer = document.getElementById('videoContainer');
      this.init();
  }

  init() {
      if (this.playBtn) {
          this.playBtn.onclick = () => this.playVideos();
      } else {
          console.error('Play button not found');
      }
  }

  getVideoIdFromLink(link) {
      if (!link) return null;
      const patterns = [
          /(?:\?v=|\/embed\/|\/watch\?v=|youtu\.be\/)([\w-]{11})(?:\&\S+)?/,
          /^([\w-]{11})$/
      ];

      for (let pattern of patterns) {
          const match = link.match(pattern);
          if (match) return match[1];
      }
      return null;
  }

  playVideos() {
      const videoLink = document.getElementById('videoLink').value;
      const videoId = this.getVideoIdFromLink(videoLink);
      const numVideos = parseInt(document.getElementById('numVideos').value);

      if (!videoId) {
          this.showError('Please enter a valid YouTube video link');
          return;
      }

      if (numVideos < 1 || numVideos > 12) {
          this.showError('Please enter a number between 1 and 12');
          return;
      }

      this.createVideoPlayers(videoId, numVideos);
  }

  createVideoPlayers(videoId, numVideos) {
      this.videoContainer.innerHTML = '';

      for (let i = 0; i < numVideos; i++) {
          const wrapper = document.createElement('div');
          wrapper.className = 'video-wrapper';
          
          const iframe = document.createElement('iframe');
          const src = `https://www.youtube.com/embed/${videoId}?autoplay=1&mute=1`;
          iframe.src = src;
          iframe.allow = 'autoplay; encrypted-media';
          iframe.allowFullscreen = true;

          wrapper.appendChild(iframe);
          this.videoContainer.appendChild(wrapper);
      }
  }

  showError(message) {
      alert(message);
  }
}

// Initialize when DOM is ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => new VideoPlayer());
} else {
    new VideoPlayer();
} 