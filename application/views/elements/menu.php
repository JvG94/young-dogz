<nav>
    <ul>
        <li class="main-navigation-item"><a href="/">Home</a></li>
        <li class="main-navigation-item"><a href="reservations/add">Reserveren</a></li>
        <li class="main-navigation-item"><a href="#">Menukaart</a></li>
        <li class="main-navigation-item"><a href="pages/contact">Contact</a></li>
        <li class="main-navigation-item"><a href="users/index"><?php echo isset($_SESSION['user']['id']) ? 'Account' : 'Aanmelden';?></a></li>
    </ul>
</nav> 