<header class="container-fluid position-fixed position-md-static">
    <div class="row py-3 d-flex justify-content-between align-items-center">
        <!-- Navbar mobile -->
        <div class="col d-md-none">
            <a href="/search">
                <span class="fa-solid fa-magnifying-glass fa-2x text-secondary bg-primary p-3 ms-2 rounded-circle"></span>
            </a>
        </div>
        <div class="col d-md-none d-flex justify-content-end">
            <a href="#">
                <span class="fa-solid fa-burger fa-2x text-secondary bg-primary p-3 me-2 rounded-circle"></span>
            </a>
        </div>
        <!-- Navbar desktop -->
        <div class="d-none d-md-flex col-md-3 align-items-center">
            <a href="/">
                <img src="/pub/media/CuisineConnect.svg" alt="logo" class="img-fluid">
            </a>
        </div>
        <?php if ($_SERVER['REQUEST_URI'] == '/search'): ?>
            <!-- <div class="d-none d-md-flex col-md-6 bg-dark justify-content-center align-items-center px-4 py-1 rounded-pill">
                <span class="fa-solid fa-magnifying-glass fa-2x text-secondary pe-2"></span>
                <input type="text" class="form-control border-0 bg-dark text-white" placeholder="Trova i tuoi amici su CuisineConnect!">
            </div> -->
        <?php endif; ?>
        <div class="d-none d-md-block col-md-5">
            <ul class="nav d-flex justify-content-end align-items-center gap-2">
                <li class="nav-item">
                    <a href="/search" class="nav-link m-0 p-0">
                        <span class="fa-solid fa-magnifying-glass text-secondary bg-primary p-3 rounded-circle"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/notifications" class="nav-link m-0 p-0">
                        <span class="fa-solid fa-bell text-secondary bg-primary p-3 rounded-circle"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/recipes" class="nav-link m-0 p-0">
                        <span class="fa-solid fa-receipt text-secondary bg-primary p-3 rounded-circle"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link m-0 p-0">
                        <span class="fa-solid fa-user text-secondary bg-primary p-3 rounded-circle"></span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/editprofile" class="nav-link m-0 p-0">
                        <span class="fa-solid fa-pen-to-square text-secondary bg-primary p-3 rounded-circle"></span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>
