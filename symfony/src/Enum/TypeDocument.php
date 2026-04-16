<?php

namespace App\Enum;

enum TypeDocument: string
{
    case PDF = 'pdf';
    case DOC = 'doc';
    case DOCX = 'docx';
    case XLS = 'xls';
    case XLSX = 'xlsx';
    case PPT = 'ppt';
    case PPTX = 'pptx';
    
}