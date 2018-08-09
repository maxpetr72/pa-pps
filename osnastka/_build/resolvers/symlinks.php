<?php
/** @var xPDOTransport $transport */
/** @var array $options */
/** @var modX $modx */
if ($transport->xpdo) {
    $modx =& $transport->xpdo;

    $dev = MODX_BASE_PATH . 'Extras/Osnastka/';
    /** @var xPDOCacheManager $cache */
    $cache = $modx->getCacheManager();
    if (file_exists($dev) && $cache) {
        if (!is_link($dev . 'assets/components/osnastka')) {
            $cache->deleteTree(
                $dev . 'assets/components/osnastka/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_ASSETS_PATH . 'components/osnastka/', $dev . 'assets/components/osnastka');
        }
        if (!is_link($dev . 'core/components/osnastka')) {
            $cache->deleteTree(
                $dev . 'core/components/osnastka/',
                ['deleteTop' => true, 'skipDirs' => false, 'extensions' => []]
            );
            symlink(MODX_CORE_PATH . 'components/osnastka/', $dev . 'core/components/osnastka');
        }
    }
}

return true;