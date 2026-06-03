<x-layout>
    <div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem;">
        <div class="login-card" style="max-width: 500px;">

            <div class="login-seal" style="margin-bottom: 1.5rem;">
                <i class="bi bi-qr-code" style="font-size: 3rem;"></i>
            </div>

            <div class="login-title cinzel" style="margin-bottom: 0.5rem;">
                Verify Your Account
            </div>

            <div class="login-sub" style="margin-bottom: 2rem;">
                Scan this QR code with your camera to verify your account
            </div>

            <!-- QR Code Display -->
            <div id="qrCodeContainer" style="
                background: white;
                padding: 2rem;
                border-radius: 8px;
                margin-bottom: 1.5rem;
                text-align: center;
                display: none;
            ">
                <img id="qrCodeImage" src="" alt="QR Code" style="max-width: 100%; height: auto; border-radius: 4px;">
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 1rem; margin-bottom: 0;">
                    <i class="bi bi-camera me-1"></i>
                    Point your camera at this code
                </p>
            </div>

            <!-- Loading State -->
            <div id="loadingContainer" style="
                text-align: center;
                padding: 2rem;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            ">
                <div style="
                    width: 50px;
                    height: 50px;
                    border: 3px solid var(--gold);
                    border-top: 3px solid transparent;
                    border-radius: 50%;
                    animation: spin 1s linear infinite;
                    margin-bottom: 1rem;
                "></div>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Loading QR code...</p>
            </div>

            <!-- Verification Status -->
            <div id="statusContainer" style="
                background: rgba(255, 170, 170, 0.1);
                border: 1px solid #ffaaaa;
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                display: none;
                margin-bottom: 1.5rem;
            ">
                <div id="statusIcon" style="font-size: 2rem; margin-bottom: 0.5rem;">
                    <i class="bi bi-hourglass-split" style="color: var(--gold);"></i>
                </div>
                <div id="statusText" style="color: var(--text-muted); font-size: 0.9rem;">
                    Waiting for verification...
                </div>
            </div>

            <!-- Success State -->
            <div id="successContainer" style="
                background: rgba(144, 255, 204, 0.1);
                border: 1px solid #90ffcc;
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                display: none;
            ">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                    <i class="bi bi-check-circle-fill" style="color: #90ffcc;"></i>
                </div>
                <div style="color: #90ffcc; font-weight: 500; margin-bottom: 1rem;">
                    Account Verified!
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1.5rem;">
                    Your account has been verified. You're ready to vote!
                </p>
                <a href="/ballot" class="btn-gold w-100" style="display: inline-block; text-decoration: none; padding: 0.75rem;">
                    <i class="bi bi-check me-2"></i>
                    Proceed to Ballot
                </a>
            </div>

            <!-- Error State -->
            <div id="errorContainer" style="
                background: rgba(255, 170, 170, 0.1);
                border: 1px solid #ffaaaa;
                padding: 1.5rem;
                border-radius: 8px;
                text-align: center;
                display: none;
            ">
                <div style="font-size: 2rem; margin-bottom: 0.5rem;">
                    <i class="bi bi-exclamation-circle-fill" style="color: #ffaaaa;"></i>
                </div>
                <div id="errorMessage" style="color: #ffaaaa; margin-bottom: 1rem;"></div>
                <button onclick="location.reload()" class="btn-outline-gold" style="width: 100%;">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    Try Again
                </button>
            </div>

            <!-- Skip Button -->
            <button onclick="skipVerification()" class="btn-outline-gold w-100" style="margin-top: 1rem; display: none;" id="skipBtn">
                <i class="bi bi-skip-forward me-2"></i>
                Skip for Now
            </button>

        </div>
    </div>

    <style>
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>

    <script>
        let verificationCheckInterval;
        const MAX_RETRIES = 120; // 2 minutes with 1 second checks
        let retryCount = 0;

        document.addEventListener('DOMContentLoaded', function () {
            loadQRCode();
            startVerificationCheck();
        });

        function loadQRCode() {
            fetch('/api/qr-code', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById('qrCodeImage').src = data.qr_image;
                    document.getElementById('loadingContainer').style.display = 'none';
                    document.getElementById('qrCodeContainer').style.display = 'block';
                    document.getElementById('statusContainer').style.display = 'block';

                    if (data.qr_verified) {
                        showVerificationSuccess();
                    }
                } else {
                    showError('Failed to load QR code: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error loading QR code:', error);
                showError('Failed to load QR code. Please refresh the page.');
            });
        }

        function startVerificationCheck() {
            // Check every 1 second
            verificationCheckInterval = setInterval(checkVerificationStatus, 1000);
        }

        function checkVerificationStatus() {
            retryCount++;

            if (retryCount > MAX_RETRIES) {
                clearInterval(verificationCheckInterval);
                showError('Verification timeout. Please try again.');
                return;
            }

            fetch('/api/qr-status', {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.qr_verified) {
                    clearInterval(verificationCheckInterval);
                    showVerificationSuccess();
                }
            })
            .catch(error => {
                console.error('Error checking verification status:', error);
            });
        }

        function showVerificationSuccess() {
            clearInterval(verificationCheckInterval);
            document.getElementById('loadingContainer').style.display = 'none';
            document.getElementById('qrCodeContainer').style.display = 'none';
            document.getElementById('statusContainer').style.display = 'none';
            document.getElementById('successContainer').style.display = 'block';
            document.getElementById('skipBtn').style.display = 'none';
        }

        function showError(message) {
            document.getElementById('loadingContainer').style.display = 'none';
            document.getElementById('qrCodeContainer').style.display = 'none';
            document.getElementById('statusContainer').style.display = 'none';
            document.getElementById('errorContainer').style.display = 'block';
            document.getElementById('errorMessage').textContent = message;
            document.getElementById('skipBtn').style.display = 'block';
        }

        function skipVerification() {
            // Allow user to skip verification for now
            window.location.href = '/ballot';
        }
    </script>
</x-layout>
