<x-layout>
    <div class="page active" id="page-voted">
        <div class="voted-wrap">
            <div>
                <div style="font-size:3.5rem;color:var(--yellow-light);margin-bottom:1rem">
                    <i class="bi bi-patch-check-fill"></i>
                </div>

                <h2 class="cinzel" style="font-size:1.4rem;color:var(--yellow-light);margin-bottom:.5rem">
                    Vote Submitted!
                </h2>
                
                <p style="color:rgba(255,255,255,.75);font-size:.9rem;margin-bottom:1.5rem">
                    Thank you for participating in SSC Elections 2026.<br>
                    Your vote has been recorded.
                </p>

                <div id="votedInfo" style="font-size:.8rem;color:rgba(255,255,255,.6);margin-bottom:1.5rem">
                    <i class="bi bi-clock me-1"></i>
                    <span id="submittedTime">Submitted successfully</span><br>

                    <i class="bi bi-person-badge me-1"></i>
                    Status: <span style="color:#90ffcc">Voted</span>
                </div>

                <a href="/transparency" class="btn-outline-gold">
                    <i class="bi bi-bar-chart-fill me-2"></i>
                    View Transparency Dashboard
                </a>
                <br><br>
            </div>
        </div>
    </div>
</x-layout>
