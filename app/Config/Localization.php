<?php

namespace App\Config;

/**
 * Localization Configuration
 * Manage supported languages and locale settings
 */
class Localization
{
    /**
     * Default language
     */
    public string $defaultLanguage = 'en';

    /**
     * Supported languages
     * Array key: language code, Array value: language name
     */
    public array $supportedLanguages = [
        'en' => 'English',
        'es' => 'Español',
        'ko' => '한국어',
        'zh' => '中文',
        'pt' => 'Português',
        'ja' => '日本語',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'ar' => 'العربية',
        'id' => 'Bahasa Indonesia',
        'vi' => 'Tiếng Việt',
        'tr' => 'Türkçe',
        'ru' => 'Русский',
        'it' => 'Italiano',
        'hi' => 'Hindi',
    ];

    /**
     * Language names in native language
     */
    public array $languageNames = [
        'en' => 'English',
        'es' => 'Español',
        'ko' => '한국어',
        'zh' => '中文',
        'pt' => 'Português',
        'ja' => '日本語',
        'fr' => 'Français',
        'de' => 'Deutsch',
        'ar' => 'العربية',
        'id' => 'Bahasa Indonesia',
        'vi' => 'Tiếng Việt',
        'tr' => 'Türkçe',
        'ru' => 'Русский',
        'it' => 'Italiano',
        'hi' => 'हिन्दी',
    ];

    /**
     * Session key for current language
     */
    public string $sessionKey = 'app_language';

    /**
     * Cookie name for language preference
     */
    public string $cookieName = 'aisim_language';

    /**
     * Duration to store language preference in cookie (seconds)
     * 365 days
     */
    public int $cookieDuration = 31536000;
}
