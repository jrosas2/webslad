<?php

namespace App;

enum ContactSubmissionStatus: string
{
    case Nuevo = 'NUEVO';
    case Contactado = 'CONTACTADO';
    case Cerrado = 'CERRADO';
}
