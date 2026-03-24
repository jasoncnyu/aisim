<?php

use App\Helpers\LanguageHelper;

if (!function_exists('lang')) {
    /**
     * Helper function to get language string
     */
    function lang(string $key, array $args = []): string
    {
        return service('language')->getLine($key, $args);
    }
}

if (!function_exists('currentLang')) {
    /**
     * Get current language code
     */
    function currentLang(): string
    {
        return LanguageHelper::getCurrentLanguage();
    }
}

if (!function_exists('setLang')) {
    /**
     * Set current language
     */
    function setLang(string $language): bool
    {
        return LanguageHelper::setLanguage($language);
    }
}

if (!function_exists('getLanguageName')) {
    /**
     * Get language name
     */
    function getLanguageName(string $language, bool $native = true): string
    {
        return LanguageHelper::getLanguageName($language, $native);
    }
}

if (!function_exists('getSupportedLanguages')) {
    /**
     * Get all supported languages
     */
    function getSupportedLanguages(): array
    {
        return LanguageHelper::getSupportedLanguages();
    }
}

if (!function_exists('langUrl')) {
    /**
     * Build language-specific URL for current path
     */
    function langUrl(string $language): string
    {
        return LanguageHelper::getLanguageUrl($language);
    }
}
