<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Calendrier</title>
  <script src="https://accounts.google.com/gsi/client" async defer></script>
</head>

<body>
<?php
  session_start();
      $_SESSION['file'] = basename(__DIR__);
      include_once('../header.php');
  ?>
  <div id="calendar-container">
    <div id="calendar-header">
      <button id="prev-month">&lt;</button>
      <h2 id="current-month"></h2>
      <button id="next-month">&gt;</button>
    </div>
    <table id="calendar-table">
      <thead>
        <tr>
          <th>Lun</th>
          <th>Mar</th>
          <th>Mer</th>
          <th>Jeu</th>
          <th>Ven</th>
          <th>Sam</th>
          <th>Dim</th>
        </tr>
      </thead>
      <tbody id="calendar-body">
        
      </tbody>
    </table>
    <div id="event-container"></div>
  </div>
  <script>
    // Initialisation de l'API Google Calendar
    function initGoogleCalendarAPI() {
      google.accounts.id.initialize({
        client_id: "121742285481-90kdije0bcrjkmovvakqeidsi61dtc59.apps.googleusercontent.com",
        scope: "https://www.googleapis.com/auth/calendar.readonly"
      });

      google.accounts.id.prompt((notification) => {
        if (notification.isNotDisplayed() || notification.isDismissed() || notification.isSkippedMoment()) {
          // L'utilisateur n'a pas autorisé l'accès au calendrier
          console.error("Impossible d'accéder au calendrier Google.");
        } else {
          // Chargement du calendrier
          loadCalendar();
        }
      });
    }

    // Chargement du calendrier
    function loadCalendar() {
      const currentDate = new Date();
      const currentMonth = currentDate.getMonth();
      const currentYear = currentDate.getFullYear();

      displayCalendar(currentMonth, currentYear);
      loadEvents(currentMonth, currentYear);
    }

    // Affichage du calendrier
    function displayCalendar(month, year) {
      const calendarBody = document.getElementById('calendar-body');
      calendarBody.innerHTML = '';

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      let date = 1;
      for (let i = 0; i < 6; i++) {
        const row = document.createElement('tr');
        for (let j = 0; j < 7; j++) {
          const cell = document.createElement('td');
          if (i === 0 && j < firstDay) {
            cell.textContent = '';
          } else if (date > daysInMonth) {
            break;
          } else {
            cell.textContent = date;
            if (date === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
              cell.classList.add('current-day');
            }
            date++;
          }
          row.appendChild(cell);
        }
        calendarBody.appendChild(row);
      }

      document.getElementById('current-month').textContent = `${getMonthName(month)} ${year}`;
    }

    // Chargement des événements du calendrier Google
    function loadEvents(month, year) {
      const eventContainer = document.getElementById('event-container');
      eventContainer.innerHTML = '';

      gapi.client.calendar.events.list({
        'calendarId': 'primary',
        'timeMin': new Date(year, month, 1).toISOString(),
        'timeMax': new Date(year, month + 1, 0).toISOString(),
        'showDeleted': false,
        'singleEvents': true,
        'maxResults': 10,
        'orderBy': 'startTime'
      }).then(function(response) {
        const events = response.result.items;
        if (events.length > 0) {
          events.forEach(function(event) {
            const eventElement = document.createElement('div');
            eventElement.classList.add('event');
            eventElement.textContent = event.summary;
            eventContainer.appendChild(eventElement);
          });
        } else {
          const noEventsElement = document.createElement('div');
          noEventsElement.classList.add('event');
          noEventsElement.textContent = 'Aucun événement pour ce mois.';
          eventContainer.appendChild(noEventsElement);
        }
      });
    }

    // Fonctions utilitaires
    function getMonthName(month) {
      const monthNames = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
      return monthNames[month];
    }

    // Initialisation du calendrier
    gapi.load('client', initGoogleCalendarAPI);
  </script>
  <style>
    #calendar-container {
      width: 80%;
      margin: 0 auto;
      font-family: Arial, sans-serif;
    }

    #calendar-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    #calendar-table {
      width: 100%;
      border-collapse: collapse;
    }

    #calendar-table th, #calendar-table td {
      padding: 10px;
      text-align: center;
      border: 1px solid #ddd;
    }

    #calendar-table td.current-day {
      background-color: #f2f2f2;
    }

    #event-container {
      margin-top: 20px;
    }

    .event {
      background-color: #f2f2f2;
      padding: 10px;
      margin-bottom: 10px;
    }
  </style>
</body>
<script src="./../../js/theme.js"></script>
</html>


