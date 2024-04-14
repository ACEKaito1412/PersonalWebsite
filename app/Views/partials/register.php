<div class="container">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-lg-4 p-3">
            <div class="p-4 neu-inset border-light">
                <h1>Register</h1>
                <div id="emailHelp" class="form-text">
                    Create a password that you wont forget.
                </div>
                <form method="post" action="<?= site_url("/registerUser") ?>">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control neu-input" id="name" name='name' aria-describedby="nameHelp" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control neu-input" name="email" id="email" aria-describedby="emailHelp" />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control neu-input" name="password" id="password" />
                    </div>
                    <button type="submit" class="btn neu neu-btn">Sign-up</button>
                </form>
            </div>

        </div>
    </div>
</div>