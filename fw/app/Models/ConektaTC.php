<?php

namespace DwSetpoint\Models;


class ConektaTC extends Conekta {
    protected function setExtraData(&$data, $extraInfo) {
        $data['details']['phone'] = $data['tel'];
    }
}