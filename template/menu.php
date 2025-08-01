<?php

    @session_start();

echo<<<END
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark rounded">
            <div class="container">
                <button class="navbar-toggler mr-auto ml-auto w-100 border-light" style="border-width:2px" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                    <h5 class="text-light mr-auto ml-auto font-weight-bold">Parafia Św. Jakuba Apostoła w Wielowiczu</h5>
                    <span class="navbar-toggler-icon my-1"/>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggle">
                    <div class="navbar-nav mr-auto ml-auto">
END;
                    if(!isset($_SESSION['user']))
                    {
echo<<<END
                        <a class="btn btn-dark w-100 mx-1 font-weight-bold" href="domowa"><h3>Główna</h3></a>
END;
                    }
                    else {
echo<<<END
                        <div class="nav-item dropdown">
                            <button class="btn btn-dark w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Główna</h3>
                            </button>
                            <div class="dropdown-menu bg-dark mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-dark font-weight-bold text-light"  href="domowa"><h3>Domowa</h3></a>
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="dodajAktualnosci"><h3>Dodaj Aktualności</h3></a>
                            </div>
                        </div>
END;
                    }
echo<<<END
                        <div class="nav-item dropdown">
                            <button class="btn btn-dark w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Parafia</h3>
                            </button>
                            <div class="dropdown-menu bg-dark mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="parafia"><h3>Kościół</h3></a>
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="duchowni"><h3>Duchowni</h3></a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <button class="btn btn-dark w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Ogłoszenia</h3>
                            </button>
                            <div class="dropdown-menu bg-dark mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="#"><h3>Bieżące</h3></a>
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="#"><h3>Stałe</h3></a>
END;
                                if(isset($_SESSION['user']))
                                {
echo<<<END
                                <a class="dropdown-item bg-dark font-weight-bold text-light" href="#"><h3>Dodaj bieżące</h3></a>
END;
                                }
echo<<<END
                            </div>
                        </div>
END;
                        if(!isset($_SESSION['user']))
                        {
echo<<<END
                        <a class="btn btn-dark w-100 mx-1 font-weight-bold" href="logowanie"><h3>Logowanie</h3></a>
END;
                        }
                        else
                        {
echo<<<END
                        <a class="btn btn-dark w-100 mx-1 font-weight-bold" href="wyloguj"><h3>Wylogowanie</h3></a>
END;
                        }
echo<<<END
                    </div>
                </div>
            </div>
        </nav>
    </header>

END;
?>