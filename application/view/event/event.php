<!DOCTYPE html>
<html>
 <head>
  <title>Etkinlik Yöneticisi</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.0/fullcalendar.min.js"></script>
  <script>
  var url = "<?php echo URL;?>";
  $(document).ready(function() {
   var calendar = $('#calendar').fullCalendar({
    buttonText: {
                today:    'Bugün',
                month:    'Ay',
                week:     'Hafta',
                day:      'Gün',
                list:     'Liste',
                listMonth: 'Aylık Liste',
                listYear: 'Yıllık Liste',
                listWeek: 'Haftalık Liste',
                listDay: 'Günlük Liste'
        },
    monthNames: ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
    monthNamesShort: ['Ocak','Şubat','Mart','Nisan','Mayıs','Haziran','Temmuz','Ağustos','Eylül','Ekim','Kasım','Aralık'],
    dayNames: ['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'],
    dayNamesShort: ['Pazar','Pazartesi','Salı','Çarşamba','Perşembe','Cuma','Cumartesi'],
    editable:true,
    header:{
        left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek,basicDay'
    },
    defaultDate: '01.01.2022',
    navLinks: true,
    editable: true,
    eventLimit: true, 
    events: url + 'event/load',
    selectable:true,
    selectHelper:true,
    allDayDefault:true,
    select: function(start, end, allDay)
    {
     var title = prompt("Etkinlik Adı:");
     if(title)
     {
      var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
      var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
      $.ajax({
       url: url + 'event/insert',
       type:"POST",
       data:{title:title, start:start, end:end},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Etkinlik eklendi");
       }
      })
     }
    },
    editable:true,
    eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url: url + 'event/update',
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
       alert('Etkinlik Güncelle');
      }
     })
    },

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url: url + 'event/update',
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
       alert("Etkinlik Güncellendi");
      }
     });
    },

    eventClick:function(event,i,e)
    {
	 console.log(event);
	 console.log(i);
	 console.log(e);
     if(confirm("Silmek istediğinize emin misiniz?"))
     {
      var id = event.id;
      $.ajax({
       url: url + 'event/delete',
       type:"POST",
       data:{id:id},
       success:function()
       {
        calendar.fullCalendar('refetchEvents');
        alert("Etkinlik kaldırıldı");
       }
      })
     }
    },

   });
  });
   
  </script>
  
 </head>
 <body>
  <br />
  <h2 align="center"><a href="#">Etkinlik Yöneticisi</a></h2>
  <br />
  <div class="container">
   <div id="calendar"></div>
  </div>
 </body>
</html>