<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-4 p-3">
            <div class="p-4 neu rounded border-light">
                <h1>Login</h1>
                <div id="emailHelp" class="form-text">
                    Please don't forget your password.
                </div>
                <form method="post" action="<?= site_url('/loginUser') ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control neu-input" id="email" aria-describedby="emailHelp" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control neu-input" id="password" />
                    </div>
                    <button type="submit" class="btn neu neu-btn">Login</button>
                </form>
            </div>

        </div>
    </div>
</div>