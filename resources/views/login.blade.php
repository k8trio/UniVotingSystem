<x-layout :guest="true">
    <section class="login-wrap">
        <div class="login-card">

            <div class="login-seal">
                <i class="bi bi-shield-lock-fill"></i>
            </div>

            <div class="login-title cinzel">
                SSC Elections 2026
            </div>

            <div class="login-sub">
                Pangasinan State University – Lingayen Campus<br>
                Student Electoral Tribunal
            </div>

            <form method="POST" action="/login">
                @csrf

                <div class="d-flex gap-2 mb-4">
                    <div class="user-type-btn voter sel" id="typeVoter" onclick="loginSelectType('voter')">
                        <i class="bi bi-person-fill d-block mb-1" style="font-size:1.1rem"></i>
                        Voter
                    </div>
                    <div class="user-type-btn admin" id="typeAdmin" onclick="loginSelectType('admin')">
                        <i class="bi bi-gear-fill d-block mb-1" style="font-size:1.1rem"></i>
                        Admin
                    </div>
                </div>

                <input type="hidden" name="type" id="typeInput" value="voter">

                <div class="mb-3 text-start">
                    <label class="form-label-ssc" id="loginIdLabel">Student ID</label>
                    <input type="text" class="form-control-ssc" name="login_id" id="loginId"
                           placeholder="e.g. 23-LN-0008" value="{{ old('login_id') }}">
                </div>

                <div class="mb-4 text-start">
                    <label class="form-label-ssc">Password</label>
                    <div class="position-relative">
                        <input type="password" class="form-control-ssc" name="password" id="loginPw"
                               placeholder="Enter your password">
                        <i class="bi bi-eye position-absolute"
                           style="right:12px;top:50%;transform:translateY(-50%);cursor:pointer;color:var(--text-muted);font-size:.9rem"
                           onclick="togglePw('loginPw', this)">
                        </i>
                    </div>
                </div>

                @if ($errors->any())
                    <div class="mb-3 text-center" style="font-size:.8rem;color:#ffaaaa">
                        {{ $errors->first() }}
                    </div>
                @endif

                <button type="submit" class="btn-gold w-100 py-3">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    LOGIN
                </button>
            </form>

            <div class="gold-divider"></div>

            <p id="registerLink" style="font-size:.78rem;text-align:center;color:var(--text-muted)">
                Not yet registered?
                <span class="register-link" onclick="window.location.href='/register'">Create an account</span>
            </p>
        </div>
    </section>

    <script>
        function loginSelectType(type) {
            document.getElementById('typeInput').value = type;
            document.getElementById('typeVoter').classList.toggle('sel', type === 'voter');
            document.getElementById('typeAdmin').classList.toggle('sel', type === 'admin');
            document.getElementById('loginIdLabel').textContent =
                type === 'admin' ? 'Username' : 'Student ID';
            document.getElementById('loginId').placeholder =
                type === 'admin' ? 'e.g. ssc_admin' : 'e.g. 23-LN-0008';
            document.getElementById('registerLink').style.display =
                type === 'admin' ? 'none' : 'block';
        }
    </script>
</x-layout>