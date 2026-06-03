<x-layout :guest="true">
    <section class="auth-section">
        <div class="auth-card register-card">
            <div class="logo-circle">SSC</div>

            <h1 class="auth-title">Create Voter Account</h1>
            <p class="auth-subtitle">
                Fill in all required fields to register
            </p>

            <form>
                <div class="mb-3 text-start">
                    <label class="form-label">Student ID</label>
                    <input type="text" class="form-control custom-input" placeholder="e.g. 23-LN-0008">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3 text-start">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control custom-input" placeholder="Inoue">
                    </div>

                    <div class="col-md-6 mb-3 text-start">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control custom-input" placeholder="Kate Diane">
                    </div>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Year and Section</label>
                    <input type="text" class="form-control custom-input" placeholder="e.g. III-BSIT-B">
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">College</label>
                    <select class="form-select custom-input">
                        <option selected disabled>Select College</option>
                        <option>CASL - College of Arts, Sciences and Letters</option>
                        <option>CBPA - College of Business and Public Administration</option>
                        <option>CCS - College of Computer Sciences</option>
                        <option>CIT - College of Industrial Technology</option>
                        <option>CTE - College of Teacher Education</option>
                        <option>CTHM - College of Hospitality and Tourism Management</option>
                    </select>
                </div>

                <div class="mb-3 text-start">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control custom-input" placeholder="Create password">
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control custom-input" placeholder="Repeat password">
                </div>

                <a href="/ballot" class="btn btn-gold w-100 py-2">
                    Create Account
                </a>
            </form>

            <div class="gold-divider"></div>

            <p class="auth-link-text">
                Already have an account?
                <a href="/">Login here</a>
            </p>
        </div>
    </section>
</x-layout>