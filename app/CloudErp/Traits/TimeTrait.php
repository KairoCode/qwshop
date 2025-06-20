<?php
namespace App\CloudErp\Traits;

trait TimeTrait
{
    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
