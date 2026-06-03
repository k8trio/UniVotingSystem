<x-layout :guest="true">
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; background: linear-gradient(135deg, rgba(200,160,70,0.1) 0%, rgba(200,160,70,0.05) 100%);">
        <div class="login-card" style="max-width: 600px;">

            <div class="login-seal" style="margin-bottom: 1.5rem;">
                <i class="bi bi-camera-fill" style="font-size: 3rem;"></i>
            </div>

            <div class="login-title cinzel" style="margin-bottom: 0.5rem;">
                Scan Verification Code
            </div>

            <div class="login-sub" style="margin-bottom: 2rem;">
                Use your camera to scan the QR code from the voter's screen
            </div>

            <!-- Camera Feed -->
            <div id="scannerContainer" style="
                background: #000;
                border-radius: 8px;
                overflow: hidden;
                margin-bottom: 1.5rem;
                position: relative;
                aspect-ratio: 4/3;
            ">
                <video id="cameraFeed" style="
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    display: none;
                "></video>

                <canvas id="canvas" style="
                    width: 100%;
                    height: 100%;
                    display: none;
                "></canvas>

                <!-- Scanning Overlay -->
                <div id="scanningOverlay" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                ">
                    <div style="
                        width: 250px;
                        height: 250px;
                        border: 3px solid var(--gold);
                        border-radius: 8px;
                        box-shadow: inset 0 0 20px rgba(200,160,70,0.3);
                        position: relative;
                    ">
                        <!-- Corner indicators -->
                        <div style="position: absolute; top: -8px; left: -8px; width: 30px; height: 30px; border-top: 3px solid var(--gold); border-left: 3px solid var(--gold);"></div>
                        <div style="position: absolute; top: -8px; right: -8px; width: 30px; height: 30px; border-top: 3px solid var(--gold); border-right: 3px solid var(--gold);"></div>
                        <div style="position: absolute; bottom: -8px; left: -8px; width: 30px; height: 30px; border-bottom: 3px solid var(--gold); border-left: 3px solid var(--gold);"></div>
                        <div style="position: absolute; bottom: -8px; right: -8px; width: 30px; height: 30px; border-bottom: 3px solid var(--gold); border-right: 3px solid var(--gold);"></div>
                    </div>
                </div>

                <!-- Loading State -->
                <div id="cameraLoading" style="
                    position: absolute;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0,0,0,0.8);
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    color: white;
                ">
                    <div style="
                        width: 40px;
                        height: 40px;
                        border: 3px solid var(--gold);
                        border-top: 3px solid transparent;
                        border-radius: 50%;
                        animation: spin 1s linear infinite;
                        margin-bottom: 1rem;
                    "></div>
                    <p>Initializing camera...</p>
                </div>
            </div>

            <!-- Status Messages -->
            <div id="successMessage" style="
                background: rgba(144, 255, 204, 0.1);
                border: 1px solid #90ffcc;
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                display: none;
                margin-bottom: 1rem;
            ">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                    <i class="bi bi-check-circle-fill" style="color: #90ffcc;"></i>
                </div>
                <div style="color: #90ffcc; font-weight: 500;">
                    Verification Successful!
                </div>
                <p id="successText" style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.5rem;"></p>
            </div>

            <div id="errorMessage" style="
                background: rgba(255, 170, 170, 0.1);
                border: 1px solid #ffaaaa;
                padding: 1rem;
                border-radius: 8px;
                text-align: center;
                display: none;
                margin-bottom: 1rem;
                color: #ffaaaa;
                font-size: 0.9rem;
            "></div>

            <!-- Controls -->
            <div style="display: flex; gap: 1rem;">
                <button onclick="startScanning()" class="btn-gold" style="flex: 1; display: none;" id="startBtn">
                    <i class="bi bi-play-fill me-2"></i>
                    Start Scanning
                </button>
                <button onclick="stopScanning()" class="btn-outline-gold" style="flex: 1;">
                    <i class="bi bi-stop-fill me-2"></i>
                    Cancel
                </button>
            </div>

            <p style="text-align: center; font-size: 0.85rem; color: var(--text-muted); margin-top: 1rem;">
                <i class="bi bi-info-circle me-1"></i>
                Position the QR code within the frame to scan
            </p>

        </div>
    </div>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <!-- Load jsQR library -->
    <script src="https://cdn.jsdelivr.net/npm/jsqr@1.4.0/dist/jsQR.js"></script>

    <script>
        let video = null;
        let canvas = null;
        let canvasContext = null;
        let isScanning = false;
        let scanningInterval = null;

        document.addEventListener('DOMContentLoaded', function () {
            video = document.getElementById('cameraFeed');
            canvas = document.getElementById('canvas');
            canvasContext = canvas.getContext('2d');
            
            startScanning();
        });

        async function startScanning() {
            try {
                const stream = await navigator.mediaDevices.getUserMedia({
                    video: {
                        facingMode: 'environment',
                        width: { ideal: 1280 },
                        height: { ideal: 720 }
                    },
                    audio: false
                });

                video.srcObject = stream;
                video.style.display = 'block';
                
                video.onloadedmetadata = function () {
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    document.getElementById('cameraLoading').style.display = 'none';
                    document.getElementById('scanningOverlay').style.display = 'flex';
                    isScanning = true;
                    scanQRCode();
                };

                document.getElementById('startBtn').style.display = 'none';
            } catch (error) {
                showError('Camera access denied. Please allow camera access to scan QR codes.');
                document.getElementById('startBtn').style.display = 'block';
            }
        }

        function stopScanning() {
            isScanning = false;
            if (scanningInterval) clearInterval(scanningInterval);
            if (video && video.srcObject) {
                video.srcObject.getTracks().forEach(track => track.stop());
            }
            window.location.href = '/qr-verification';
        }

        function scanQRCode() {
            if (!isScanning) return;

            // Draw current video frame to canvas
            canvasContext.drawImage(video, 0, 0, canvas.width, canvas.height);
            const imageData = canvasContext.getImageData(0, 0, canvas.width, canvas.height);

            // Decode QR code
            const qrCode = jsQR(imageData.data, imageData.width, imageData.height);

            if (qrCode) {
                handleQRCodeDetected(qrCode.data);
                return;
            }

            // Continue scanning
            requestAnimationFrame(scanQRCode);
        }

        function handleQRCodeDetected(qrData) {
            // Extract token from QR data (should be the verify URL)
            const match = qrData.match(/verify-qr\/([a-zA-Z0-9]+)/);
            
            if (!match) {
                showError('Invalid QR code format');
                resumeScanning();
                return;
            }

            const token = match[1];
            stopScanning();
            verifyQRCode(token);
        }

        function verifyQRCode(token) {
            fetch(`/verify-qr/${token}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('scannerContainer').style.display = 'none';
                    document.getElementById('successMessage').style.display = 'block';
                    document.getElementById('successText').textContent = `${data.user_name}'s account has been verified!`;
                    document.querySelector('button[onclick="stopScanning()"]').textContent = 'Back to QR Verification';
                    document.querySelector('button[onclick="stopScanning()"]').onclick = function() {
                        window.location.href = '/qr-verification';
                    };
                } else {
                    showError('Verification failed: ' + (data.message || 'Unknown error'));
                    resumeScanning();
                }
            })
            .catch(error => {
                console.error('Error verifying QR code:', error);
                showError('An error occurred. Please try again.');
                resumeScanning();
            });
        }

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = message;
            errorDiv.style.display = 'block';
        }

        function resumeScanning() {
            isScanning = true;
            scanQRCode();
        }
    </script>
</x-layout>
