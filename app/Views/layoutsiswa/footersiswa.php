<?php if ($title == 'Home' || $title == 'History Absen') :?>

<div class="footer-nav-area" id="footerNav">
      <div class="container px-0">
        <!-- =================================== -->
        <!-- Paste your Footer Content from here -->
        <!-- =================================== -->
        <!-- Footer Content -->
        <div class="footer-nav position-relative">
          <ul class="h-100 d-flex align-items-center justify-content-between ps-0">
            <li <?php echo ($title == 'Home') ? 'class="active"' : ''; ?>><a href="<?=base_url('siswa/home')?>">
                <svg class="bi bi-house" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"></path>
                  <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"></path>
                </svg><span>Home</span></a></li>
            <li <?php echo ($title == 'History Absen') ? 'class="active"' : ''; ?>><a href="<?=base_url('siswa/historyabsen')?>">
                <svg class="bi bi-collection" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M14.5 13.5h-13A.5.5 0 0 1 1 13V6a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-.5.5zm-13 1A1.5 1.5 0 0 1 0 13V6a1.5 1.5 0 0 1 1.5-1.5h13A1.5 1.5 0 0 1 16 6v7a1.5 1.5 0 0 1-1.5 1.5h-13zM2 3a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 0-1h-11A.5.5 0 0 0 2 3zm2-2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 0-1h-7A.5.5 0 0 0 4 1z"></path>
                </svg><span>History Absen</span></a></li>
            <li><a href="" data-bs-toggle="offcanvas" data-bs-target="#affanOffcanvas" aria-controls="affanOffcanvas">
                <svg class="bi bi-gear" width="20" height="20" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
                  <path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
                </svg><span>Settings</span></a></li>
          </ul>
        </div>
      </div>
</div>

<?php endif; ?>

    <script src="<?=base_url('js/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('js/slideToggle.min.js')?>"></script>
    <script src="<?=base_url('js/internet-status.js')?>"></script>
    <script src="<?=base_url('js/tiny-slider.js')?>"></script>
    <script src="<?=base_url('js/baguetteBox.min.js')?>"></script>
    <script src="<?=base_url('js/countdown.js')?>"></script>
    <script src="<?=base_url('js/rangeslider.min.js')?>"></script>
    <script src="<?=base_url('js/vanilla-dataTables.min.js')?>"></script>
    <script src="<?=base_url('js/index.js')?>"></script>
    <script src="<?=base_url('js/magic-grid.min.js')?>"></script>
    <script src="<?=base_url('js/dark-rtl.js')?>"></script>
    <script src="<?=base_url('js/active.js')?>"></script>
    <!-- PWA -->
    <script src="<?=base_url('js/pwa.js')?>"></script>

    <script>
        window.onload = function() {
            getLocation();
        };

        var x = document.getElementById("lat");
        var y = document.getElementById("long");
        var m = document.getElementById("map");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else {
                x.value = "Browser ini tidak mendukung Geolocation.";
                y.value = "Geolocation is not supported by this browser.";
            }
        }

        function showPosition(position) {
            x.value = position.coords.latitude;
            y.value = position.coords.longitude;
        }
    </script>

    <script>
      function getOS() {
      var userAgent = window.navigator.userAgent,
      //platform = window.navigator?.userAgentData?.platform ?? window.navigator.platform,
      platform = navigator.platform,
      macosPlatforms = ['Macintosh', 'MacIntel', 'MacPPC', 'Mac68K'],
      windowsPlatforms = ['Win32', 'Win64', 'Windows', 'WinCE'],
      iosPlatforms = ['iPhone', 'iPad', 'iPod'],
      os = null;

      if (macosPlatforms.indexOf(platform) !== -1) {
        os = 1; //Mac OS
      } else if (iosPlatforms.indexOf(platform) !== -1) {
        os = 2; //iOS
      } else if (windowsPlatforms.indexOf(platform) !== -1) {
        os = 3; //Windows
      } else if (/Android/.test(userAgent)) {
        os = 4; //Android
      } else if (!os && /Linux/.test(platform)) {
        os = 5; //Linux
      }

      return os;
      }

      // if((getOS() != 2) && (getOS() != 4)){
      //   alert("Aplikasi Hanya bisa di akses pada Android dan iOS!");
      //   window.location.replace("<?=base_url()?>");
      // }

      document.getElementById("foto").onchange = function() {funcSetName()};

      function funcSetName() {
        var x = document.getElementById("nf");
        x.value = document.getElementById("foto").files[0].name;
      }
    </script>