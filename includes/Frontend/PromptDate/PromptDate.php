<?php

namespace Boostimer\Frontend\PromptDate;

use Boostimer\Admin\Settings;

/**
 * Interface PromptDate
 *
 * @since 1.1.0
 */
abstract class PromptDate {

    /**
     * @var string
     */
    protected $key;

    /**
     * The constructor.
     *
     * @since 1.1.0
     */
    public function __construct() {
        add_action( 'woocommerce_after_shop_loop_item_title', [ $this, 'render' ] );
    }

    /**
     * Gets formatted prompt date.
     *
     * @return string
     * @throws \Exception
     */
    abstract public function get_formatted_prompt_date();

    /**
     * Determine if the prompt date can be rendered.
     *
     * @return bool
     * @throws \Exception
     */
    abstract public function can_be_rendered();

    /**
     * Render the prompt date.
     *
     * @return void
     */
    public function render() {
        try {
            if ( ! $this->is_prompt_enabled() ) {
                throw new \Exception( 'Prompt date is not enabled.' );
            }

            $this->can_be_rendered();

            $prompt_date = $this->get_formatted_prompt_date();

            boostimer_get_template_part(
                'prompt-date',
                '',
                [
                    'prompt_date' => $prompt_date,
                ]
            );
        } catch ( \Exception $e ) {}
    }

    /**
     * Gets formatted date string.
     *
     * @param $title
     * @param $formatted_date
     *
     * @return string
     */
    public function get_formatted_date_string( $title, $formatted_date ) {
        return sprintf( '%s %s', $title, $formatted_date );
    }


    /**
     * Gets the prompt date settings.
     *
     * @return array
     */
    protected function get_prompt_date_settings() {
        return Settings::get( $this->key );
    }

    /**
     * Checks if the prompt date is enabled.
     *
     * @return bool
     */
    protected function is_prompt_enabled() {
        $settings = Settings::get( $this->key );

        return isset( $settings['enabled'] ) ? $settings['enabled'] : false;
    }
}
