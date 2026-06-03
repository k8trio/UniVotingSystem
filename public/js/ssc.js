let selectedLoginType = 'voter';

function selectType(type) {
    selectedLoginType = type;

    const voterBtn = document.getElementById('typeVoter');
    const adminBtn = document.getElementById('typeAdmin');
    const loginLabel = document.getElementById('loginIdLabel');
    const loginInput = document.getElementById('loginId');

    if (!voterBtn || !adminBtn || !loginLabel || !loginInput) return;

    if (type === 'admin') {
        voterBtn.classList.remove('sel');
        adminBtn.classList.add('sel');

        loginLabel.textContent = 'Admin Username';
        loginInput.placeholder = 'e.g. admin';
    } else {
        adminBtn.classList.remove('sel');
        voterBtn.classList.add('sel');

        loginLabel.textContent = 'Student ID';
        loginInput.placeholder = 'e.g. 2021-00001';
    }
}

function loginRedirect() {
    if (selectedLoginType === 'admin') {
        window.location.href = '/admin';
    } else {
        window.location.href = '/ballot';
    }
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
    const positionSection = card.closest('.position-section');
    if (!positionSection) return;

    const cards = positionSection.querySelectorAll('.candidate-card');
    cards.forEach(item => item.classList.remove('selected'));

    card.classList.add('selected');

    updateProgress();
    saveSelectionsToLocalStorage();
}

function updateProgress() {
    const allPositions = document.querySelectorAll('[data-vote-position]');
    const selectedPositions = document.querySelectorAll('[data-vote-position] .candidate-card.selected');

    const progressText = document.getElementById('progressText');
    const progressBar = document.getElementById('progressBar');
    if (!progressText || !progressBar) return;

    const total = allPositions.length;
    const done = selectedPositions.length;

    progressText.textContent = `${done} / ${total}`;
    const percent = total > 0 ? (done / total) * 100 : 0;
    progressBar.style.width = percent + '%';
}

function saveSelectionsToLocalStorage() {
    const positions = document.querySelectorAll('[data-vote-position]');
    const selections = [];

    positions.forEach(position => {
        const positionName = position.getAttribute('data-vote-position');
        const selectedCard = position.querySelector('.candidate-card.selected');
        if (selectedCard) {
            selections.push({
                position: positionName,
                candidate: selectedCard.getAttribute('data-candidate-name'),
                college: selectedCard.getAttribute('data-candidate-college')
            });
        }
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
    localStorage.removeItem('sscVoteSelections');
    window.location.href = '/voted';
}

function showAdminTab(event, tabName) {
    event.preventDefault();

    const sidebarItems = document.querySelectorAll('.sidebar-item');
    const tabs = document.querySelectorAll('.admin-tab');

    sidebarItems.forEach(item => item.classList.remove('active'));
    tabs.forEach(tab => tab.classList.remove('active'));

    event.currentTarget.classList.add('active');

    const activeTab = document.getElementById('admin-' + tabName);
    if (activeTab) activeTab.classList.add('active');
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

document.addEventListener('DOMContentLoaded', function () {
    updateProgress();
    loadReviewSelections();
    loadVotedInfo();
    loadAdminVoterStatus();
});