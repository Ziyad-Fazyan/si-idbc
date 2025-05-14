<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Absensi Wajah</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --success: #2ecc71;
            --danger: #e74c3c;
            --dark: #2d3748;
            --light: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 500px;
            transition: all 0.3s ease;
        }
        
        h2 {
            color: var(--dark);
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            position: relative;
        }
        
        h2:after {
            content: '';
            position: absolute;
            width: 60px;
            height: 4px;
            background: var(--primary);
            left: 50%;
            transform: translateX(-50%);
            bottom: -10px;
            border-radius: 2px;
        }
        
        .video-container {
            position: relative;
            overflow: hidden;
            border-radius: 12px;
            margin: 20px 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        video, canvas, .camera-overlay {
            width: 100%;
            border-radius: 10px;
            display: block;
        }
        
        .camera-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 3px solid var(--primary);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }
        
        .camera-overlay i {
            font-size: 48px;
            color: white;
            background: rgba(0,0,0,0.5);
            border-radius: 50%;
            width: 80px;
            height: 80px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            animation: fadeIn 0.5s;
        }
        
        .alert i {
            margin-right: 12px;
            font-size: 20px;
        }
        
        .success { 
            background: rgba(46, 204, 113, 0.15); 
            color: #155724; 
            border-left: 4px solid var(--success);
        }
        
        .error { 
            background: rgba(231, 76, 60, 0.15); 
            color: #721c24; 
            border-left: 4px solid var(--danger);
        }
        
        .btn {
            display: block;
            width: 100%;
            padding: 15px;
            border: none;
            background: var(--primary);
            color: white;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .btn:hover {
            background: #304ede;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn i {
            margin-right: 10px;
        }
        
        .btn.disabled {
            background: #a0a0a0;
            cursor: not-allowed;
        }
        
        .status-container {
            text-align: center;
            margin: 15px 0;
            font-size: 16px;
            color: var(--dark);
        }
        
        .loader {
            display: none;
            width: 25px;
            height: 25px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s linear infinite;
            margin-left: 10px;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .countdown {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 100px;
            color: white;
            background: rgba(0,0,0,0.5);
            width: 150px;
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            opacity: 0;
            pointer-events: none;
        }
        
        .flash {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: white;
            opacity: 0;
            pointer-events: none;
        }
        
        .user-info {
            padding: 15px;
            background: rgba(67, 97, 238, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }
        
        .user-info i {
            margin-right: 12px;
            font-size: 24px;
            color: var(--primary);
        }
        
        .preview-container {
            display: none;
            text-align: center;
            margin: 20px 0;
        }
        
        .preview-container img {
            max-width: 100%;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn-secondary {
            background: #e9ecef;
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background: #dee2e6;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        @media (max-width: 500px) {
            .container {
                padding: 20px;
            }
            h2 {
                font-size: 24px;
            }
        }
        
        .time-display {
            text-align: center;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: 600;
            color: var(--dark);
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Sistem Absensi Wajah</h2>

    @if(session('success'))
        <div class="alert success">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div class="alert error">
            <i class="fas fa-exclamation-circle"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif
    
    <div class="time-display">
        <div id="current-date"></div>
        <div id="current-time"></div>
    </div>

    <div id="camera-view">
        <div class="video-container">
            <video id="video" autoplay playsinline></video>
            <div class="camera-overlay">
                <i class="fas fa-camera"></i>
            </div>
            <div class="countdown" id="countdown"></div>
            <div class="flash" id="flash"></div>
        </div>
        
        <div class="status-container" id="status-text">
            Menghubungkan ke kamera...
        </div>
        
        <button type="button" id="captureBtn" class="btn disabled">
            <i class="fas fa-camera"></i> Memuat Kamera...
        </button>
    </div>
    
    <div id="preview-view" class="preview-container">
        <h3>Pratinjau Foto</h3>
        <img id="preview-image" alt="Preview absensi">
        
        <div class="btn-group">
            <button type="button" id="retakeBtn" class="btn btn-secondary">
                <i class="fas fa-redo"></i> Ambil Ulang
            </button>
            <button type="button" id="submitBtn" class="btn">
                <i class="fas fa-check"></i> Kirim Absensi
            </button>
        </div>
    </div>

    <canvas id="canvas" style="display:none;"></canvas>

    <form id="absenForm" method="POST" action="{{ route('officer.absen-wajah-cek') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="foto" id="fotoInput" accept="image/*" style="display: none;">
    </form>
</div>

<script>
    // DOM Elements
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const fotoInput = document.getElementById('fotoInput');
    const captureBtn = document.getElementById('captureBtn');
    const statusText = document.getElementById('status-text');
    const cameraOverlay = document.querySelector('.camera-overlay');
    const countdownEl = document.getElementById('countdown');
    const flashElement = document.getElementById('flash');
    const previewImage = document.getElementById('preview-image');
    const cameraView = document.getElementById('camera-view');
    const previewView = document.getElementById('preview-view');
    const retakeBtn = document.getElementById('retakeBtn');
    const submitBtn = document.getElementById('submitBtn');
    const currentDateEl = document.getElementById('current-date');
    const currentTimeEl = document.getElementById('current-time');
    
    let cameraStream = null;
    
    // Update date and time
    function updateDateTime() {
        const now = new Date();
        
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        currentDateEl.textContent = now.toLocaleDateString('id-ID', dateOptions);
        
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false };
        currentTimeEl.textContent = now.toLocaleTimeString('id-ID', timeOptions);
    }
    
    // Initialize date/time and update every second
    updateDateTime();
    setInterval(updateDateTime, 1000);
    
    // Access camera
    async function initCamera() {
        try {
            const constraints = { 
                video: { 
                    facingMode: "user",
                    width: { ideal: 1280 },
                    height: { ideal: 720 }
                } 
            };
            
            cameraStream = await navigator.mediaDevices.getUserMedia(constraints);
            video.srcObject = cameraStream;
            
            video.onloadedmetadata = () => {
                statusText.textContent = "Kamera siap. Posisikan wajah Anda di tengah layar.";
                captureBtn.classList.remove('disabled');
                captureBtn.innerHTML = '<i class="fas fa-camera"></i> Absen Sekarang';
            };
        } catch (err) {
            statusText.textContent = "Gagal mengakses kamera: " + err.message;
            captureBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Kamera Error';
        }
    }
    
    // Start camera on page load
    initCamera();
    
    // Countdown and capture
    function startCountdown() {
        return new Promise((resolve) => {
            let count = 3;
            captureBtn.classList.add('disabled');
            captureBtn.innerHTML = '<i class="fas fa-spinner"></i> Bersiap...';
            
            countdownEl.textContent = count;
            countdownEl.style.opacity = 1;
            
            const interval = setInterval(() => {
                count--;
                
                if (count <= 0) {
                    clearInterval(interval);
                    countdownEl.style.opacity = 0;
                    
                    // Flash effect
                    flashElement.style.opacity = 1;
                    setTimeout(() => {
                        flashElement.style.opacity = 0;
                        resolve();
                    }, 150);
                } else {
                    countdownEl.textContent = count;
                }
            }, 1000);
        });
    }
    
    // Capture photo
    async function capturePhoto() {
        cameraOverlay.style.opacity = 1;
        
        await startCountdown();
        
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        
        // Draw the video frame to the canvas
        context.drawImage(video, 0, 0, canvas.width, canvas.height);
        
        // Convert canvas to blob and create preview
        canvas.toBlob(function(blob) {
            const file = new File([blob], "capture.jpg", { type: 'image/jpeg' });
            const dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            fotoInput.files = dataTransfer.files;
            
            // Show preview
            const imageUrl = URL.createObjectURL(blob);
            previewImage.src = imageUrl;
            
            // Switch views
            cameraView.style.display = 'none';
            previewView.style.display = 'block';
            
            cameraOverlay.style.opacity = 0;
        }, 'image/jpeg', 0.9);
    }
    
    // Submit the form
    function submitForm() {
        submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Mengirim... <div class="loader" style="display: inline-block;"></div>';
        submitBtn.classList.add('disabled');
        document.getElementById('absenForm').submit();
    }
    
    // Retake photo
    function retakePhoto() {
        // Switch back to camera view
        cameraView.style.display = 'block';
        previewView.style.display = 'none';
        captureBtn.classList.remove('disabled');
        captureBtn.innerHTML = '<i class="fas fa-camera"></i> Absen Sekarang';
    }
    
    // Event listeners
    captureBtn.addEventListener('click', () => {
        if (!captureBtn.classList.contains('disabled')) {
            capturePhoto();
        }
    });
    
    retakeBtn.addEventListener('click', retakePhoto);
    submitBtn.addEventListener('click', submitForm);
    
    // Add event listener to close camera stream when the page is unloaded
    window.addEventListener('beforeunload', () => {
        if (cameraStream) {
            cameraStream.getTracks().forEach(track => track.stop());
        }
    });
</script>
</body>
</html>