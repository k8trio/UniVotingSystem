<x-layout>
    <div class="page active" id="page-finalize">
        <div class="ballot-outer">
            <div class="blur-frame blur-frame-left"></div>
            <div class="blur-frame blur-frame-right"></div>

            <div class="ballot-content">

                <div class="text-center mb-3 pt-2">
                    <h2 style="color:var(--gold-light)">
                        Finalize Your Vote
                    </h2>

                    <p style="font-size:.8rem;color:var(--text-muted)">
                        Review all your selections below before submitting
                    </p>
                </div>

                <div class="ssc-card mb-3">
                    <div class="ssc-card-header">
                        <i class="bi bi-person-badge-fill"></i>
                        Your Selections
                    </div>

                    <div id="reviewSelections" style="padding:1rem">
                        <div style="color:var(--text-muted);font-size:.82rem;text-align:center">
                            Loading your selected candidates...
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3 justify-content-center mt-3 mb-5 flex-wrap">
                    <a href="/ballot" class="btn-outline-gold">
                        <i class="bi bi-arrow-left me-1"></i>
                        Edit Ballot
                    </a>

                    <button type="button" class="btn-gold" style="padding:.7rem 2rem" onclick="submitFinalVote()">
                        <i class="bi bi-send-fill me-2"></i>
                        SUBMIT VOTE
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-layout>