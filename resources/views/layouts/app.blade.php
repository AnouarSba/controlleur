<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="csrf-token" content="{{csrf_token()}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <title>
        Controlleur
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="./assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="assets/css/argon-dashboard.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

</head>

<body class="{{ $class ?? '' }}">
<!--<div class="row">
	<div class="col-md-6">
		<h2>Preview</h2>
		<video id="preview" width="160" height="120" autoplay muted></video><br/><br/>
		<div class="btn-group">
			<div id="startButton" class="btn btn-success"> Start </div>
			<div id="stopButton" class="btn btn-danger"  style="display:none;"> Stop </div>
		</div>
	</div>
	<div class="col-md-6" id="recorded"  style="display:none">
		<h2>Recording</h2>
		<video id="recording" width="160" height="120" controls></video><br/><br/>
		<a id="downloadButton" class="btn btn-primary" data-url="{{route('videos.store')}}">save</a>
		<a id="downloadLocalButton" class="btn btn-primary">Download</a>
	</div>
</div> -->

    @guest
        @yield('content')
    @endguest

    @auth
        @if (in_array(request()->route()->getName(), ['sign-in-static', 'sign-up-static', 'login', 'register', 'recover-password', 'rtl', 'virtual-reality']))
            @yield('content')
        @else
            @if (!in_array(request()->route()->getName(), ['profile', 'profile-static']))
                <div class="min-height-300 bg-primary position-absolute w-100"></div>
            @elseif (in_array(request()->route()->getName(), ['profile-static', 'profile']))
                <div class="position-absolute w-100 min-height-300 top-0" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
                    <span class="mask bg-primary opacity-6"></span>
                </div>
            @endif
            @include('layouts.navbars.auth.sidenav')
                <main class="main-content border-radius-lg">
                    @yield('content')
                </main>
            @include('components.fixed-plugin')
        @endif
    @endauth

    <!--   Core JS Files   -->
    <script src="
https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js
"></script>
    <script>
    let preview = document.getElementById("preview");
    let recording = document.getElementById("recording");
    let startButton = document.getElementById("startButton");
    let stopButton = document.getElementById("stopButton");
    let downloadButton = document.getElementById("downloadButton");
    let logElement = document.getElementById("log");
    let recorded = document.getElementById("recorded");
    let downloadLocalButton = document.getElementById("downloadLocalButton");

    let recordingTimeMS = 5000; //video limit 5 sec
    var localstream;

    window.log = function (msg) {
    //logElement.innerHTML += msg + "\n";
    console.log(msg);
    }

    window.wait = function (delayInMS) {
    return new Promise(resolve => setTimeout(resolve, delayInMS));
    }

    window.startRecording = function (stream, lengthInMS) {
        let recorder = new MediaRecorder(stream);
        let data = [];

        recorder.ondataavailable = event => data.push(event.data);
        recorder.start();
        log(recorder.state + " for " + (lengthInMS / 1000) + " seconds...");

        let stopped = new Promise((resolve, reject) => {
            recorder.onstop = resolve;
            recorder.onerror = event => reject(event.name);
        });

        let recorded = wait(lengthInMS).then(
            () => recorder.state == "recording" && recorder.stop()
        );

        return Promise.all([
            stopped,
            recorded
            ])
        .then(() => data);
    }

    window.stop = function (stream) {
        stream.getTracks().forEach(track => track.stop());
    }
    var formData = new FormData();
    if (startButton) {
        startButton.addEventListener("click", function () {
            startButton.innerHTML = "recording...";
            recorded.style.display = "none";
            stopButton.style.display = "inline-block";
            downloadButton.innerHTML = "rendering..";
            navigator.mediaDevices.getUserMedia({
                video: false,
                audio: true
            }).then(stream => {
                preview.srcObject = stream;
                localstream = stream;
                //downloadButton.href = stream;
                preview.captureStream = preview.captureStream || preview.mozCaptureStream;
                return new Promise(resolve => preview.onplaying = resolve);
            }).then(() => startRecording(preview.captureStream(), recordingTimeMS))
            .then(recordedChunks => {
                let recordedBlob = new Blob(recordedChunks, {
                type: "video/webm"
                });
                recording.src = URL.createObjectURL(recordedBlob);

                formData.append('_token', document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
                formData.append('video', recordedBlob);

                downloadLocalButton.href = recording.src;
                downloadLocalButton.download = "RecordedVideo.webm";
                log("Successfully recorded " + recordedBlob.size + " bytes of " +
                recordedBlob.type + " media.");
                startButton.innerHTML = "Start";
                stopButton.style.display = "none";
                recorded.style.display = "block";
                downloadButton.innerHTML = "Save";
                localstream.getTracks()[0].stop();
            })
            .catch(log);
        }, false);
    }
    if (downloadButton) {
        downloadButton.addEventListener("click", function () {
            $.ajax({
            url: this.getAttribute('data-url'),
            method: 'POST',
            
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            success: function (res) {
                if(res.success){
                    location.reload();
                }
            }
            });
        }, false);
    }
    if (stopButton) {
        stopButton.addEventListener("click", function () {
            stop(preview.srcObject);
            startButton.innerHTML = "Start";
            stopButton.style.display = "none";
            recorded.style.display = "block";
            downloadButton.innerHTML = "Save";
            localstream.getTracks()[0].stop();
        }, false);
    }
</script>

    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/argon-dashboard.js"></script>
    @stack('js');
</body>

</html>
