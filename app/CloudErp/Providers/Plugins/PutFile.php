<?php


namespace App\CloudErp\Providers\Plugins;

use Illuminate\Support\Facades\Log;
use League\Flysystem\Config;
use League\Flysystem\Plugin\AbstractPlugin;

class PutFile extends AbstractPlugin
{

    /**
     * Get the method name.
     *
     * @return string
     */
    public function getMethod()
    {
        return 'putFile';
    }

    public function handle($path, $filePath, array $options = [])
    {
        $config = new Config($options);
        if (method_exists($this->filesystem, 'getConfig')) {
            $config->setFallback($this->filesystem->getConfig());
        }

        return (bool)$this->filesystem->getAdapter()->writeFile($path, $filePath, $config);
    }
}
