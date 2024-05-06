<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style.css">

</head>

<body>
    <?php
    session_start();
    $_SESSION['file'] = basename(__DIR__);
    include_once('../header.php');
    unset($_SESSION['file']);
    ?>

    <main class="container">

        <section id="tables">
            <h2><?php
                if (isset($_SESSION['fileselect'])) {
                    echo "<span>Dossier actuelle : </span>" . $_SESSION['fileselect'];
                } else {
                    echo "Dossiers Partagé";
                }
                ?>
            </h2>
            <form method="post" action="./redirect.php">
                <div class=" btn-cloud">
                    <input type="hidden" name="filename" value="<?php if (isset($_SESSION['fileselect'])) {
                                                                    echo $_SESSION['fileselect'];
                                                                } ?>">
                    <?php
                    if (isset($_SESSION['fileselect'])) {
                        echo '<button class="contrast" name="home" type="submit">Accueil</button>
                        <button class="secondary" name="back" type="submit">Retour</button>';
                    }

                    ?>
                </div>
            </form>
            <p class="error">
                <?php
                if (isset($_SESSION['error-del'])) {
                    echo $_SESSION['error-del'];
                    unset($_SESSION['error-del']);
                }
                ?>
            </p>
            <div class="overflow-auto">
                <table class="striped">
                    <thead>
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Taille</th>
                            <th scope="col">Date</th>
                            <th scope="col" class="noborder">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_SESSION['fileselect'])) {
                            $directory = './cloud/' . $_SESSION['fileselect'];
                        } else {
                            $directory = './cloud';
                        }

                        $current_directory = isset($_GET['directory']) ? $_GET['directory'] : $directory;

                        // Récupérer la liste des fichiers et dossiers
                        $files = scandir($directory);
                        $i = 0;
                        if (count($files) >= 3) {
                            // Parcourir la liste des fichiers et dossiers
                            foreach ($files as $file) {
                                $i++;
                                // Ignorer les entrées "." et ".."
                                if ($file === '.' || $file === '..') {
                                    continue;
                                }

                                $file_path = $current_directory . '/' . $file;
                                // Récupérer les informations sur le fichier/dossier
                                $file_info = stat($file_path);
                                $file_date = date('d/m/y', $file_info['mtime']);
                                $file_size = size($file_info['size']);

                        ?>
                                <form method="post" action="./redirect.php" id="form<?php echo $i ?>">
                                    <tr>
                                        <input type="hidden" name="filename" value="<?php echo $file; ?>">
                                        <input type="hidden" name="lastfilename" value="<?php
                                                                                        if (isset($_SESSION['fileselect'])) {
                                                                                            echo $_SESSION['fileselect'];
                                                                                        }
                                                                                        ?>">
                                        <th scope="row">
                                            <a href="" id="<?php echo $file; ?>" onclick="document.getElementById('form<?php echo $i ?>').submit(); return false;"><?php echo $file; ?></a>
                                        </th>
                                        <td><?php echo $file_size; ?></td>
                                        <td><?php echo $file_date; ?></td>
                                        <td class="noborder">
                                            <span class="icon-option">
                                                <?php if (!is_dir($current_directory . "/" . $file)) { ?>
                                                    <a href="download.php?file=<?php echo $current_directory . "/" . $file; ?>" class="btn-icon">
                                                        <svg viewBox="0 0 24 24" fill="CurrentColor" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill="CurrentColor" d="M12.5535 16.5061C12.4114 16.6615 12.2106 16.75 12 16.75C11.7894 16.75 11.5886 16.6615 11.4465 16.5061L7.44648 12.1311C7.16698 11.8254 7.18822 11.351 7.49392 11.0715C7.79963 10.792 8.27402 10.8132 8.55352 11.1189L11.25 14.0682V3C11.25 2.58579 11.5858 2.25 12 2.25C12.4142 2.25 12.75 2.58579 12.75 3V14.0682L15.4465 11.1189C15.726 10.8132 16.2004 10.792 16.5061 11.0715C16.8118 11.351 16.833 11.8254 16.5535 12.1311L12.5535 16.5061Z" fill="#1C274C" />
                                                            <path fill="CurrentColor" d="M3.75 15C3.75 14.5858 3.41422 14.25 3 14.25C2.58579 14.25 2.25 14.5858 2.25 15V15.0549C2.24998 16.4225 2.24996 17.5248 2.36652 18.3918C2.48754 19.2919 2.74643 20.0497 3.34835 20.6516C3.95027 21.2536 4.70814 21.5125 5.60825 21.6335C6.47522 21.75 7.57754 21.75 8.94513 21.75H15.0549C16.4225 21.75 17.5248 21.75 18.3918 21.6335C19.2919 21.5125 20.0497 21.2536 20.6517 20.6516C21.2536 20.0497 21.5125 19.2919 21.6335 18.3918C21.75 17.5248 21.75 16.4225 21.75 15.0549V15C21.75 14.5858 21.4142 14.25 21 14.25C20.5858 14.25 20.25 14.5858 20.25 15C20.25 16.4354 20.2484 17.4365 20.1469 18.1919C20.0482 18.9257 19.8678 19.3142 19.591 19.591C19.3142 19.8678 18.9257 20.0482 18.1919 20.1469C17.4365 20.2484 16.4354 20.25 15 20.25H9C7.56459 20.25 6.56347 20.2484 5.80812 20.1469C5.07435 20.0482 4.68577 19.8678 4.40901 19.591C4.13225 19.3142 3.9518 18.9257 3.85315 18.1919C3.75159 17.4365 3.75 16.4354 3.75 15Z" fill="#1C274C" />
                                                        </svg>
                                                    </a>
                                                <?php } else { ?>
                                                    <a class="btn-icon"></a>
                                                    <svg>
                                                    </svg>
                                                <?php } ?>
                                            </span>
                                            <span class="icon-option">
                                                <button class="btn-icon rename" id="Rename-<?php echo $file; ?>">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.25 22C3.25 21.5858 3.58579 21.25 4 21.25H20C20.4142 21.25 20.75 21.5858 20.75 22C20.75 22.4142 20.4142 22.75 20 22.75H4C3.58579 22.75 3.25 22.4142 3.25 22Z" fill="CurrentColor" />
                                                        <path d="M11.5201 14.929L11.5201 14.9289L17.4368 9.01225C16.6315 8.6771 15.6777 8.12656 14.7757 7.22455C13.8736 6.32238 13.323 5.36846 12.9879 4.56312L7.07106 10.4799L7.07101 10.48C6.60932 10.9417 6.37846 11.1725 6.17992 11.4271C5.94571 11.7273 5.74491 12.0522 5.58107 12.396C5.44219 12.6874 5.33894 12.9972 5.13245 13.6167L4.04356 16.8833C3.94194 17.1882 4.02128 17.5243 4.2485 17.7515C4.47573 17.9787 4.81182 18.0581 5.11667 17.9564L8.38334 16.8676C9.00281 16.6611 9.31256 16.5578 9.60398 16.4189C9.94775 16.2551 10.2727 16.0543 10.5729 15.8201C10.8275 15.6215 11.0584 15.3907 11.5201 14.929Z" fill="CurrentColor" />
                                                        <path d="M19.0786 7.37044C20.3071 6.14188 20.3071 4.14999 19.0786 2.92142C17.85 1.69286 15.8581 1.69286 14.6296 2.92142L13.9199 3.63105C13.9296 3.6604 13.9397 3.69015 13.9502 3.72028C14.2103 4.47 14.701 5.45281 15.6243 6.37602C16.5475 7.29923 17.5303 7.78999 18.28 8.05009C18.31 8.0605 18.3396 8.07054 18.3688 8.08021L19.0786 7.37044Z" fill="CurrentColor" />
                                                    </svg>
                                                </button>
                                            </span>
                                            <span class="icon-option">
                                                <button class="btn-icon deleute" id="delete-<?php echo $file; ?>" data-target="modal-example" onclick="toggleModal(event);">
                                                    <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M10 11V17" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M14 11V17" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M4 7H20" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M6 7H12H18V18C18 19.6569 16.6569 21 15 21H9C7.34315 21 6 19.6569 6 18V7Z" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                        <path d="M9 5C9 3.89543 9.89543 3 11 3H13C14.1046 3 15 3.89543 15 5V7H9V5Z" stroke="CurrentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </td>
                                    </tr>

                                </form>

                        <?php }
                        } ?>
                        <tr>
                            <td>
                                <svg width="30" height="30" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="addfile" data-target="addfile-modal" onclick="toggleModal(event)">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M2.06935 5.00839C2 5.37595 2 5.81722 2 6.69975V13.75C2 17.5212 2 19.4069 3.17157 20.5784C4.34315 21.75 6.22876 21.75 10 21.75H14C17.7712 21.75 19.6569 21.75 20.8284 20.5784C22 19.4069 22 17.5212 22 13.75V11.5479C22 8.91554 22 7.59935 21.2305 6.74383C21.1598 6.66514 21.0849 6.59024 21.0062 6.51946C20.1506 5.75 18.8345 5.75 16.2021 5.75H15.8284C14.6747 5.75 14.0979 5.75 13.5604 5.59678C13.2651 5.5126 12.9804 5.39471 12.7121 5.24543C12.2237 4.97367 11.8158 4.56578 11 3.75L10.4497 3.19975C10.1763 2.92633 10.0396 2.78961 9.89594 2.67051C9.27652 2.15704 8.51665 1.84229 7.71557 1.76738C7.52976 1.75 7.33642 1.75 6.94975 1.75C6.06722 1.75 5.62595 1.75 5.25839 1.81935C3.64031 2.12464 2.37464 3.39031 2.06935 5.00839ZM12 11C12.4142 11 12.75 11.3358 12.75 11.75V13H14C14.4142 13 14.75 13.3358 14.75 13.75C14.75 14.1642 14.4142 14.5 14 14.5H12.75V15.75C12.75 16.1642 12.4142 16.5 12 16.5C11.5858 16.5 11.25 16.1642 11.25 15.75V14.5H10C9.58579 14.5 9.25 14.1642 9.25 13.75C9.25 13.3358 9.58579 13 10 13H11.25V11.75C11.25 11.3358 11.5858 11 12 11Z" fill="CurrentColor" />
                                </svg>
                            </td>
                            <td>---</td>
                            <td>---</td>
                            <td>---</td>
                        </tr>
                    </tbody>

                </table>
            </div>
        </section>
        <!-- Ajouter une fichier/dossier  -->

    </main>

    <!-- delete confirm -->
    <dialog id="modal-example">
        <article>
            <header>
                <button aria-label="Close" rel="prev" data-target="modal-example" onclick="toggleModal(event)"></button>
                <h3>Confirmation :</h3>
            </header>
            <span>Voulez vous vraiment supprimer le fichier : </span><span id="del-file-select">file</span>
            <span></span>
            <footer>
                <form method="post" action="./deletefile.php">
                    <input type="hidden" name="fileNamedele" value="">
                    <input type="hidden" name="filePathdele" value="">

                    <button role="button" class="secondary" data-target="modal-example" onclick="toggleModal(event)">
                        Annuler
                    </button>
                    <button id="confirm-d" autofocus data-target="modal-example">
                        Oui
                    </button>
                </form>

            </footer>
        </article>
    </dialog>

    <dialog id="addfile-modal">
        <article>
            <header>
                <button aria-label="Close" rel="prev" data-target="addfile-modal" onclick="toggleModal(event)"></button>
                <h3>Ajouter un Dossier/fichier :</h3>
            </header>
            <section id="accordions">
                <details class="upload" open name="upfolder">
                    <summary>• Ajouter un Dossier</summary>
                    <label for="upfolder">Nom du dossier</label>
                    <fieldset role="group">
                        <input type="text" id="upfolder" placeholder="Nom du dossier" />
                    </fieldset>
                </details>
                <form action="./uploadfile.php" method="POST" enctype="multipart/form-data">
                    <details class="upload" name="upfile">
                        <summary>• Ajouter un Fichier</summary>
                        <div class="grid">
                            <input type="file" id="upfile" name="file">
                            <input hidden type="text" name="path" value="<?php if (isset($_SESSION['fileselect'])) {
                                                                    echo "./cloud/". $_SESSION['fileselect'];
                                                                }else{
                                                                    echo "./cloud/";
                                                                } ?>">
                        </div>
                    </details>

            </section>
            <footer>
                <button autofocus data-target="addfile-modal" id="send-add-file">
                    Ajouter
                </button>
                </form>
            </footer>
        </article>
    </dialog>

</body>
<script src="../../js/theme.js"></script>
<script src="../../js/modal.js"></script>

<script src="./script.js"></script>

</html>