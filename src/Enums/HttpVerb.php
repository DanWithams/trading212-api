<?php

namespace DanWithams\Trading212Api\Enums;

enum HttpVerb
{
    case GET;
    case POST;
    case PUT;
    case PATCH;
    case DELETE;
    case OPTIONS;
}
