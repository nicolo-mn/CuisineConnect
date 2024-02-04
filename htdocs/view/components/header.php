
<header class="container-fluid">
    <div class="row py-3 d-flex justify-content-between align-items-center position-fixed position-md-static w-100">
        <!-- Navbar mobile -->
        <div class="col d-md-none">
            <a href="/search">
                <i class="fa-solid fa-magnifying-glass fa text-secondary bg-primary p-3 ms-2 rounded-circle"></i>
            </a>
        </div>
        <div class="col d-md-none d-flex justify-content-end">
            <a href="#">
                <i class="fa-solid fa-burger fa text-secondary bg-primary p-3 me-2 rounded-circle"></i>
            </a>
        </div>
        <!-- Navbar desktop -->
        <div class="d-none d-md-flex col-md-3 align-items-center">
            <h2 class="text-secondary">LOGO</h2>
        </div>
        <?php if ($_SERVER['REQUEST_URI'] == '/search'): ?>
            <!-- <div class="d-none d-md-flex col-md-6 bg-dark justify-content-center align-items-center px-4 py-1 rounded-pill">
                <i class="fa-solid fa-magnifying-glass fa-2x text-secondary pe-2"></i>
                <input type="text" class="form-control border-0 bg-dark text-white" placeholder="Trova i tuoi amici su CuisineConnect!">
            </div> -->
        <?php endif; ?>
        <div class="d-none d-md-block col-md-3">
            <ul class="nav d-flex justify-content-end align-items-center gap-2">
                <li class="nav-item">
                    <a href="/search" class="nav-link m-0 p-0">
                        <i class="fa-solid fa-magnifying-glass text-secondary bg-primary p-3 rounded-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link m-0 p-0">
                        <i class="fa-solid fa-bell text-secondary bg-primary p-3 rounded-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link m-0 p-0">
                        <i class="fa-solid fa-receipt text-secondary bg-primary p-3 rounded-circle"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/profile" class="nav-link m-0 p-0">
                        <i class="fa-solid fa-user text-secondary bg-primary p-3 rounded-circle"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>