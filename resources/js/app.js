import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import interactionPlugin from '@fullcalendar/interaction';

document.addEventListener('DOMContentLoaded', function () {
    const calendarEl = document.getElementById('calendar');

    if (!calendarEl) return;

    const calendar = new Calendar(calendarEl, {
        plugins: [dayGridPlugin, timeGridPlugin, interactionPlugin],

        initialView: 'timeGridWeek',
        locale: 'es',
        height: 'auto',
        editable: true,
        selectable: true,
        nowIndicator: true,
        allDaySlot: false,

        slotMinTime: '07:00:00',
        slotMaxTime: '17:00:00',
        slotDuration: '00:30:00',

        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },

        buttonText: {
            today: 'Hoy',
            month: 'Mes',
            week: 'Semana',
            day: 'Día'
        },

        events: '/citas-eventos',

        eventDidMount: function (info) {
            info.el.style.borderRadius = '12px';
            info.el.style.padding = '4px';
            info.el.style.boxShadow = '0 8px 20px rgba(0,0,0,0.15)';
            info.el.style.cursor = 'pointer';
        },

        eventClick: function (info) {
            const props = info.event.extendedProps;

            document.getElementById('modalPaciente').innerText = props.paciente;
            document.getElementById('modalFisio').innerText = props.fisio;
            document.getElementById('modalSala').innerText = props.sala;
            document.getElementById('modalEstado').innerText = props.estado;
            document.getElementById('modalMotivo').innerText = props.motivo ?? 'Sin motivo';
            document.getElementById('modalObservaciones').innerText = props.observaciones ?? 'Sin observaciones';
            document.getElementById('modalHora').innerText = `${props.hora_inicio} - ${props.hora_fin}`;
            document.getElementById('modalEditar').href = props.edit_url;

            document.getElementById('citaModal').classList.remove('hidden');
        },

        eventDrop: function (info) {
            moverCita(info);
        },

        eventResize: function (info) {
            moverCita(info);
        },
    });

    calendar.render();

    window.cerrarModalCita = function () {
        document.getElementById('citaModal').classList.add('hidden');
    };

    function moverCita(info) {
        const evento = info.event;

        const start = evento.start;
        const end = evento.end;

        const fecha = start.toISOString().split('T')[0];
        const horaInicio = start.toTimeString().slice(0, 5);
        const horaFin = end.toTimeString().slice(0, 5);

        fetch(`/citas/${evento.id}/mover`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                fecha: fecha,
                hora_inicio: horaInicio,
                hora_fin: horaFin,
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al mover cita');
            }
            return response.json();
        })
        .then(data => {
            console.log(data.message);
        })
        .catch(error => {
            alert('No se pudo mover la cita');
            info.revert();
        });
    }
});