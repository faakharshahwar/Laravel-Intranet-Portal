@extends('layouts.app')
@section('pageTitle')
    Upcoming Travel Schedule
@endsection

@section('content')
    <div class="container py-4">
        <h1 class="mb-3">Upcoming Travel Schedule</h1>

        <div id="calendar"></div>
    </div>

    {{-- FullCalendar CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.14/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.14/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.14/main.min.css" rel="stylesheet">

    {{-- FullCalendar JS (global builds) --}}
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.14/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.14/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/list@6.1.14/index.global.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            // If scripts didn’t load for some reason, bail early with a clear message
            if (!window.FullCalendar) {
                console.error('FullCalendar global not found. Check the CDN <script> tags.');
                return;
            }

            const calendar = new FullCalendar.Calendar(calendarEl, {
                // ❌ remove: plugins: [ dayGridPlugin, listPlugin ],
                initialView: 'dayGridMonth',
                timeZone: 'Asia/Dubai',
                firstDay: 6,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,listWeek'
                },
                height: 'auto',
                navLinks: true,
                selectable: false,
                displayEventEnd: true,

                eventSources: [{
                    url: '{{ route('api.reports.travel.events') }}',
                    extraParams: () => ({_dbg: 1}),
                    failure: (err) => {
                        console.error('Event feed failed', err);
                        alert('Failed to load events');
                    }
                }],

                eventSourceSuccess: function (content, xhr) {
                    console.log('Events fetched:', Array.isArray(content) ? content.length : content, content);
                    return content;
                },

                eventClick: function (info) {
                    if (info.event.url) {
                        window.open(info.event.url, '_blank');
                    }
                    info.jsEvent.preventDefault();
                },

                eventDidMount: function (info) {
                    const p = info.event.extendedProps || {};
                    const html = `
          <div style="font-weight:600;margin-bottom:4px;">${info.event.title}</div>
          <div><strong>Destination:</strong> ${p.destination ?? '-'}</div>
          <div><strong>Purpose:</strong> ${p.purpose ?? '-'}</div>
          <div><strong>Dates:</strong> ${p.start_date ?? ''} → ${p.end_date ?? ''}</div>
          <div><strong>Risk:</strong> ${p.risk ?? '-'}</div>
        `;
                    info.el.setAttribute('title', html.replace(/<[^>]*>?/gm, ''));
                },

                eventContent: function (arg) {
                    const p = arg.event.extendedProps || {};
                    const inner = document.createElement('div');
                    inner.style.fontSize = '12px';
                    inner.style.lineHeight = '1.2';
                    inner.innerHTML = `
          <div style="font-weight:600">${arg.event.title}</div>
          <div>${p.destination ? p.destination : ''}</div>
        `;
                    return {domNodes: [inner]};
                }
            });

            calendar.render();
        });
    </script>

@endsection

