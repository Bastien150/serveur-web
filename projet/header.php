<?php
if (file_exists('../../model/model.php')) {
  require_once('../../model/model.php');
  $user = initialiseUser();
} else if (file_exists('../model/model.php')) {
  require_once('../model/model.php');
  $user = initialiseUser();
} else if (file_exists('./model/model.php')) {
  require_once('./model/model.php');
  $user = initialiseUser();
}
?>

<head>
  <!-- Pico.css -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@2.0.6/css/pico.min.css" />
  <title><?php if (isset($user->nf)) {
            echo $user->nf;
          } ?></title>
</head>


<header class="container">
  <div class="icon">
    <?php if (isset($user->nf) && $user->nf == 'Cloud') { ?>
    <svg width="45" height="45" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" id="addfile" data-target="addfile-modal" onclick="toggleModal(event)">
      <path fill-rule="evenodd" clip-rule="evenodd" d="M2.06935 5.00839C2 5.37595 2 5.81722 2 6.69975V13.75C2 17.5212 2 19.4069 3.17157 20.5784C4.34315 21.75 6.22876 21.75 10 21.75H14C17.7712 21.75 19.6569 21.75 20.8284 20.5784C22 19.4069 22 17.5212 22 13.75V11.5479C22 8.91554 22 7.59935 21.2305 6.74383C21.1598 6.66514 21.0849 6.59024 21.0062 6.51946C20.1506 5.75 18.8345 5.75 16.2021 5.75H15.8284C14.6747 5.75 14.0979 5.75 13.5604 5.59678C13.2651 5.5126 12.9804 5.39471 12.7121 5.24543C12.2237 4.97367 11.8158 4.56578 11 3.75L10.4497 3.19975C10.1763 2.92633 10.0396 2.78961 9.89594 2.67051C9.27652 2.15704 8.51665 1.84229 7.71557 1.76738C7.52976 1.75 7.33642 1.75 6.94975 1.75C6.06722 1.75 5.62595 1.75 5.25839 1.81935C3.64031 2.12464 2.37464 3.39031 2.06935 5.00839ZM12 11C12.4142 11 12.75 11.3358 12.75 11.75V13H14C14.4142 13 14.75 13.3358 14.75 13.75C14.75 14.1642 14.4142 14.5 14 14.5H12.75V15.75C12.75 16.1642 12.4142 16.5 12 16.5C11.5858 16.5 11.25 16.1642 11.25 15.75V14.5H10C9.58579 14.5 9.25 14.1642 9.25 13.75C9.25 13.3358 9.58579 13 10 13H11.25V11.75C11.25 11.3358 11.5858 11 12 11Z" fill="CurrentColor" />
    </svg>
    <?php }?>
    <?php if (isset($user->nf) && $user->nf != 'Accueil') { ?>
      <a href="../../index.php">
        <svg width="46" height="46" fill="none" stroke-width="2" stroke="CurrentColor" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path d="M3 9.5 12 4l9 5.5"></path>
          <path d="M19 13v6.4a.6.6 0 0 1-.6.6H5.6a.6.6 0 0 1-.6-.6V13"></path>
        </svg>
      </a>

    <?php } ?>

  </div>
  <hgroup>
    <h1><?php
        if (isset($user->nf)) {
          echo $user->nf;
        } ?></h1>
  </hgroup>
  <nav>
    <ul>
      <li>
        <details class="dropdown">
          <summary role="button" class="secondary">Theme</summary>
          <ul>
            <li><a href="#" data-theme-switcher="auto">Auto</a></li>
            <li><a href="#" data-theme-switcher="light">Light</a></li>
            <li><a href="#" data-theme-switcher="dark">Dark</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </nav>
</header>