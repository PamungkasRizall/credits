<?php

namespace App\Enums;

enum CourseStatusEnum: int {
    case DRAFT = 0;
    case DPW = 1;
    case DPP = 2;
    case SIAKPEL = 3;
    case MODULE = 4;
    case LMS = 5;
    case DONE = 6;

    public function description(): array
    {
        return match($this)
        {
            self::DRAFT => ['Draft', 'warning', 'fa-regular fa-clock'],
            self::DPW => ['DPW', 'info', 'fa fa-hourglass-half'],
            self::DPP => ['DPP', 'secondary', 'fa fa-hourglass-end'],
            self::SIAKPEL => ['Proses SIAKPEL', 'warning', 'fa-regular fa-bookmark'],
            self::MODULE => ['Isi Konten', 'default', 'fa fa-list'],
            self::LMS => ['Proses LMS', 'error', 'fa-regular fa-circle-play'],
            self::DONE => ['Selesai', 'success', 'fa fa-check-double'],
        };
    }
}
