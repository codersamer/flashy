<?php

namespace Codersamer\Flashy\Enums;

enum MessageTypes : String
{
    case Success = 'success';
    case Warning = 'warning';
    case Info = 'info';
    case Log = 'log';
    case Error = 'error';
    case Debug = 'debug';
}
