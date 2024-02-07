<?php if ($_SERVER["REQUEST_URI"] !== "/login" && $_SERVER["REQUEST_URI"] !== "/register"): ?>
    <header class="container-fluid <?php if ($_SERVER["REQUEST_URI"] === "/"): ?> position-fixed position-md-static<?php endif; ?> z-index-2">
        <div class="row py-3 d-flex justify-content-between align-items-center">
            <!-- Navbar mobile -->
            <div class="col d-md-none">
                <?php if ($_SERVER["REQUEST_URI"] !== "/"): ?>
                    <a href="/" title="Home">
                    <span class="fa-solid fa-home fa-2x text-secondary bg-primary p-3 ms-2 rounded-circle"></span>
                    </a>
                <?php endif; ?>
            </div>
            <div class="col d-md-none d-flex justify-content-end">
                <button class="border-0 p-3 me-2 rounded-circle bg-primary z-index-2">
                    <span class="menu-btn fa-solid fa-burger fa-2x text-secondary"></span>
                </button>
            </div>
            <!-- Navbar desktop -->
            <div class="d-none d-md-flex col-md-3 align-items-center">
                <a href="/">
                    <img src="/pub/media/CuisineConnect.svg" alt="logo" class="img-fluid"/>
                </a>
            </div>
            <nav class="col-md-5 z-index-1">
                <ul class="d-none list-unstyled d-md-flex w-12 ps-4 w-md-auto bg-primary top-0 pt-10 pt-md-0 vh-100 h-md-auto position-absolute position-md-static justify-content-end align-items-center gap-2 mb-0" style="transition: all 0.3s ease;">
                    <li class="nav-item">
                        <button class="nav-link m-0 p-0 border-0 bg-transparent" data-bs-toggle="modal" data-bs-target="#addPost">
                            <span class="text-secondary d-md-none">Add a post</span>
                            <span class="fa-solid fa-plus text-secondary bg-primary p-3 rounded-circle"></span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <a href="/search" class="nav-link m-0 p-0">
                            <span class="text-secondary d-md-none">Search</span>
                            <span class="fa-solid fa-magnifying-glass text-secondary bg-primary p-3 rounded-circle"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/notifications" class="nav-link m-0 p-0">
                            <span class="text-secondary d-md-none">Notifications</span>
                            <span class="fa-solid fa-bell text-secondary bg-primary p-3 rounded-circle"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/recipes" class="nav-link m-0 p-0">
                            <span class="text-secondary d-md-none">Recipes</span>
                            <span class="fa-solid fa-receipt text-secondary bg-primary p-3 rounded-circle"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/profile" class="nav-link m-0 p-0">
                            <span class="text-secondary d-md-none">Profile</span>
                            <span class="fa-solid fa-user text-secondary bg-primary p-3 rounded-circle"></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/editprofile" class="nav-link m-0 p-0">
                            <span class="text-secondary d-md-none">Edit profile</span>
                            <span class="fa-solid fa-pen-to-square text-secondary bg-primary p-3 rounded-circle"></span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
<?php endif; ?>
