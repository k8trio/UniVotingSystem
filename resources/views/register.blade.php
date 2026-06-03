<x-layout :guest="true">
    <section class="register-wrap">
        <div class="register-card">

            <div class="page-hero" style="margin:-2rem -1.75rem 1.5rem;border-radius:14px 14px 0 0">
                <h2>Create Voter Account</h2>
                <p>Fill in all required fields to register</p>
            </div>

            <form>
                <div class="row g-3">

                    <div class="col-12">
                        <label class="form-label-ssc">Student ID</label>
                        <input type="text" class="form-control-ssc" id="regId" placeholder="e.g. 23-LN-0008">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">Last Name</label>
                        <input type="text" class="form-control-ssc" id="regLast" placeholder="Inoue">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">First Name</label>
                        <input type="text" class="form-control-ssc" id="regFirst" placeholder="Kate Diane">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">Year & Section</label>
                        <input type="text" class="form-control-ssc" id="regYear" placeholder="e.g. III-BSIT-B">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">College</label>
                        <select class="form-select-ssc" id="regCollege">
                            <option value="">— Select College —</option>
                            <option>CASL - College of Arts, Sciences and Letters</option>
                            <option>CBPA - College of Business and Public Administration</option>
                            <option>CCS - College of Computer Sciences</option>
                            <option>CIT - College of Industrial Technology</option>
                            <option>CTE - College of Teacher Education</option>
                            <option>CTHM - College of Hospitality and Tourism Management</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">Password</label>
                        <input type="password" class="form-control-ssc" id="regPw" placeholder="Create password">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label-ssc">Confirm Password</label>
                        <input type="password" class="form-control-ssc" id="regPw2" placeholder="Repeat password">
                    </div>

                    <div class="col-12 mt-2">
                        <button type="button" class="btn-gold w-100 py-3" onclick="window.location.href='/ballot'">
                            <i class="bi bi-person-plus me-2"></i>
                            Register
                        </button>
                    </div>

                    <div class="col-12 text-center">
                        <p style="font-size:.78rem;color:var(--text-muted);margin-bottom:0">
                            Already have an account?
                            <span class="register-link" onclick="window.location.href='/'">Login here</span>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
</x-layout>