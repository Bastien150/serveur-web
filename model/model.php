<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
class User
{
    public $nf; 

    public function __construct()
    {
        // Récupérer le du fichier
        $this->getNF();
    }

    public function getNF()
    {
        if (isset($_SESSION['file'])) {
            $this->nf = $_SESSION['file'];
        }
    }
}
function initialiseUser()
{
    return new User();
}

function size($file_size){
    if ($file_size < 1024) {
        return $file_size . ' o';
    } elseif ($file_size < 1048576) {
        return round($file_size / 1024, 2) . ' Ko';
    } elseif ($file_size < 1073741824) {
        return round($file_size / 1048576, 2) . ' Mo';
    } else {
        return round($file_size / 1073741824, 2) . ' Go';
    }
}

function folder(){
    
}