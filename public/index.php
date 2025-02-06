<?php

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

error_log(print_r(getallheaders(), true));

Request::setTrustedProxies(
    [$_SERVER['REMOTE_ADDR']],
    Request::HEADER_X_FORWARDED_FOR | Request::HEADER_X_FORWARDED_PROTO | Request::HEADER_X_FORWARDED_HOST
);

Request::setTrustedHosts([getenv('APP_URL')]);

error_log("SERVER DATA" . print_r($_SERVER,true));
error_log("REQUEST HEADERS" . print_r(getallheaders(),true));

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
