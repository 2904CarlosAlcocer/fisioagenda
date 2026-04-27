<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('recordatorios:procesar')->everyMinute();