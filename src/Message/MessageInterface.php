<?php

namespace Bellal\VodafoneSMS\Message;

interface MessageInterface {
    public function send(array $data);
}
