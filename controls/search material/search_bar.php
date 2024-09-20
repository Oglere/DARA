<form action="results.php" method="get">
    <div class="search">
        <input id="srch" name="search" type="text" placeholder="Search..." 
            value="<?= htmlspecialchars(isset($_GET['search']) ? $_GET['search'] : '') ?>" required>
        <button type="submit">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="feather feather-search"
            >
                <circle cx="11" cy="11" r="8" />
                <line x1="21" y1="21" x2="16.65" y2="16.65" />
            </svg>
        </button>
    </div>
    
    <div class="date">
        <input type="number" id="from-year" name="from-year" min="1900" max="2100" step="1" placeholder="From Year" 
            value="<?= isset($_GET['from-year']) ? htmlspecialchars($_GET['from-year']) : '' ?>">
        <label for="to-year">-</label>
        <input type="number" id="to-year" name="to-year" min="1900" max="2100" step="1" placeholder="To Year" 
            value="<?= isset($_GET['to-year']) ? htmlspecialchars($_GET['to-year']) : '' ?>">
    </div>
</form>