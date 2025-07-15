<?php

    @session_start();

echo<<<END
    <header class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light bg-light rounded">
            <div class="container">
                <button class="navbar-toggler mr-auto ml-auto w-100 border-dark" style="border-width:2px" type="button" data-toggle="collapse" data-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
                    <h4 class="text-dark mr-auto ml-auto">Parafia Św. Jakuba Apostoła w Wielowiczu</h4>
                    <span class="navbar-toggler-icon my-1"/>
                </button>
                <div class="collapse navbar-collapse" id="navbarToggle">
                    <div class="navbar-nav mr-auto ml-auto">
END;
                    if(!isset($_SESSION['user']))
                    {
echo<<<END
                        <a class="btn btn-light w-100 mx-1 font-weight-bold" href="/"><h3>Główna</h3></a>
END;
                    }
                    else {
echo<<<END
                        <div class="nav-item dropdown">
                            <button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Główna</h3>
                            </button>
                            <div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-light font-weight-bold" href="/"><h3>Domowa</h3></a>
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Aktualności</h3></a>
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Dodaj Aktualności</h3></a>
                            </div>
                        </div>
END;
                    }
echo<<<END
                        <div class="nav-item dropdown">
                            <button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Parafia</h3>
                            </button>
                            <div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Kontakt</h3></a>
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Biuro</h3></a>
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Duchowieństwo</h3></a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <button class="btn btn-light w-100 mx-1 font-weight-bold" id="subnav" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <h3>Ogłoszenia</h3>
                            </button>
                            <div class="dropdown-menu bg-light mr-auto ml-auto" aria-labelledby="subnav">
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Bieżące</h3></a>
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Stałe</h3></a>
END;
                                if(isset($_SESSION['user']))
                                {
echo<<<END
                                <a class="dropdown-item bg-light font-weight-bold" href="#"><h3>Dodaj bieżące</h3></a>
END;
                                }
echo<<<END
                            </div>
                        </div>
END;
                        if(!isset($_SESSION['user']))
                        {
echo<<<END
                        <a class="btn btn-light w-100 mx-1 font-weight-bold" href="logowanie"><h3>Logowanie</h3></a>
END;
                        }
                        else
                        {
echo<<<END
                        <a class="btn btn-light w-100 mx-1 font-weight-bold" href="wyloguj"><h3>Wylogowanie</h3></a>
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