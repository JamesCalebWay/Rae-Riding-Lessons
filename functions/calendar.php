<?php
    session_start();

    // Checks if user is logged in.
    $user_data = check_login($con);

    // Gets the current page's url.
    $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);  
    $UID = $user_data['user_id'];

    if ($curPageName == "lesson.php") // On lessons page.
    {
      // Available lessons.
      if ($user_data['level'] == "Admin") // Admin
      {
        $query = "SELECT * FROM `events`";
      }
      else if ($user_data['level'] == "Beginner") // Beginner
      {
        $query = "SELECT * FROM `events` WHERE level='Beginner' EXCEPT SELECT * FROM `events` WHERE slots='full'";
      }
      else if ($user_data['level'] == "Intermediate") // Intermediate
      {
        $query = "SELECT * FROM `events` WHERE level='Intermediate' EXCEPT SELECT * FROM `events` WHERE slots='full'";
      }
      else if ($user_data['level'] == "Advanced") // Advanced
      {
        $query = "SELECT * FROM `events` WHERE level='Advanced' EXCEPT SELECT * FROM `events` WHERE slots='full'";
      }
      else // Broke things
      {
        echo "You suck so much you don't have a skill level!";
      }
    }
    else if ($curPageName == "userProfile.php") // On profile page.
    {
      $query = "SELECT * FROM `events` WHERE user1='$UID' OR user2='$UID'";
    }
    else if ($curPageName == "adminProfile.php") // On admin page.
    {
      $query = "SELECT * FROM `events`";
    }
    else
    {
      echo "Well this Sucks!";
    }
    
    $result = mysqli_query($con,$query);
    $lessonData = array();
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
      $lessonData[] = $row;
    }
  
  // Calendar modified from Code And Create video. Uploaded May 30, 2020.
  // https://www.youtube.com/watch?v=o1yMqPyYeAo&list=PLhPKOwmzo9sG9x8THn1aLuDbJHah5dyyP&index=7
  function calendar()
  {
    echo "<body>
          <div class='container'>
            <div class='calendar'>
              <div class='month'>
                <i class='fas fa-angle-left prev'></i>
                <div class='date'>
                  <h1></h1>
                  <p></p>
                </div>
                <i class='fas fa-angle-right next'></i>
              </div>
              <div class='weekdays'>
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>
              </div>
              <div class='days'></div>
            </div>
          </div>
      
          <script type='text/javascript'>calendarPrint()</script>
        </body>
      </html>";
  }
?>

<script type='text/javascript'>

  function calendarPrint()
  {
    // Calendar modified from Code And Create video. Uploaded May 30, 2020.
    // https://www.youtube.com/watch?v=o1yMqPyYeAo&list=PLhPKOwmzo9sG9x8THn1aLuDbJHah5dyyP&index=7

    const date = new Date();

    const renderCalendar = () => {
    date.setDate(1);

    const monthDays = document.querySelector('.days');

    const lastDay = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
    ).getDate();

    const prevLastDay = new Date(
        date.getFullYear(),
        date.getMonth(),
        0
    ).getDate();

    const firstDayIndex = date.getDay();

    const lastDayIndex = new Date(
        date.getFullYear(),
        date.getMonth() + 1,
        0
    ).getDay();

    const nextDays = 7 - lastDayIndex - 1;

    const months = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];

    document.querySelector('.date h1').innerHTML = months[date.getMonth()];

    document.querySelector('.date p').innerHTML = new Date().toDateString();

    let days = '';

    for (let x = firstDayIndex; x > 0; x--) {
        var lessonName = dateSelctor((prevLastDay - x + 1), (date.getMonth()), date.getFullYear());
        var description = lessonDescription((prevLastDay - x + 1), (date.getMonth()), date.getFullYear());
        days += `<div class='prev-date tooltip'><span class='tooltiptext'>${description}</span>${prevLastDay - x + 1}<br>${lessonName}</div>`;
    }

    for (let i = 1; i <= lastDay; i++) {
        if (
        i === new Date().getDate() &&
        date.getMonth() === new Date().getMonth()
        ) {
        var lessonName = dateSelctor(i, (date.getMonth() + 1), date.getFullYear());
        var description = lessonDescription(i, (date.getMonth() + 1), date.getFullYear());
        days += `<div class='today tooltip'><span class='tooltiptext'>${description}</span>${i}<br>${lessonName}</div>`;
        } else {
          var lessonName = dateSelctor(i, (date.getMonth() + 1), date.getFullYear());
          var description = lessonDescription(i, (date.getMonth() + 1), date.getFullYear());
          days += `<div class='tooltip'><span class='tooltiptext'>${description}</span>${i}<br>${lessonName}</div>`;
        }
    }

    for (let j = 1; j <= nextDays; j++) {
        var lessonName = dateSelctor(j, (date.getMonth() + 2), date.getFullYear());
        var description = lessonDescription(j, (date.getMonth() + 2), date.getFullYear());
        days += `<div class='next-date tooltip'><span class='tooltiptext'>${description}</span>${j}<br>${lessonName}</div>`;
      }
      monthDays.innerHTML = days;
    };

    document.querySelector('.prev').addEventListener('click', () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
    });

    document.querySelector('.next').addEventListener('click', () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
    });

    renderCalendar();
  }

  function dateSelctor(date, month, year)
  {
    var lesson_data = <?php echo json_encode($lessonData); ?>;
    let fLen = lesson_data.length;

    for (let i = 0; i < fLen; i++)
    {
      var Ldate = lesson_data[i].date;
      var Ltitle = lesson_data[i].title;

      if (Ldate.substring(8, 10) == date && Ldate.substring(5, 7) == month
            && Ldate.substring(0, 4) == year) // YYYY-MM-DD
      {
        return Ltitle;
      }
    }
    
    return "";
  }

  function lessonDescription(date, month, year)
  {
    var lesson_data = <?php echo json_encode($lessonData); ?>;
    let fLen = lesson_data.length;

    for (let i = 0; i < fLen; i++)
    {
      var Ldate = lesson_data[i].date;
      var Ldescription = lesson_data[i].description;
      var Lstart = lesson_data[i].start_time;
      var Lend = lesson_data[i].end_time;
      
      var sfront = Lstart.slice(0, -6);
      var smid = Lstart.slice(3, -3);
      var efront = Lend.slice(0, -6);
      var emid = Lend.slice(3, -3);

      if (sfront == 24)
      {
        sfront = 12;
        smid = smid + ' AM';
      }
      else if (sfront > 12)
      {
        sfront = sfront % 12;
        smid = smid + ' PM';
      }
      else
      {
        smid = smid + ' AM';
      }

      if (efront == 24)
      {
        efront = 12;
        emid = emid + ' AM';
      }
      else if (efront > 12)
      {
        efront = efront % 12;
        emid = emid + ' PM';
      }
      else
      {
        emid = emid + ' AM';
      }
      
      var Ltime =  sfront + ':' + smid + '—' + efront + ":" + emid;

      if (Ldate.substring(8, 10) == date && Ldate.substring(5, 7) == month
            && Ldate.substring(0, 4) == year) // YYYY-MM-DD
      {
        return Ldescription + '\n' + Ltime;
      }
    }
    
    return "";
  }
</script>