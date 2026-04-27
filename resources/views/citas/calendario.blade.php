<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-bold text-2xl text-gray-800">
                    Calendario de Citas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Agenda visual de FisioAgenda Pro
                </p>
            </div>

            <a href="{{ route('citas.create') }}"
               class="w-full sm:w-auto text-center px-5 py-2.5 bg-pink-500 hover:bg-pink-600 text-white rounded-xl shadow-sm transition">
                + Nueva cita
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-3 sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-5 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white rounded-2xl sm:rounded-3xl shadow-sm border border-gray-100 p-3 sm:p-6">
                <div class="mb-5 flex flex-wrap gap-2 sm:gap-3">
                    <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs sm:text-sm">
                        Pendiente
                    </span>
                    <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs sm:text-sm">
                        Confirmada
                    </span>
                    <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs sm:text-sm">
                        Atendida
                    </span>
                    <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs sm:text-sm">
                        Cancelada
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <div id="calendar" class="min-w-[850px] sm:min-w-0"></div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/locales/es.global.min.js"></script>

    <style>
        .fc {
            font-family: inherit;
        }

        .fc-toolbar {
            gap: 12px;
            flex-wrap: wrap;
        }

        .fc-toolbar-title {
            font-size: 1.15rem !important;
            font-weight: 800;
            color: #374151;
        }

        @media (min-width: 640px) {
            .fc-toolbar-title {
                font-size: 1.5rem !important;
            }
        }

        .fc-button {
            background: #ec4899 !important;
            border: none !important;
            border-radius: 12px !important;
            padding: 8px 12px !important;
            font-weight: 600 !important;
            box-shadow: none !important;
        }

        .fc-button:hover {
            background: #db2777 !important;
        }

        .fc-button-active {
            background: #be185d !important;
        }

        .fc-day-today {
            background: #fdf2f8 !important;
        }

        .fc-event {
            border: none !important;
            border-radius: 10px !important;
            padding: 4px 6px !important;
            font-size: 12px !important;
            cursor: pointer;
        }

        .fc-event-title {
            font-weight: 600;
        }

        .fc-col-header-cell {
            background: #f9fafb;
            padding: 10px 0 !important;
        }

        .fc-col-header-cell-cushion {
            color: #6b7280;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 11px;
        }

        .fc-daygrid-day-number {
            color: #374151;
            font-weight: 600;
        }

        .fc-timegrid-slot {
            height: 42px !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');

            const calendar = new FullCalendar.Calendar(calendarEl, {
                locale: 'es',
                initialView: window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek',
                height: 'auto',
                selectable: true,
                nowIndicator: true,
                slotMinTime: '07:00:00',
                slotMaxTime: '18:00:00',
                allDaySlot: false,

                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },

                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },

                events: "{{ route('citas.eventos') }}",

                select: function(info) {
                    window.location.href = "{{ route('citas.create') }}" + "?inicio=" + encodeURIComponent(info.startStr);
                },

                eventClick: function(info) {
                    if (info.event.url) {
                        info.jsEvent.preventDefault();
                        window.location.href = info.event.url;
                    }
                },

                eventDidMount: function(info) {
                    const motivo = info.event.extendedProps.motivo || '';
                    const sala = info.event.extendedProps.sala || '';

                    let tooltip = info.event.title;

                    if (sala) {
                        tooltip += ' | Sala: ' + sala;
                    }

                    if (motivo) {
                        tooltip += ' | Motivo: ' + motivo;
                    }

                    info.el.setAttribute('title', tooltip);
                }
            });

            calendar.render();
        });
    </script>
</x-app-layout>