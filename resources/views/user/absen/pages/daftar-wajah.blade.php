<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Wajah Mahasiswa</title>
    <style>
        :root {
            --primary: #3498db;
            --success: #2ecc71;
            --error: #e74c3c;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
            margin: 0;
            color: var(--dark);
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            color: var(--primary);
            margin-top: 0;
            text-align: center;
            font-weight: 600;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--dark);
        }

        select,
        button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
            outline: none;
        }

        button {
            background: var(--primary);
            color: white;
            border: none;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background: #2980b9;
        }

        button:disabled {
            background: #95a5a6;
            cursor: not-allowed;
        }

        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .alert i {
            margin-right: 10px;
            font-size: 18px;
        }

        .success {
            background: #d5f5e3;
            color: #27ae60;
            border-left: 4px solid var(--success);
        }

        .error {
            background: #fadbd8;
            color: #c0392b;
            border-left: 4px solid var(--error);
        }

        .camera-container {
            position: relative;
            margin-bottom: 20px;
            border-radius: 10px;
            overflow: hidden;
            background: #000;
        }

        video,
        canvas {
            width: 100%;
            display: block;
            border-radius: 8px;
        }

        .preview-container {
            display: none;
            position: relative;
            margin-top: 20px;
            text-align: center;
        }

        .preview-img {
            max-width: 100%;
            border-radius: 8px;
            border: 2px solid var(--primary);
        }

        .controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }

        .controls button {
            flex: 1;
        }

        .btn-secondary {
            background: #95a5a6;
        }

        .btn-secondary:hover {
            background: #7f8c8d;
        }

        .camera-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            text-align: center;
            padding: 20px;
            font-size: 18px;
            display: none;
        }

        .loading-spinner {
            border: 5px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top: 5px solid white;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
            margin: 0 auto 15px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .face-guide {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 220px;
            height: 270px;
            border: 2px dashed rgba(255, 255, 255, 0.7);
            border-radius: 50% 50% 50% 50% / 60% 60% 40% 40%;
            pointer-events: none;
            z-index: 2;
        }

        .camera-instructions {
            margin-bottom: 15px;
            font-size: 14px;
            color: #555;
            text-align: center;
        }

        .camera-status {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .status-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 8px;
        }

        .status-active {
            background: var(--success);
        }

        .status-inactive {
            background: var(--error);
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Pendaftaran Wajah Mahasiswa</h2>

        @if (session('success'))
            <div class="alert success">
                <i>✓</i> {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert error">
                <i>✕</i> {{ session('error') }}
            </div>
        @endif

        <div class="camera-status">
            <span class="status-indicator status-inactive" id="cameraStatus"></span>
            <span id="cameraStatusText">Menghubungkan ke kamera...</span>
        </div>

        <div class="camera-instructions">
            Pastikan wajah terlihat jelas dan berada dalam area panduan
        </div>

        <div class="camera-container">
            <div class="face-guide"></div>
            <video id="video" autoplay playsinline></video>
            <div class="camera-overlay" id="cameraOverlay">
                <div>
                    <div class="loading-spinner"></div>
                    <div id="overlayMessage">Memproses...</div>
                </div>
            </div>
        </div>

        <canvas id="canvas" style="display:none;"></canvas>

        <div class="preview-container" id="previewContainer">
            <h3>Preview Gambar</h3>
            <img id="previewImage" class="preview-img" alt="Preview wajah mahasiswa">
            <div class="controls">
                <button type="button" class="btn-secondary" id="retakeButton">Ambil Ulang</button>
                <button type="button" id="confirmButton">Konfirmasi & Simpan</button>
            </div>
        </div>

        <form id="formWajah" action="{{ route($prefix . 'absen-wajah') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="mahasiswa">Pilih Mahasiswa</label>
                <select name="mahasiswas_id" id="mahasiswaSelect" required>
                    <option value="">-- Pilih Mahasiswa --</option>
                    @foreach ($mahasiswas as $mhs)
                        <option value="{{ $mhs->id }}">{{ $mhs->mhs_name }} | {{ $mhs->mhs_nim }}</option>
                    @endforeach
                </select>
            </div>

            <input type="file" name="foto" id="fotoInput" accept="image/*" style="display: none;" required>

            <button type="button" id="captureButton" disabled>Ambil Foto Wajah</button>
        </form>
    </div>

    <script>
        // Elements
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const fotoInput = document.getElementById('fotoInput');
        const captureButton = document.getElementById('captureButton');
        const confirmButton = document.getElementById('confirmButton');
        const retakeButton = document.getElementById('retakeButton');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const mahasiswaSelect = document.getElementById('mahasiswaSelect');
        const cameraStatus = document.getElementById('cameraStatus');
        const cameraStatusText = document.getElementById('cameraStatusText');
        const cameraOverlay = document.getElementById('cameraOverlay');
        const overlayMessage = document.getElementById('overlayMessage');

        // Stream variable to store camera stream
        let stream = null;

        // Function to start camera
        async function startCamera() {
            try {
                stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: "user",
                        width: {
                            ideal: 1280
                        },
                        height: {
                            ideal: 720
                        }
                    }
                });

                video.srcObject = stream;

                // Wait for video to be ready
                video.onloadedmetadata = () => {
                    cameraStatus.className = "status-indicator status-active";
                    cameraStatusText.textContent = "Kamera aktif";

                    // Enable capture button if student is selected
                    if (mahasiswaSelect.value) {
                        captureButton.disabled = false;
                    }
                };
            } catch (err) {
                cameraStatus.className = "status-indicator status-inactive";
                cameraStatusText.textContent = "Gagal mengakses kamera: " + err.message;
                console.error("Error accessing camera:", err);
            }
        }

        // Start camera when page loads
        startCamera();

        // Enable/disable capture button based on student selection
        mahasiswaSelect.addEventListener('change', function() {
            captureButton.disabled = !this.value || !stream;
        });

        // Capture photo
        captureButton.addEventListener('click', function() {
            if (!mahasiswaSelect.value) {
                showAlert("Silahkan pilih mahasiswa terlebih dahulu", "error");
                return;
            }

            // Show processing overlay
            cameraOverlay.style.display = "flex";
            overlayMessage.textContent = "Memproses...";

            setTimeout(() => {
                capturePhoto();
                cameraOverlay.style.display = "none";
            }, 1000);
        });

        // Capture photo from video stream
        function capturePhoto() {
            const context = canvas.getContext('2d');

            // Set canvas dimensions to match video
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;

            // Draw video frame to canvas
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Show preview
            previewImage.src = canvas.toDataURL('image/jpeg');
            previewContainer.style.display = "block";
            video.parentElement.style.display = "none";
            captureButton.style.display = "none";
        }

        // Retake photo
        retakeButton.addEventListener('click', function() {
            previewContainer.style.display = "none";
            video.parentElement.style.display = "block";
            captureButton.style.display = "block";
        });

        // Confirm and submit
        confirmButton.addEventListener('click', function() {
            // Show processing overlay
            cameraOverlay.style.display = "flex";
            overlayMessage.textContent = "Menyimpan data...";

            canvas.toBlob(function(blob) {
                const file = new File([blob], "wajah_" + Date.now() + ".jpg", {
                    type: 'image/jpeg'
                });
                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(file);
                fotoInput.files = dataTransfer.files;

                // Submit form
                document.getElementById('formWajah').submit();
            }, 'image/jpeg', 0.9); // 90% quality
        });

        // Function to show alert
        function showAlert(message, type) {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert ${type}`;

            const icon = document.createElement('i');
            icon.textContent = type === 'success' ? '✓' : '✕';

            alertDiv.appendChild(icon);
            alertDiv.appendChild(document.createTextNode(message));

            // Insert at top of container
            const container = document.querySelector('.container');
            container.insertBefore(alertDiv, container.firstChild.nextSibling);

            // Remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }

        // Clean up on page unload
        window.addEventListener('beforeunload', () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        });
    </script>
</body>

</html>
