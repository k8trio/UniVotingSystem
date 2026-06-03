<x-layout :guest="true">
    <section class="auth-section">
        <div class="auth-card">
            <div class="logo-circle">SSC</div>

            <h1 class="auth-title">SSC Elections 2026</h1>
            <p class="auth-subtitle">
                Pangasinan State University - Lingayen Campus<br>
                Student Electoral Tribunal
            </p>

            <form>
                <div class="mb-3 text-start">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control custom-input" placeholder="e.g. 23-LN-0008">
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control custom-input" placeholder="Enter password">
                </div>

                <a href="/ballot" class="btn btn-gold w-100 py-2">
                    Login
                </a>
            </form>

            <div class="gold-divider"></div>

            <p class="auth-link-text">
                Not yet registered?
                <a href="/register">Create an account</a>
            </p>
        </div>
    </section>
</x-layout>