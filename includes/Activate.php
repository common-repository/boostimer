<?php

namespace Boostimer;

/**
 * Handles Activation the plugin
 *
 * @since 1.1.0
 */
class Activate {

    /**
     * Activates the plugin.
     *
     * @return void
     */
    public function __construct() {
        register_activation_hook( BOOSTIMER_PLUGIN_FILE, [ $this, 'activate' ] );
    }

    /**
     * Activate plugin.
     *
     * @return void
     */
    public function activate() {
        $installer = new Install();
        $installer->run();
    }
}
