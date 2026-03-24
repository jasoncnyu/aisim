<?php

namespace App\Helpers;

use App\Config\Localization;

/**
 * Language Helper
 * Helper functions for multi-language support
 */
class LanguageHelper
{
    protected static ?string $currentLanguage = null;
    protected static ?Localization $config = null;

    /**
     * Get current language
     */
    public static function getCurrentLanguage(): string
    {
        if (self::$currentLanguage !== null) {
            return self::$currentLanguage;
        }

        $config = self::getConfig();
        $session = session();
        
        // Check session first
        if ($session->has($config->sessionKey)) {
            self::$currentLanguage = $session->get($config->sessionKey);
            return self::$currentLanguage;
        }

        // Check cookie
        $request = service('request');
        $cookie = $request->getCookie($config->cookieName);
        if ($cookie && self::isValidLanguage($cookie)) {
            self::$currentLanguage = $cookie;
            $session->set($config->sessionKey, $cookie);
            return self::$currentLanguage;
        }

        // Check URL parameter
        $language = $request->getGet('lang');
        if ($language && self::isValidLanguage($language)) {
            self::setLanguage($language);
            return self::$currentLanguage;
        }

        // Check Accept-Language header
        $acceptLanguage = $request->getHeader('Accept-Language')?->getValue() ?? '';
        $preferredLanguage = self::extractLanguageFromHeader($acceptLanguage);
        if ($preferredLanguage) {
            self::setLanguage($preferredLanguage);
            return self::$currentLanguage;
        }

        // Default language
        self::$currentLanguage = $config->defaultLanguage;
        $session->set($config->sessionKey, self::$currentLanguage);
        return self::$currentLanguage;
    }

    /**
     * Set current language
     */
    public static function setLanguage(string $language): bool
    {
        if (!self::isValidLanguage($language)) {
            return false;
        }

        self::$currentLanguage = $language;
        
        // Store in session
        $config = self::getConfig();
        $session = session();
        $session->set($config->sessionKey, $language);

        // Store in cookie
        $response = service('response');
        $response->setCookie(
            $config->cookieName,
            $language,
            $config->cookieDuration,
            '',
            '/',
            false,
            true
        );

        return true;
    }

    /**
     * Check if language is valid
     */
    public static function isValidLanguage(string $language): bool
    {
        $config = self::getConfig();
        return isset($config->supportedLanguages[$language]);
    }

    /**
     * Get all supported languages
     */
    public static function getSupportedLanguages(): array
    {
        return self::getConfig()->supportedLanguages;
    }

    /**
     * Get language name
     */
    public static function getLanguageName(string $language, bool $native = true): string
    {
        $config = self::getConfig();
        if ($native) {
            return $config->languageNames[$language] ?? $language;
        }
        return $config->supportedLanguages[$language] ?? $language;
    }

    /**
     * Get config instance
     */
    protected static function getConfig(): Localization
    {
        if (self::$config === null) {
            self::$config = config('Localization');
        }
        return self::$config;
    }

    /**
     * Extract language from Accept-Language header
     */
    protected static function extractLanguageFromHeader(string $acceptLanguage): ?string
    {
        if (empty($acceptLanguage)) {
            return null;
        }

        $config = self::getConfig();
        $languages = explode(',', $acceptLanguage);

        foreach ($languages as $lang) {
            $parts = explode(';', $lang);
            $langCode = trim($parts[0]);
            
            // Extract base language code (e.g., 'en' from 'en-US')
            $baseLang = strpos($langCode, '-') !== false 
                ? substr($langCode, 0, 2) 
                : $langCode;

            if (isset($config->supportedLanguages[$baseLang])) {
                return $baseLang;
            }
        }

        return null;
    }
}

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
