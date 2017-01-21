<?php

namespace DwSetpoint\Models;


class ConektaTC extends Conekta {
    protected function setExtraData(&$data, $extaInfo) {
        $data['details']['phone'] = $data['tel'];
    }
}