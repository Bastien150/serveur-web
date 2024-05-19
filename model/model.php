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

function size($file_size)
{
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

function percentsize()
{
    $chemin = "/"; // Ou "C:/" sur Windows
    $total = disk_total_space($chemin);
    $libre = disk_free_space($chemin);
    $utilise = $total - $libre;
    $pourcentage_utilise = ($utilise / $total) * 100;

    // Fonction pour formater les octets en unités lisibles
    return round($pourcentage_utilise, 2);
}

function freesize(){
    $libre = disk_free_space("./");

    function formatBytes($bytes, $precision = 2)
    {
        $units = array('o', 'Ko', 'Mo', 'Go', 'To');
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    return formatBytes($libre);
}
