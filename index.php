<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/mainpage.scss">
    <title>DARA Main Page</title>
</head>
    <body>
        <main>
            <header>
                <a href="view/login.php">
                    <div class="loginbutton">
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
                            class="feather feather-log-in"
                            >
                            <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                            <polyline points="10 17 15 12 10 7" />
                            <line x1="15" y1="12" x2="3" y2="12" />
                        </svg>
                        <h4> &nbsp Login</h4>
                    </div>
                </a>
            </header>
            
            <div class="contents">
                <P>D A R A</P>
                <h4>Digital Academic Repository and Archive</h3>
                <div class="search">
                    <input name="search" type="text">

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

                <div class="tags">
                    <div class="tag">
                            <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="20"
                            height="20"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            class="feather feather-tag"
                            >
                            <path
                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"
                            />
                            <line x1="7" y1="7" x2="7.01" y2="7" />
                        </svg>
                        &nbsp;Tags
                    </div>
                    <div class="tagform">
                        <div class="lefttag">

                            <div class="date">
                                <input type="number" id="from-year" name="from-year" min="1900" max="2100" step="1" value="2021" required>
                                <label for="to-year">-</label>
                                <input type="number" id="to-year" name="to-year" min="1900" max="2100" step="1" value="2022" required>
                            </div>

                            <div class="checkboxes">
                                <div class="chkbx">
                                    <input class="w3-check" type="checkbox" checked="checked">
                                    <label>Case Study</label>
                                </div>
                                <div class="chkbx">
                                    <input class="w3-check" type="checkbox">
                                    <label>Thesis</label>
                                </div>
                                <div class="chkbx">
                                    <input class="w3-check" type="checkbox">
                                    <label>Proposal</label>
                                </div>
                                <div class="chkbx">
                                    <input class="w3-check" type="checkbox">
                                    <label>Capstone</label>
                                </div>
                                <div class="chkbx">
                                    <input class="w3-check" type="checkbox">
                                    <label>System Studies</label>
                                </div>

                            </div>
                        </div>
                        <div class="midtag"></div>
                        <div class="righttag"></div>
                    </div>
                </div>
            </div>

            <footer>
                <a href="">About DARA </a>

                <p>&nbsp | &nbsp</p>

                <a href=""> Contact us</a>
            </footer>
        </main>
    </body>
</html>
<script src="js/index.js"></script>