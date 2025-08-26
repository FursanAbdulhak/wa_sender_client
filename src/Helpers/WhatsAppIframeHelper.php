<?php

namespace Alareqi\FilamentWhatsapp\Helpers;

use Illuminate\View\View;

class WhatsAppIframeHelper
{
    /**
     * Get WhatsApp iframe view with parameters
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @param array $additionalParams Additional parameters to pass to the view
     * @return View
     */
    public static function getIframeView(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null,
        array $additionalParams = []
    ): View {
        // Use default base URL if not provided
        $baseUrl = $baseUrl ?: config('wa-sender-client.apiUrl', 'http://127.0.0.1:8000');

        // Build the iframe URL with parameters
        $url = self::buildIframeUrl($baseUrl, $email, $password);

        // Merge default parameters with additional ones
        $viewData = array_merge([
            'url' => $url,
            'email' => $email,
            'password' => $password,
            'baseUrl' => $baseUrl
        ], $additionalParams);

        return view('wa-sender-client::iframe', $viewData);
    }

    /**
     * Get iframe URL with parameters (without the view wrapper)
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @return string
     */
    public static function getIframeUrl(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null
    ): string {
        $baseUrl = $baseUrl ?: config('wa-sender-client.apiUrl', 'http://127.0.0.1:8000');
        return self::buildIframeUrl($baseUrl, $email, $password);
    }



    /**
     * Generate HTML iframe tag
     *
     * @param string|null $email User email
     * @param string|null $password User password
     * @param string|null $baseUrl Base URL for WhatsApp client
     * @param array $attributes Additional HTML attributes for iframe
     * @return string
     */
    public static function generateIframeHtml(
        ?string $email = null,
        ?string $password = null,
        ?string $baseUrl = null,
        array $attributes = []
    ): string {
        $src = self::getIframeUrl($email, $password, $baseUrl);

        // Default iframe attributes
        $defaultAttributes = [
            'src' => $src,
            'width' => '100%',
            'height' => '600px',
            'frameborder' => '0',
            'loading' => 'lazy',
            'sandbox' => 'allow-same-origin allow-scripts allow-forms allow-popups allow-top-navigation'
        ];

        // Merge with custom attributes
        $attributes = array_merge($defaultAttributes, $attributes);

        // Build attribute string
        $attributeString = '';
        foreach ($attributes as $key => $value) {
            $attributeString .= sprintf(' %s="%s"', $key, htmlspecialchars($value));
        }

        return sprintf('<iframe%s></iframe>', $attributeString);
    }

    /**
     * Build the iframe URL with parameters
     *
     * @param string $baseUrl Base URL
     * @param string|null $email User email
     * @param string|null $password User password
     * @return string
     */
    private static function buildIframeUrl(string $baseUrl, ?string $email = null, ?string $password = null): string
    {
        $url = rtrim($baseUrl, '/');

        $params = [];

        if ($email) {
            $params['email'] = $email;
        }

        if ($password) {
            $params['password'] = $password;
        }

        if (!empty($params)) {
            $url .= '/?' . http_build_query($params);
        }

        return $url;
    }

    /**
     * Validate parameters
     *
     * @param string|null $email
     * @param string|null $password
     * @param string|null $baseUrl
     * @return array Array of validation errors (empty if valid)
     */
    public static function validateParameters(?string $email = null, ?string $password = null, ?string $baseUrl = null): array
    {
        $errors = [];

        if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Invalid email format';
        }

        if ($baseUrl && !filter_var($baseUrl, FILTER_VALIDATE_URL)) {
            $errors[] = 'Invalid base URL format';
        }

        return $errors;
    }
}
