let selectedLoginType = 'voter';

function selectType(type) {
    selectedLoginType = type;

    const voterBtn = document.getElementById('typeVoter');
    const adminBtn = document.getElementById('typeAdmin');
    const loginLabel = document.getElementById('loginIdLabel');
    const loginInput = document.getElementById('loginId');

    if (!voterBtn || !adminBtn || !loginLabel || !loginInput) {
        return;
    }

    if (type === 'admin') {
        voterBtn.classList.remove('sel');
        adminBtn.classList.add('sel');

        loginLabel.textContent = 'Admin Username';
        loginInput.placeholder = 'e.g. admin';
    } else {
        adminBtn.classList.remove('sel');
        voterBtn.classList.add('sel');

        loginLabel.textContent = 'Student ID';
        loginInput.placeholder = 'e.g. 23-LN-0001';
    }
}

function registerUser() {
    const fullName = document.getElementById('fullName')?.value || '';
    const email = document.getElementById('registerEmail')?.value || '';
    const password = document.getElementById('registerPassword')?.value || '';
    const confirmPassword = document.getElementById('confirmPassword')?.value || '';

    if (!fullName || !email || !password || !confirmPassword) {
        alert('Please fill in all fields');
        return;
    }

    if (password !== confirmPassword) {
        alert('Passwords do not match');
        return;
    }

    if (password.length < 😎 {
        alert('Password must be at least 8 characters');
        return;
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    fetch('/api/auth/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        credentials: 'include',
        body: JSON.stringify({
            name: fullName,
            email: email,
            password: password
        })
    })
    .then(response => response.json())
}

async function loginRedirect() {
    const loginId = document.getElementById('loginId')?.value.trim();
    const password = document.getElementById('loginPw')?.value;
    const messageBox = document.getElementById('loginMessage');

    if (messageBox) {
        messageBox.textContent = '';
    }

    if (!loginId || !password) {
        if (messageBox) {
            messageBox.textContent = 'Please enter your credentials.';
        }
        return;
    }

    try {
        const response = await fetch('/api/auth/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                type: selectedLoginType,
                login_id: loginId,
                password: password,
            }),
        });

        const data = await response.json();

        if (!response.ok || !data.success) {
            if (messageBox) {
                messageBox.textContent = data.message || 'Login failed.';
            }
            return;
        }

        window.location.href = data.redirect;
    } catch (error) {
        if (messageBox) {
            messageBox.textContent = 'Something went wrong. Please try again.';
        }
    }
}

async function registerAccount() {
    const registerMessage = document.getElementById('registerMessage');

    const studentId = document.getElementById('regId')?.value.trim();
    const lastName = document.getElementById('regLast')?.value.trim();
    const firstName = document.getElementById('regFirst')?.value.trim();
    const yearSection = document.getElementById('regYear')?.value.trim();
    const college = document.getElementById('regCollege')?.value;
    const password = document.getElementById('regPw')?.value;
    const passwordConfirmation = document.getElementById('regPw2')?.value;

    if (!studentId || !lastName || !firstName || !yearSection || !college || !password || !passwordConfirmation) {
        registerMessage.innerHTML = `
            <div class="alert alert-warning">
                Please complete all fields.
            </div>
        `;
        return;
    }

    if (password !== passwordConfirmation) {
        registerMessage.innerHTML = `
            <div class="alert alert-danger">
                Passwords do not match.
            </div>
        `;
        return;
    }

    try {
        const response = await fetch('/api/auth/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
            body: JSON.stringify({
                student_id: studentId,
                last_name: lastName,
                first_name: firstName,
                year_and_section: yearSection,
                college: college,
                password: password,
                password_confirmation: passwordConfirmation,
            }),
        });

        const data = await response.json();

        if (!response.ok) {
            registerMessage.innerHTML = `
                <div class="alert alert-danger">
                    ${data.message || 'Registration failed. Please check your details.'}
                </div>
            `;
            return;
        }

        registerMessage.innerHTML = `
            <div class="alert alert-success">
                Registration successful. Redirecting to login...
            </div>
        `;

        window.location.href = data.redirect || '/';
    } catch (error) {
        registerMessage.innerHTML = `
            <div class="alert alert-danger">
                Something went wrong. Please try again.
            </div>
        `;
    }
}

async function logoutUser() {
    try {
        const response = await fetch('/api/auth/logout', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
        });

        const data = await response.json();

        window.location.href = data.redirect || '/login';
    } catch (error) {
        window.location.href = '/login';
    }
}

async function logoutUser() {
    try {
        const response = await fetch('/api/auth/logout', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken(),
            },
        });

        const data = await response.json();

        window.location.href = data.redirect || '/';
    } catch (error) {
        window.location.href = '/';
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
}

function togglePw(inputId, icon) {
    const input = document.getElementById(inputId);
    if (!input) return;

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

function selectCandidate(card) {
    const positionSection = card.closest('[data-vote-position]');

    if (!positionSection) {
        return;
    }

    const maxWinners = parseInt(positionSection.getAttribute('data-max-winners') || '1');
    const selectedCards = positionSection.querySelectorAll('.candidate-card.selected');

    if (maxWinners === 1) {
        const cards = positionSection.querySelectorAll('.candidate-card');

        cards.forEach(item => {
            item.classList.remove('selected');
        });

        card.classList.add('selected');
    } else {
        if (card.classList.contains('selected')) {
            card.classList.remove('selected');
        } else {
            if (selectedCards.length >= maxWinners) {
                alert('You can only select ' + maxWinners + ' candidates for this position.');
                return;
            }

            card.classList.add('selected');
        }
    }

    updateProgress();
    saveSelectionsToLocalStorage();
}

function updateProgress() {
    const allPositions = document.querySelectorAll('[data-vote-position]');
    const progressText = document.getElementById('progressText');
    const progressBar = document.getElementById('progressBar');

    if (!progressText || !progressBar) {
        return;
    }

    let totalRequired = 0;
    let totalSelected = 0;

    allPositions.forEach(position => {
        const maxWinners = parseInt(position.getAttribute('data-max-winners') || '1');
        const selectedCards = position.querySelectorAll('.candidate-card.selected');

        totalRequired += maxWinners;
        totalSelected += selectedCards.length;
    });

    progressText.textContent = totalSelected + ' / ' + totalRequired;

    const percent = totalRequired > 0 ? (totalSelected / totalRequired) * 100 : 0;
    progressBar.style.width = percent + '%';
}

function saveSelectionsToLocalStorage() {
    const positions = document.querySelectorAll('[data-vote-position]');
    const selections = [];

    positions.forEach(position => {
        const positionId = position.getAttribute('data-vote-position');
        const positionName = position.getAttribute('data-position-name');
        const selectedCards = position.querySelectorAll('.candidate-card.selected');

        selectedCards.forEach(selectedCard => {
            selections.push({
                position_id: positionId,
                position: positionName,
                candidate_id: selectedCard.getAttribute('data-candidate-id'),
                candidate: selectedCard.getAttribute('data-candidate-name'),
                college: selectedCard.getAttribute('data-candidate-college')
            });
        });
    });

    localStorage.setItem('sscVoteSelections', JSON.stringify(selections));
}

function loadReviewSelections() {
    const reviewList = document.getElementById('reviewSelections');
    if (!reviewList) return;

    const selections = JSON.parse(localStorage.getItem('sscVoteSelections') || '[]');

    if (selections.length === 0) {
        reviewList.innerHTML = `
            <div style="padding:1rem;color:var(--text-muted);font-size:.85rem;text-align:center">
                No selections yet. Please go back to the ballot and choose your candidates.
            </div>
        `;
        return;
    }

    reviewList.innerHTML = selections.map(item => `
        <div class="finalize-row">
            <div>
                <div class="finalize-pos">${item.position}</div>
                <div class="finalize-name">
                    ${item.candidate}
                    <span class="college-badge">${item.college}</span>
                </div>
            </div>
            <i class="bi bi-check-circle-fill" style="color:var(--gold)"></i>
        </div>
    `).join('');
}

function submitFinalVote() {
    const selections = JSON.parse(localStorage.getItem('sscVoteSelections') || '[]');

    if (selections.length === 0) {
        alert('No votes to submit. Please select candidates.');
        return;
    }

    const votes = selections.map(item => ({
        position_id: item.position_id,
        candidate_id: item.candidate_id
    }));

    const submitBtn = document.querySelector('button[onclick="submitFinalVote()"]');
    if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Submitting...';
    }

    fetch('/submit-votes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        credentials: 'include',
        body: JSON.stringify({ votes: votes })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            localStorage.removeItem('sscVoteSelections');
            localStorage.setItem('sscSubmittedAt', new Date().toLocaleString());
            window.location.href = '/voted';
        } else {
            alert('Error submitting votes: ' + (data.message || 'Unknown error'));
            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Submit Vote';
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while submitting your votes. Please try again.');
        if (submitBtn) {
            submitBtn.disabled = false;
            submitBtn.textContent = 'Submit Vote';
        }
    });
}

function showAdminTab(event, tab) {
    event.preventDefault();
    document.querySelectorAll('.admin-tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.sidebar-item').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.admin-mobile-nav-item').forEach(t => t.classList.remove('active'));

    document.getElementById('admin-' + tab).classList.add('active');

    document.querySelectorAll('.sidebar-item, .admin-mobile-nav-item').forEach(item => {
        if (item.getAttribute('href') === '#' + tab) {
            item.classList.add('active');
        }
    });
}

function loadVotedInfo() {
    const submittedTime = document.getElementById('submittedTime');

    if (!submittedTime) {
        return;
    }

    const time = localStorage.getItem('sscSubmittedAt');

    if (time) {
        submittedTime.textContent = 'Submitted: ' + time;
    }
}

function loadAdminVoterStatus() {
    const voterStatus = localStorage.getItem('sscVoterStatus');
    const statusCell = document.getElementById('demoVoterStatus');

    if (!statusCell) {
        return;
    }

    if (voterStatus === 'Voted') {
        statusCell.innerHTML = `
            <span style="color:#90ffcc;font-size:.75rem">
                Voted
            </span>
        `;
    } else {
        statusCell.innerHTML = `
            <span style="color:#ffaaaa;font-size:.75rem">
                Not Yet
            </span>
        `;
    }
}

function initializeVotingPage() {
    // Check voting status when the page loads
    // Only check if we're on a voting-related page
    if (window.location.pathname === '/ballot' || window.location.pathname === '/review') {
        checkVotingStatus();
    }
}

function checkVotingStatus() {
    fetch('/voting-status', {
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
        },
        credentials: 'include'
    })
    .then(response => {
        if (response.status === 401) {
            return null;
        }
        return response.json();
    })
    .then(data => {
        if (!data) return;
        if (data.has_voted) {
            showAlreadyVotedMessage();
        }
    })
    .catch(error => {
        console.error('Error checking voting status:', error);
    });
}

function showAlreadyVotedMessage() {
    // Disable the main content
    const ballotSection = document.querySelector('[data-vote-position]');
    if (ballotSection) {
        const parent = ballotSection.closest('.page') || ballotSection.closest('body');
        if (parent) {
            const message = document.createElement('div');
            message.innerHTML = `
                <div style="
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    bottom: 0;
                    background: rgba(0, 0, 0, 0.7);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                ">
                    <div style="
                        background: var(--bg-dark);
                        border: 1px solid var(--gold);
                        border-radius: 8px;
                        padding: 2rem;
                        text-align: center;
                        max-width: 400px;
                    ">
                        <div style="font-size: 2rem; margin-bottom: 1rem; color: var(--gold-light);">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h2 style="color: var(--gold-light); margin-bottom: 0.5rem;">You've Already Voted!</h2>
                        <p style="color: var(--text-muted); margin-bottom: 1.5rem;">
                            Each voter can only vote once. Your vote has already been recorded.
                        </p>
                        <a href="/transparency" class="btn-outline-gold">
                            <i class="bi bi-bar-chart-fill me-2"></i>
                            View Results
                        </a>
                    </div>
                </div>
            `;
            document.body.appendChild(message);
        }
    }
}

async function downloadReport(url, filename) {
    const exportMessage = document.getElementById('exportMessage');

    if (exportMessage) {
        exportMessage.innerHTML = `
            <div class="alert alert-info">
                Preparing report, please wait...
            </div>
        `;
    }

    try {
        const response = await fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'text/csv',
            },
        });

        if (!response.ok) {
            throw new Error('Export failed.');
        }

        const blob = await response.blob();
        const downloadUrl = window.URL.createObjectURL(blob);

        const link = document.createElement('a');
        link.href = downloadUrl;
        link.download = filename;
        document.body.appendChild(link);
        link.click();

        link.remove();
        window.URL.revokeObjectURL(downloadUrl);

        if (exportMessage) {
            exportMessage.innerHTML = `
                <div class="alert alert-success">
                    ${filename} downloaded successfully.
                </div>
            `;
        }
    } catch (error) {
        if (exportMessage) {
            exportMessage.innerHTML = `
                <div class="alert alert-danger">
                    Unable to export report. Please try again.
                </div>
            `;
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    updateProgress();
    loadReviewSelections();
    loadVotedInfo();
    loadAdminVoterStatus();
    initializeVotingPage();
});
