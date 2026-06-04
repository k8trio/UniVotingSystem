<x-layout>
    <div class="page active" id="page-review">
        <div class="container py-5">

            <div class="text-center mb-4">
                <h2 style="color:var(--gold-light)">
                    Review Your Ballot
                </h2>

                <p style="color:var(--text-muted);font-size:.9rem">
                    Please review your selected candidates before submitting your vote.
                </p>
            </div>

            <div class="ssc-card mx-auto" style="max-width:900px">
                <div class="ssc-card-header">
                    <i class="bi bi-clipboard-check me-2"></i>
                    Selected Candidates
                </div>

                <div class="p-3">
                    <div id="reviewSelections"></div>

                    <div id="emptyReviewMessage" class="text-center py-4" style="display:none;color:var(--text-muted)">
                        No candidates selected yet.
                        <br>
                        <a href="/ballot" style="color:var(--gold)">
                            Go back to ballot
                        </a>
                    </div>

                    <div id="submitMessage" class="mt-3"></div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="/ballot" class="btn-outline-gold">
                            <i class="bi bi-arrow-left me-2"></i>
                            Back to Ballot
                        </a>

                        <button type="button" class="btn-gold" onclick="submitFinalVote()">
                            <i class="bi bi-send-check me-2"></i>
                            Submit Vote
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layout>