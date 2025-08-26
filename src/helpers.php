<?php

use Alareqi\FilamentWhatsapp\Helpers\WhatsAppIframeHelper;
use Illuminate\View\View;

if (!function_exists('whatsapp_iframe_view')) {
    /**
     * Get WhatsApp iframe view
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @param array $additionalParams Additional parameters to pass to the view
     * @return View
     */
    function whatsapp_iframe_view(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null,
        array $additionalParams = []
    ): View {
        return WhatsAppIframeHelper::getIframeView($email, $password, $baseUrl, $additionalParams);
    }
}

if (!function_exists('whatsapp_iframe_url')) {
    /**
     * Get WhatsApp iframe URL
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @return string
     */
    function whatsapp_iframe_url(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null
    ): string {
        return WhatsAppIframeHelper::getIframeUrl($email, $password, $baseUrl);
    }
}



if (!function_exists('whatsapp_iframe_html')) {
    /**
     * Generate WhatsApp iframe HTML
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @param array $attributes Additional HTML attributes for iframe
     * @return string
     */
    function whatsapp_iframe_html(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null,
        array $attributes = []
    ): string {
        return WhatsAppIframeHelper::generateIframeHtml($email, $password, $baseUrl, $attributes);
    }
}
